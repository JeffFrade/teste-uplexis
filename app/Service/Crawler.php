<?php

namespace App\Service;

use App\Helpers\StringHelper;
use App\Repositories\ArticleRepository;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;

class Crawler
{
    private $articleRepository;
    private $guzzle;
    private $baseUrl = 'https://www.uplexis.com.br/blog';

    public function __construct()
    {
        $this->guzzle = new Client();
        $this->articleRepository = new ArticleRepository();
    }

    public function findInBlog(array $params)
    {
        try {
            $url = $this->baseUrl . '?s="' . $params['search'] . '"';

            $content = $this->guzzle->request('GET', $url);

            $contents = StringHelper::doRegex($content->getBody()->getContents(), '/<div class="col(|-12) post"[\w\W]*?<\/div>[\s]+?<\/div>/i');
            $contents = $contents[0];

            foreach ($contents as $content) {
                $link = StringHelper::doRegex($content, '/href="([\w\W]+?)"/i');
                $link = $link[1][0];

                $title = StringHelper::doRegex($content, '/<div class="(|col-md-6 )title">([\w\W]+?)<\/div>/i');
                $title = trim($title[2][0]);

                $data = [
                    'titulo' => $title,
                    'link' => $link,
                    'id_usuario' => Auth::user()->id
                ];

                $this->articleRepository->create($data);
            }

            return [
                'msg' => 'Busca realizada com sucesso!',
                'type' => 'success'
            ];
        } catch (\Exception $e) {
            return [
                'msg' => 'Erro: ' . $e->getMessage(),
                'type' => 'danger',
            ];
        }
    }
}
