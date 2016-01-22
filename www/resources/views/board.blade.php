@extends('_layout')

@section('content')
<div class='side'>
    <a href='/'><span class='glyphicon glyphicon-home'></span></a>
    <a href='/game/{{$name}}/captain'><span class='glyphicon glyphicon-th-list'></span></a>
    <p class="color-0">{{$points1}}</p>
    <p class="color-1">{{$points2}}</p>
</div>
<div class='content'>
    @foreach($words as $word)

    <section class="container">
        <div id="card_{{$word['word']}}" class='card' data-game='{{$name}}' data-word='{{$word['word']}}' data-discovered='{{$word['discovered']}}'>
            <figure class="front">{{$word['word']}}</figure>
            <figure class="back color-{{$word['team']}}">{{$word['word']}}</figure>
        </div>
    </section>

    @endforeach
</div>

<script>
    var server_timestamp = {{ $timestamp}},
            name = "{!!$name!!}",
            words = '{!!json_encode($words)!!}';
</script>

@stop