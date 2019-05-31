<?php

namespace App\Repositories;

use App\Repositories\Models\Article;

class ArticleRepository extends AbstractRepository
{
    public function __construct()
    {
        $this->model = new Article();
    }
}
