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

        $palabrasYDefiniciones = $this->typingService->obtenerPalabras();
        $palabras = $palabrasYDefiniciones['palabras'];
        $definiciones = $palabrasYDefiniciones['definiciones'];

        return view('typingw', compact('palabras','definiciones'));
    }
}
