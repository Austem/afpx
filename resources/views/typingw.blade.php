@extends('layouts.master')
@section('title','TypingW')
@section('content')

    <div class="container-fluid bg-light h-full">
        <div class="row">

            <div class="col-3">

            </div>

            <div id="inicio" class="col-6">
                <div class="form-group border text-center">
                    <h3>
                        TypingW
                    </h3>

                    <div class="text-left">

                        <h4>Indicaciones:</h4>
                        <li>Solo minúsculas.</li>
                        <li>No es necesario las tildes.</li>
                        <h4>Objetivo:</h4>
                        <p>Aprender una nueva palabra y su significado.</p>

                    </div>

                    <p id="comoIniciar">Presione cualquier tecla para comenzar.</p>

                </div>

            </div>
        <?php
        $i = 0;
        foreach ($definiciones as $palabra => $definicion) {        ?>
        <!--            Cuadros de texto-->
            <div id="{{$i ?? ''}}" class="col-6" style="display: none">
                <div class="form-group border text-center">
                    <h3>
                        <?php echo $palabra ?>
                    </h3>
                    <div class="text-left">
                        <?php foreach ($definicion as $texto) {
                        echo $texto;
                        ?>
                        <br>
                        <?php  } ?>

                    </div>

                </div>
            </div>
            <?php $i++;}?>

            <?php if (10 === $i){?>
            <div id="fin" class="col-6" style="display: none">
                <div class="form-group border text-center">
                    <h3>
                        Game Over.
                    </h3>
                    <br>
                    <div class="text-center">
                        <blockquote class="blockquote">
                            <p class="mb-0 font-italic">"Educación como forma de Revolución." </p>

                        </blockquote>
                        <br>
                        <button type="button" class="btn btn-dark" onclick="location.reload(false)">Otra Ronda</button>
                        {{--                        <img src="/images/imagen-final-W.jpeg" alt="frase de Issac Asimov">--}}
                        <br>
                    </div>

                </div>

            </div>
            <?php }?>

            <div class="col-3">

            </div>

        </div>
    </div>

@endsection

@section('scripts')
    <script type="text/javascript" src="https://www.cornify.com/js/cornify.js"></script>

    <script>

        animation = function () {
            document.getElementById('comoIniciar').classList.toggle('fade')
        };
        setInterval(animation, 300);


        document.getElementById('fin').style.display = 'none';
        //Oculta todas las demas opciones, excepto la primera
        for (i = 0; i <= 9; i++) {
            document.getElementById(i).style.display = 'none';
        }
        //funcion que remueve acentos
        const removeAccents = (str) => {
            console.log(str);
            return str.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
        }

        let palabra = <?php echo json_encode($palabras)?>;

        const pressed = [];

        let secretCode = 'enter';
        //removeAccents(palabra[0].toLowerCase());
        //esconde el recuadro actual y visibiliza el siguiente
        //ademas cambia la palabra secreta por la siguiente
        function siguientePalabra(o) {
            document.getElementById(o - 1).style.display = 'none';
            if (10 === o) {
                document.getElementById('fin').style.display = 'block';
            }
            document.getElementById(o).style.display = 'block';
            secretCode = removeAccents(palabra[o].toLowerCase());
            console.log('siguiente palabra', o);

        }

        var o = 0;
        window.addEventListener('keyup', (e) => {
            document.getElementById('inicio').style.display = 'none';
            console.log(e.key, secretCode);
            pressed.push(e.key.toLowerCase());

            //El método splice() cambia el contenido de un array eliminando elementos existentes
            // y/o agregando nuevos elementos.

            pressed.splice(-secretCode.length - 1, pressed.length - secretCode.length);
            //El método join() une todos los elementos
            //de una matriz (o un objeto similar a una matriz) en una cadena y devuelve esta cadena.

            if (pressed.join('').includes(secretCode)) {
                console.log('DING DING!');
                // cornify_add();
                o++;
                siguientePalabra(o);
                console.log('tipeio', o);
            }

            console.log(pressed);
        })
    </script>

@endsection
