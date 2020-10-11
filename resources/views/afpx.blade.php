@extends('layouts.master')

@section('title', 'AfpX')

@section('content')
    <h2>Fecha Ultimos Valores: {{$afpDTO->getFecha() ?? ''}}</h2>
    <h6>Fecha Actual: <?php echo date("d-m-Y")?></h6>
    <table class="table bg-primary text-white text-center">
        <tr>
            <td colspan="5">
                <form action="{{route('cambiarAfp')}}">

                    <label for="afp">AFP: </label>
                    <select name="afps" id="afp">
                        <option value="PROVIDA" selected>PROVIDA</option>
                        <option value="CAPITAL">CAPITAL</option>
                        <option value="PLANVITAL">PLANVITAL</option>
                        <option value="CUPRUM">CUPRUM</option>
                        <option value="MODELO">MODELO</option>
                        <option value="HABITAT">HABITAT</option>
                        <option value="UNO">UNO</option>
                    </select>

                    <button type="submit" class="btn-primary">Cambiar</button>
                </form>
            </td>
        </tr>
        <tr>
            <td>FONDO A</td>
            <td>FONDO B</td>
            <td>FONDO C</td>
            <td>FONDO D</td>
            <td>FONDO E</td>
        </tr>
        <tr>
            @foreach($afpDTO->getValoresFondos() as $key => $item)
                <td id="{{$key}}">{{$item}}</td>
            @endforeach
        </tr>
    </table>
    <hr>
    <div class="container">
        <div class="form-group row">
            {{--            CUOTAS--}}
            <div class="col-sm border">

                <p class="text-center">Calcular Monto total</p>

                <label for="cuotas">Cantidad de Cuotas: </label>
                <input id="cuotas" type="number">

                <br>

                <label for="fondosCuota">Fondo: </label>
                <select name="fondoCuota" id="fondosCuota">
                    <option value="0">Fondo A</option>
                    <option value="1">Fondo B</option>
                    <option value="2">Fondo C</option>
                    <option value="3">Fondo D</option>
                    <option value="4">Fondo E</option>
                </select>

                <br>

                <label for="totalMonto">Total Monto: </label>
                <input id="totalMonto" type="text" disabled>

                <button class="btn btn-primary col-sm" onclick="document.getElementById('totalMonto').value = '$ '+
                    calcularMonto(document.getElementById('cuotas').value, document.getElementById(document.getElementById('fondosCuota').value).innerText)">
                    CALCULAR MONTO
                </button>
            </div>
            {{--            MONTOS--}}
            <div class="col-sm border">

                <p class="text-center">Calcular Cuotas totales</p>

                <label for="montos">Monto en Pesos: </label>
                <input id="montos" type="number">

                <br>

                <label for="fondosMonto">Fondo: </label>
                <select name="fondoMonto" id="fondosMonto">
                    <option value="0">Fondo A</option>
                    <option value="1">Fondo B</option>
                    <option value="2">Fondo C</option>
                    <option value="3">Fondo D</option>
                    <option value="4">Fondo E</option>
                </select>

                <br>

                <label for="totalCuotas">Total Cuotas:</label>
                <input id="totalCuotas" type="text" disabled>

                <button class="btn btn-primary col-sm"
                        onclick="document.getElementById('totalCuotas').value =
                        calcularCuota(document.getElementById('montos').value, document.getElementById(document.getElementById('fondosMonto').value).innerText) ">
                    CALCULAR CUOTAS
                </button>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        document.getElementById('afp').value = "<?php echo $afpDTO->getNombre(); ?>"
    </script>

@endsection

