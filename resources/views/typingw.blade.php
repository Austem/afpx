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
