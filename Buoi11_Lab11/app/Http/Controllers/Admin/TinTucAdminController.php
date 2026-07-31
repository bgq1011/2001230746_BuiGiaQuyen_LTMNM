<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TinTucRequest;
use App\Models\TinTuc;
use App\Models\DanhMuc;
use App\Models\HinhAnhTinTuc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TinTucAdminController extends Controller
{
    // [Bài tập 06]: Hàm trợ giúp sinh Slug duy nhất, nhảy hậu tố -2, -3 khi bị trùng
    private function makeUniqueSlug(string $base, ?int $ignoreId = null): string
    {
        $slug = Str::slug($base) ?: Str::random(8);

        $original = $slug;
        $i = 2;
        while (
            TinTuc::where('slug', $slug)
                ->when($ignoreId, fn($q) => $q->where('id', '<>', $ignoreId))
                ->exists()
        ) {
            $slug = "{$original}-{$i}";
            $i++;
        }
        return $slug;
    }

    // [Bài tập 03 & 05 & 07]: Trang danh sách tin tức với tìm kiếm nâng cao đa tiêu chí bằng when()
    public function index(Request $request)
    {
        $dm = DanhMuc::orderBy('ten')->get();

        $q = TinTuc::query()->with(['danhMuc', 'hinhAnhs']);

        // [Bài tập 07]: Áp dụng lọc tìm kiếm đa điều kiện
        $q->when($request->filled('kw'), fn($x) => $x->where(function($b) use ($request) {
            $b->where('tieude', 'like', "%{$request->kw}%")
              ->orWhere('slug', 'like', "%{$request->kw}%");
        }))
        ->when($request->filled('danhmuc_id'), fn($x) => $x->where('danhmuc_id', $request->danhmuc_id))
        ->when($request->filled('trang_thai'), fn($x) => $x->where('trang_thai', $request->trang_thai))
        ->when($request->filled('from'), fn($x) => $x->whereDate('ngaydang', '>=', $request->from))
        ->when($request->filled('to'), fn($x) => $x->whereDate('ngaydang', '<=', $request->to));

        // [Bài tập 03]: Lọc danh sách bài viết trong thùng rác (SoftDeletes)
        if ($request->boolean('trash')) {
            $q->onlyTrashed();
        }

        $rows = $q->orderByDesc('id')->paginate(10)->withQueryString();
        return view('admin.tin.index', compact('rows', 'dm'));
    }

    public function create()
    {
        $dm = DanhMuc::orderBy('ten')->get();
        return view('admin.tin.create', compact('dm'));
    }

    // [Bài tập 03 & 05 & 06 & 07]: Lưu bài viết mới
    public function store(TinTucRequest $request)
    {
        $data = $request->validated();

        // [Bài tập 06]: Tự sinh slug nếu để trống
        $base = !blank($data['slug'] ?? null) ? $data['slug'] : $data['tieude'];
        $data['slug'] = $this->makeUniqueSlug($base);

        // [Bài tập 05]: Xử lý trạng thái nháp / đã đăng và gán ngày đăng hiện tại khi xuất bản
        $data['trang_thai'] = $request->get('trang_thai', 'draft');
        if ($data['trang_thai'] === 'published' && empty($data['ngaydang'])) {
            $data['ngaydang'] = now()->toDateString();
        }

        // [Bài tập 03]: Upload ảnh đại diện bài viết
        if ($request->hasFile('hinhanh_up')) {
            $data['hinhanh_path'] = $request->file('hinhanh_up')->store('news', 'public');
        }

        $tin = TinTuc::create($data);

        // [Bài tập 07]: Upload nhiều ảnh phụ Gallery
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $file) {
                $path = $file->store('news/gallery', 'public');
                $tin->hinhAnhs()->create(['duongdan' => $path]);
            }
        }

        return redirect()->route('admin.tin.index')->with('ok', 'Đã thêm bài viết');
    }

    public function edit(TinTuc $tin)
    {
        $dm = DanhMuc::orderBy('ten')->get();
        $tin->load('hinhAnhs');
        return view('admin.tin.edit', compact('tin', 'dm'));
    }

    // [Bài tập 03 & 05 & 06 & 07]: Cập nhật bài viết
    public function update(TinTucRequest $request, TinTuc $tin)
    {
        $data = $request->validated();

        // [Bài tập 06]: Tạo lại slug duy nhất nếu thay đổi
        $base = !blank($data['slug'] ?? null) ? $data['slug'] : $data['tieude'];
        $data['slug'] = $this->makeUniqueSlug($base, $tin->id);

        // [Bài tập 05]: Cập nhật trạng thái
        $data['trang_thai'] = $request->get('trang_thai', 'draft');
        if ($data['trang_thai'] === 'published' && (empty($tin->ngaydang) || empty($data['ngaydang']))) {
            $data['ngaydang'] = now()->toDateString();
        }

        // [Bài tập 03]: Đổi ảnh đại diện mới và dọn ảnh đại diện cũ
        if ($request->hasFile('hinhanh_up')) {
            if ($tin->hinhanh_path) {
                Storage::disk('public')->delete($tin->hinhanh_path);
            }
            $data['hinhanh_path'] = $request->file('hinhanh_up')->store('news', 'public');
        }
        $tin->update($data);

        // [Bài tập 07]: Upload thêm ảnh phụ Gallery mới
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $file) {
                $path = $file->store('news/gallery', 'public');
                $tin->hinhAnhs()->create(['duongdan' => $path]);
            }
        }

        return redirect()->route('admin.tin.index')->with('ok', 'Đã cập nhật bài viết');
    }

    // [Bài tập 07]: Xóa đơn lẻ 1 ảnh phụ trong Gallery
    public function deleteImage($id)
    {
        $img = HinhAnhTinTuc::findOrFail($id);
        if ($img->duongdan) {
            Storage::disk('public')->delete($img->duongdan);
        }
        $img->delete();
        return back()->with('ok', 'Đã xóa ảnh phụ');
    }

    // [Bài tập 03]: Xóa tạm vào thùng rác (Soft Delete)
    public function destroy(TinTuc $tin)
    {
        $tin->delete();
        return back()->with('ok', 'Đã đưa bài viết vào thùng rác');
    }

    // [Bài tập 03]: Khôi phục bài viết từ thùng rác
    public function restore($id)
    {
        $tin = TinTuc::withTrashed()->findOrFail($id);
        $tin->restore();
        return back()->with('ok', 'Đã khôi phục bài viết');
    }

    // [Bài tập 03 & 07]: Xóa vĩnh viễn bài viết và xóa toàn bộ ảnh vật lý (ảnh chính + ảnh phụ)
    public function forceDelete($id)
    {
        $tin = TinTuc::withTrashed()->with('hinhAnhs')->findOrFail($id);
        if ($tin->hinhanh_path) {
            Storage::disk('public')->delete($tin->hinhanh_path);
        }
        foreach ($tin->hinhAnhs as $img) {
            if ($img->duongdan) {
                Storage::disk('public')->delete($img->duongdan);
            }
        }
        $tin->forceDelete();
        return back()->with('ok', 'Đã xóa vĩnh viễn bài viết');
    }
}
