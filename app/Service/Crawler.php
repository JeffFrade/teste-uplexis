<?php

namespace App\Service;

use GuzzleHttp\Client;

class Crawler
{
    private $guzzle;
    private $baseUrl = 'https://www.uplexis.com.br/blog';

    public function __construct()
    {
        $this->guzzle = new Client();
    }

    public function findInBlog(array $params)
    {
        try {
            $url = $this->baseUrl . '?s="' . $params['search'] . '"';

            $content = $this->guzzle->request('GET', $url);

            //dd($content->getBody()->getContents());

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
