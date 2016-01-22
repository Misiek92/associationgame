@extends('_layout')

@section('content')



    @foreach($words as $word)

       
            <h1 class="color-{{$word['team']}}">{{$word['word']}}</h1>


    @endforeach


@stop