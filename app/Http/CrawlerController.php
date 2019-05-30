<?php

namespace App\Http;

use App\Core\Support\Controller;
use App\Service\Crawler;
use Illuminate\Http\Request;

class CrawlerController extends Controller
{
    private $crawler;

    public function __construct(Crawler $crawler)
    {
        $this->crawler = $crawler;
    }

    public function index(Request $request)
    {
        $params = $request->all();
        $status = [];

        if (isset($params['search'])) {
            $status = $this->crawler->findInBlog($params);
        }

        return view('crawler.index', compact('params', 'status'));
    }
}
