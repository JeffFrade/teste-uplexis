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

    public function index()
    {
        return view('crawler.index');
    }

    public function crawler(Request $request)
    {
        $params = $request->all();
        $status = [];

        if (array_key_exists('search', $params)) {
            $status = $this->crawler->findInBlog($params);
        }

        return response()->json($status);
    }
}
