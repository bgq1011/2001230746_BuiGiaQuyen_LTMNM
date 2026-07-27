<?php

namespace Tests\Feature;

use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ArticleValidationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test validation fails when title and body are empty.
     */
    public function test_title_and_body_are_required()
    {
        $response = $this->post(route('articles.store'), [
            'title' => '',
            'body' => '',
            'tags' => '',
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['title', 'body']);
    }

    /**
     * Test validation fails when body is too short (less than 10 characters).
     */
    public function test_body_must_be_at_least_10_characters()
    {
        $response = $this->post(route('articles.store'), [
            'title' => 'Bài viết mới',
            'body' => 'Ngắn', // 4 ký tự
            'tags' => 'php, laravel',
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['body']);
        $response->assertSessionHasInput('title', 'Bài viết mới');
    }

    /**
     * Test validation fails when title is not unique.
     */
    public function test_title_must_be_unique()
    {
        // Tạo bài viết trước
        Article::create([
            'title' => 'Bài viết trùng lặp',
            'body' => 'Nội dung bài viết thứ nhất dài hơn 10 ký tự',
            'tags' => 'tag1',
        ]);

        // Gửi request tạo bài viết thứ hai trùng tiêu đề
        $response = $this->post(route('articles.store'), [
            'title' => 'Bài viết trùng lặp',
            'body' => 'Nội dung bài viết thứ hai dài hơn 10 ký tự',
            'tags' => 'tag2',
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['title']);
    }

    /**
     * Test successful article creation and redirect.
     */
    public function test_successful_article_creation()
    {
        $response = $this->post(route('articles.store'), [
            'title' => 'Tiêu đề bài viết hợp lệ',
            'body' => 'Nội dung bài viết này cực kỳ chi tiết và dài hơn 10 ký tự.',
            'tags' => 'tag1, tag2',
        ]);

        $response->assertRedirect(route('articles.index'));
        $response->assertSessionHas('success');
        
        $this->assertDatabaseHas('articles', [
            'title' => 'Tiêu đề bài viết hợp lệ',
        ]);
    }

    /**
     * Test update validation ignores current article ID for unique check.
     */
    public function test_update_validation_ignores_current_article_id()
    {
        $article = Article::create([
            'title' => 'Bài viết gốc',
            'body' => 'Nội dung bài viết gốc dài hơn 10 ký tự',
            'tags' => 'tag1',
        ]);

        // Cập nhật mà không đổi title
        $response = $this->put(route('articles.update', $article->id), [
            'title' => 'Bài viết gốc', // Giữ nguyên title
            'body' => 'Nội dung mới đã được cập nhật dài hơn 10 ký tự.',
            'tags' => 'tag-updated',
        ]);

        $response->assertRedirect(route('articles.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('articles', [
            'id' => $article->id,
            'title' => 'Bài viết gốc',
            'body' => 'Nội dung mới đã được cập nhật dài hơn 10 ký tự.',
            'tags' => 'tag-updated',
        ]);
    }
}
