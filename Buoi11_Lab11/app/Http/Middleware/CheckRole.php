<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

// [Bài tập 08]: Middleware kiểm tra quyền truy cập của người dùng (Role-Based Access Control)
class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user = auth()->user();
        if (!$user) {
            return redirect()->route('login');
        }

        // [Bài tập 08]: Tự động gán quyền admin cho tài khoản admin@example.com nếu chưa có cột role trong DB
        $role = $user->role ?? ($user->email === 'admin@example.com' ? 'admin' : 'user');

        // [Bài tập 08]: Trả về lỗi 403 Forbidden nếu không đủ vai trò yêu cầu
        if (!in_array($role, $roles)) {
            abort(403, 'Không có quyền truy cập');
        }

        return $next($request);
    }
}
