@extends('templates.base')
@section('title', auth()->user()->name)
@section('header')
{{componentJS('image-input')}}
@endsection
@section('content')


<div class="wrapper">
    <form action="{{route('edit.profile')}}" method="post" class="default" enctype="multipart/form-data">
        @csrf
        <h1>{{__('view.profile.edit.title')}}</h1>
        
    
        <div class="form-group">            
            <x-Input name='name' :placeholder="__('view.name')" :value='auth()->user()->name' required/>
        </div>

        <div class="form-group">
            <x-Input name='bio' :placeholder="__('view.bio')" :value='auth()->user()->bio'/>
        </div>

        
        <div class="form-group">
            <x-Input name='email' :placeholder="__('view.email')" :value='auth()->user()->email' required/>
        </div>


        <div class="form-group">
            <x-ImageInput name='photo_url' :placeholder="__('view.photo')" :url='auth()->user()->photo_url' required/>
        </div>



        <div class="form-group-buttons">
            <button type="submit">{{__('view.profile.edit.button')}}</button>
        </div>

       
    </form>



</div>



@endsection