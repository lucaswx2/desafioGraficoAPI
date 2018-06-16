<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class LiketController extends Controller
{
    public function getEstruturaGraficos(){
        $client = new Client();
        $res = $client->request('GET', 'http://liket.com.br/desafio/json/guia.json');
        return base64_decode($res->getBody());
    }

    public function getAnosXml(){
        $url = 'http://liket.com.br/desafio/xml/';
        $html = file_get_contents($url);
        preg_match_all('/<li><a href="(.+)\/">[^<]*<\/a><\/li>/i', $html, $files);
        unset($files[1][0]);
        return array_values($files[1]);
    }

    public function getMesesXml($ano){
        $url = 'http://liket.com.br/desafio/xml/'.$ano;
        $html = file_get_contents($url);
        preg_match_all('/<li><a href="(.+)\/">[^<]*<\/a><\/li>/i', $html, $files);
        unset($files[1][0]);
        return array_values($files[1]);
    }
    public function getDiasXml($ano,$mes){
        $url = "http://liket.com.br/desafio/xml/$ano/$mes";
        $html = file_get_contents($url);
        preg_match_all('/<li><a href="(.+).xml">[^<]*<\/a><\/li>/i', $html, $files);
        unset($files[1][0]);
        return array_values($files[1]);
    }

    public function obterSaidas($ano,$mes,$dia){
        $client = new Client();
        $res = $client->request('GET', "http://liket.com.br/desafio/xml/$ano/$mes/$dia.xml");
        $xml  = simplexml_load_string($res->getBody());
        $json = json_encode($xml);
        return json_decode($json,true);
    }
}
