<?php
namespace App\Parser;

use http\Exception\RuntimeException;
use Symfony\Component\DomCrawler\Crawler;

class Parser
{
    public function getSite(string $siteUrl): Crawler
    {
        $html = file_get_contents($siteUrl);
        $this->parseHttpErrors($http_response_header);

        return new Crawler($html);
    }

    protected function parseHttpErrors($httpResponse)
    {
        $status_line = $httpResponse[0];
        preg_match('{HTTP\/\S*\s(\d{3})}', $status_line, $match);
        $status = $match[1];

        if ($status != 200) {
            //TODO дописать исключение
            throw new RuntimeException("bad request");
        }
        dd($status);
    }
}
