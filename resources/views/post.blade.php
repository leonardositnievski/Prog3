@extends('templates.base')
@section('title', 'Post')
@section('header')
{{componentCSS('posts')}}
@endsection
@section('content')
    <x-Post :post="$post"/>
@endsection