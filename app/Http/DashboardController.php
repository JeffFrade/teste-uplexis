<?php

namespace App\Http;

use App\Core\Support\Controller;
use App\Service\Article;

class DashboardController extends Controller
{
    private $article;

    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    public function index()
    {
        $totalArticles = $this->article->countAll();

        return view('dashboard', compact('totalArticles'));
    }
}
