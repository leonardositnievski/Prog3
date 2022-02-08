@extends('templates.base')
@section('title', $user->name)
@section('header')
{{componentCSS('posts')}}
@endsection
@section('content')


<div class="wrapper">

    <div class="profile-content">
        <div class="profile-header">

            <div class="user-image">
                <img src="{{$user->photo_url}}" alt='{{__('view.profile.user.image_description', ['user_name' => $user->name])}}'/>
            </div>

            <div class="user-name">
                {{$user->name}}
            </div>

            <div class="user-bio">
                {{$user->bio}}
        </div>
            @auth
                @if (auth()->user()->id == $user->id)
                    <a class="bi bi-gear edit-button" href="{{ route('edit.profile') }}"> {{__('view.profile.edit_button')}}</a>
                @endif
            @endauth
            
        </div>

        <h1>{{__('view.profile.posts')}}</h1>
        @foreach ($user->posts as $post)
            <x-Post :post="$post"/>
        @endforeach


    </div>

    
            

    </div>



</div>



@endsection