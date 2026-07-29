<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckArticleAuthor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $article = $request->route('article');

        if ($article && $article->user_id && auth()->check()) {
            if ($article->user_id !== auth()->id()) {
                abort(403, 'Bạn không phải tác giả');
            }
        }

        return $next($request);
    }
}
