<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class QuickAuthTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test 1: Khách chưa đăng nhập truy cập route bảo vệ (/admin/articles/create)
     * Kỳ vọng: Hệ thống chuyển hướng 302 về trang /login
     */
    public function test_unauthenticated_user_redirected_to_login(): void
    {
        $response = $this->get('/admin/articles/create');

        // Phải chuyển hướng status 302
        $response->assertStatus(302);
        // Chuyển hướng tới đúng trang /login
        $response->assertRedirect('/login');
    }

    /**
     * Test 2: Đăng nhập thành công với mật khẩu đúng
     */
    public function test_user_can_login_successfully(): void
    {
        $user = User::factory()->create([
            'password' => bcrypt('password123'),
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password123',
        ]);

        // Đã xác thực thành công
        $this->assertAuthenticated();
        // Chuyển hướng về trang chủ /dashboard
        $response->assertRedirect('/dashboard');
    }

    /**
     * Test 3: Đăng nhập thất bại khi sai mật khẩu
     */
    public function test_user_cannot_login_with_invalid_password(): void
    {
        $user = User::factory()->create([
            'password' => bcrypt('password123'),
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'sai-mat-khau',
        ]);

        // Vẫn là khách (chưa đăng nhập được)
        $this->assertGuest();
    }
}
