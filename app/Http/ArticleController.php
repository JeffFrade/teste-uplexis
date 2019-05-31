<?php

namespace App\Http;

use App\Core\Support\Controller;
use App\Service\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    private $article;

    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    public function index(Request $request)
    {
        $params = $request->all();
        $articles = $this->article->index($params);

        return view('articles.index', compact('articles', 'params'));
    }

    public function delete($id)
    {
        $this->article->delete($id);
    }
}
