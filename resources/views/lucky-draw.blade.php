@extends('layouts.lucky-draw')

@section('title', 'CD Jelajah 5G SME WORKSHOP Lucky Draw')

@section('content')
<div class="container">
    <img src="{{ url('img/MDT-logo.png') }}" alt="" width="350" height="100">
    <div class="title">Lucky Draw</div>
    <div class="winner-box" id="winner">---</div>
    <button class="draw-btn" id="draw-btn">Draw</button>
</div>
@endsection