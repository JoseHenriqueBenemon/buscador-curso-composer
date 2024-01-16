<?php

namespace Alura\Php\BuscadorDeCursos;

use GuzzleHttp\ClientInterface;
use Symfony\Component\DomCrawler\Crawler;

class Buscador
{
    private ClientInterface $clientInterface;

    private Crawler $crawler;

    public function __construct(ClientInterface $clientInterface, Crawler $crawler)
    {
        $this->clientInterface = $clientInterface;
        $this->crawler = $crawler;
    }

    public function search(string $url): array
    {
        $reponse = $this->clientInterface->request("GET", $url);
        $html = $reponse->getBody();

        $this->crawler->addHtmlContent($html);

        $cursos = $this->crawler->filter("span.card-curso__nome");

        $arrCursos = [];
        foreach ($cursos as $curso) {
            $elemento = $curso->textContent;

            $arrCursos[] = $elemento;
        }

        return $arrCursos;
    }

    public static function testar(): void
    {
        echo "Testando funcionalidade...";
    }
}
