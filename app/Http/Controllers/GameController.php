<?php

namespace App\Http\Controllers;

use App\Service\typingService;


class GameController extends Controller
{
    private $typingService;

    public function __construct(typingService $typingService)
    {
        $this->typingService = $typingService;
    }

    public function iniciar(){

        $palabras = $this->typingService->obtenerPalabras();

        return view('typingw', compact('palabras'));
    }
}
