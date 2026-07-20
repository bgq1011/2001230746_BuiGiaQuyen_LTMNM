<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Article extends Model
{
    protected $fillable = ['id', 'title', 'body'];

    public static function findOrFail($id)
    {
        $mockArticles = [
            1 => ['id' => 1, 'title' => 'Giới thiệu Laravel 12', 'body' => 'Nội dung A'],
            2 => ['id' => 2, 'title' => 'Blade Components', 'body' => 'Nội dung B'],
        ];

        if (!isset($mockArticles[$id])) {
            throw new ModelNotFoundException();
        }

        return new self($mockArticles[$id]);
    }

    public function resolveRouteBinding($value, $field = null)
    {
        return static::findOrFail($value);
    }
}
