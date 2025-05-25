<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Article;

class ArticleController extends Controller
{
    public function delete(Article $article)
    {
        $article->delete();
        return redirect()->route('admin.article.index');
    }
}
