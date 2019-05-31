<?php

namespace App\Service;

use App\Repositories\ArticleRepository;

class Article
{
    private $articleRepository;

    public function __construct()
    {
        $this->articleRepository = new ArticleRepository();
    }

    public function index(array $params)
    {
        unset($params['page']);

        return $this->articleRepository->filter($params['search'] ?? '');
    }

    public function delete($id)
    {
        return $this->articleRepository->delete($id);
    }
}