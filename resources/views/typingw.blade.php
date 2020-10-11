@extends('layouts.master')

@section('content')
    <div class="container">
        @foreach($palabras as $key => $item)
            <p>{{$key}}</p>

            @foreach($item as $def)
                <p>{{$def}}</p>

            @endforeach
        @endforeach
    </div>


@endsection

@section('scripts')
    <script type="text/javascript" src="https://www.cornify.com/js/cornify.js"></script>

    <script>
        const pressed = [];
        const secretCode = 'pletorico';

        window.addEventListener('keyup', (e) => {

            console.log(e.key);
            pressed.push(e.key);

            //El método splice() cambia el contenido de un array eliminando elementos existentes
            // y/o agregando nuevos elementos.

            pressed.splice(-secretCode.length - 1, pressed.length - secretCode.length);
            //El método join() une todos los elementos
            //de una matriz (o un objeto similar a una matriz) en una cadena y devuelve esta cadena.

            if (pressed.join('').includes(secretCode)) {
                console.log('DING DING!');
                cornify_add();
            }

            console.log(pressed);
        })
    </script>

@endsection
