<?php

namespace App\Http\Controllers;

use RAE\RAE;

class GameController extends Controller
{
    public function palabraDelDia(){
        $rae = new RAE(true);
        $search = $rae->searchWord('hola');
        $wordId = $search->getRes()[0]->getId();

        $result = $rae->fetchWord($wordId);
        dd($result, $wordId);
        $definitions = $result->getDefinitions();

        $i = 1;
        foreach ($definitions as $definition) {
            echo $i.'. Tipo: '.$definition->getType()."\n";
            echo '   Definición: '.$definition->getDefinition()."\n\n";
            $i++;
        }

        return view('typingw');

    }
}
