<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Student;

class AdvancedController extends Controller
{
    public function index()
    {
        // 1. Sản phẩm có giá > 100,000
        $expensiveProducts = Product::with('category')->where('price', '>', 100000)->get();

        // 2. Đếm số sản phẩm trong từng danh mục ($category->products_count)
        $categories = Category::withCount('products')->get();

        // 3. Lấy danh sách sinh viên kèm số lượng môn học đã đăng ký ($student->courses_count)
        $students = Student::withCount('courses')->get();

        return view('advanced.index', compact('expensiveProducts', 'categories', 'students'));
    }
}
