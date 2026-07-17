<?php

namespace App\Http\Controllers;

use App\Models\Student;

class StudentController extends Controller
{
    // Bài 08: hiển thị form tạo mới sinh viên
    public function create()
    {
        return view('students.create');
    }

    // Bài 08: validate và lưu sinh viên mới vào CSDL
    public function store()
    {
        $validated = request()->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:students,email'],
            'age' => ['nullable', 'integer', 'min:16'],
            'gender' => ['required', 'in:male,female'],
            'class_name' => ['required', 'string', 'max:255'],
        ]);

        $student = new Student();
        $student->name = $validated['name'];
        $student->email = $validated['email'];
        $student->age = $validated['age'] ?? null;
        $student->gender = $validated['gender'];
        $student->class_name = $validated['class_name'];
        $student->save();

        return redirect('/students/db')->with('success', 'Tạo mới thành công');
    }

    // Bài 03: dữ liệu mảng tĩnh và render qua Blade
    public function index()
    {
        $students = [
            ['name' => 'Nguyễn An', 'age' => 19, 'email' => 'an@huit.edu.vn'],
            ['name' => 'Trần Bình', 'age' => 18, 'email' => 'binh@huit.edu.vn'],
            ['name' => 'Lê Chi', 'age' => 17, 'email' => 'chi@huit.edu.vn'],
            ['name' => 'Phạm Dũng', 'age' => 20, 'email' => 'dung@huit.edu.vn'],
            ['name' => 'Đỗ Em', 'age' => 21, 'email' => 'em@huit.edu.vn'],
        ];

        return view('students.index', compact('students'));
    }

    // Bài 04 và 06: lấy dữ liệu từ CSDL, phân trang và lọc giới tính
    public function indexDb()
    {
        $gender = request('gender'); // 'male' | 'female' | null
        $query = Student::query()->orderBy('id', 'desc');

        if ($gender) {
            $query->where('gender', $gender);
        }

        $students = $query->paginate(5)->appends(compact('gender'));

        return view('students.index_db', compact('students', 'gender'));
    }

    // Bài 05: so sánh mảng tĩnh và dữ liệu DB trên cùng một view
    public function combined()
    {
        $static = [
            ['name' => 'Nguyễn An', 'age' => 19, 'email' => 'an@huit.edu.vn', 'gender' => 'male', 'class_name' => 'CNTT K48'],
            ['name' => 'Trần Bình', 'age' => 18, 'email' => 'binh@huit.edu.vn', 'gender' => 'male', 'class_name' => 'CNTT K49'],
            ['name' => 'Lê Chi', 'age' => 17, 'email' => 'chi@huit.edu.vn', 'gender' => 'female', 'class_name' => 'HTTT K48'],
        ];

        $db = \App\Models\Student::orderBy('id', 'desc')->paginate(5);
        // Lấy nguồn từ query param ?source=array|db (mặc định db)
        $source = request('source', 'db');

        return view('students.combined', compact('static', 'db', 'source'));
    }
}

