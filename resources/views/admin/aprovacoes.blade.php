@extends('templates.base')
@section('title', 'Home')
@section('header')
{{componentCSS('posts')}}
@endsection
@section('content')

<div class="wrapper">
    <h1>Posts esperando por aprovação</h1>
    <div class="posts-wrapper">
        @if (count($posts) == 0)
            <p>Nenhuma postagem necessita de aprovação</p>
        @endif
        @foreach ($posts as $post)
            <x-Post :post="$post" />
        @endforeach    
    </div>
</div>



@endsection