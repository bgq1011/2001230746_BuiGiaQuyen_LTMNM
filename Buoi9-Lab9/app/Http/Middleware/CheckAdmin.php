<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // GIẢ LẬP ĐỂ TEST NHANH: Nếu truyền ?admin=1 trên URL thì cho qua
        if ($request->query('admin') == 1) {
            return $next($request);
        }

        // Kiểm tra thực tế nếu đã đăng nhập và là admin
        $user = $request->user();
        if (!$user || !$user->is_admin) {
            abort(403, 'Bạn không có quyền truy cập khu vực quản trị.');
        }

        return $next($request);
    }
}
