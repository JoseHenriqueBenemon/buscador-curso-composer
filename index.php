<?php 

/*
Buscador de cursos
*/
require_once 'vendor/autoload.php';

use Alura\Php\BuscadorDeCursos\Buscador;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;


$client = new Client(["base_uri" => "https://www.alura.com.br/"]);
$crawler = new Crawler();

$buscador = new Buscador($client, $crawler);
$cursos = $buscador->search("cursos-online-programacao/php");

foreach($cursos as $key => $curso){
    echo $curso . PHP_EOL;
}