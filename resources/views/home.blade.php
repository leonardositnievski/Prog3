@extends('templates.base')
@section('title', 'Home')
@section('header')
{{componentCSS('posts')}}
@endsection
@section('content')

<div class="wrapper">
    <div class="create-post">
        <div class="user-profile-pic">
            <img src="{{ auth()->user()->photo_url }}">
        </div>
        <a href="{{routeLang('criar')}}"><button class="create-post-button">{{__('view.home.create-post')}}</button></a>
    </div>
    <div class="posts-wrapper">
        @foreach ($posts as $post)
            <x-Post :post="$post"/>
        @endforeach    
    </div>

</div>

@endsection