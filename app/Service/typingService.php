<?php

namespace App\Service;

use Goutte\Client;


class typingService{

    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function obtenerPalabras(){

        $palabras = $this->traerPalabras();

        $palabrasDefinicion = $this->traerDefinicion($palabras);

        return $palabrasDefinicion;

    }

    public function traerPalabras(){

        $pagina[] = $this->client->request(
            'GET',
            'https://www.palabrasaleatorias.com/?fs=10&fs2=0&Submit=Nueva+palabra');

        $palabrasBase[] = $pagina[0]->filter('div')->each(function ($item){
            return $item->text();
        });

        unset($palabrasBase[0][0]);
        unset($palabrasBase[0][11]);

       foreach ($palabrasBase as $palabraBase){
           foreach ($palabraBase as $item){
               $palabras[] = $item;
           }
       }

       return $palabras;
    }

    public function traerDefinicion($palabras){

        foreach ($palabras as $palabra){

            $pagina = $this->client->request(
                'GET',
                'https://dle.rae.es/'.$palabra);

            $palabrasBase = $pagina->filter('.j')->each(function ($item){
                return $item->text();
            });

            $palabrasDefinicion[$palabra] = $palabrasBase;
        }

        return $palabrasDefinicion;
    }

}
