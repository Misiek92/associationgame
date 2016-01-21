@extends('_layout')

@section('content')

@foreach($words as $word)

<section class="container">
    <div id="card_{{$word['word']}}" class='card'>
        <figure class="front">{{$word['word']}}</figure>
        <figure class="back color-{{$word['team']}}">{{$word['word']}}</figure>
    </div>
</section>

@endforeach

@stop