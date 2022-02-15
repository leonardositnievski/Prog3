@extends('templates.base')
@section('title', 'Home')
@section('content')

    <div class="wrapper">

        <div class="create-post">

            <h1 class="page-title">{{__('view.create-post.title')}}</h1>
            <form action="{{routeLang('publicar')}}" method='POST' enctype="multipart/form-data" >

                @csrf
                
                <div class="title form-group">
                    <x-Input name='title' :placeholder="__('view.post.title')" required/>
                </div>
                <div class="genero form-group">
                    <x-Input name='genre' :placeholder="__('view.post.genre')" required/>
                </div>
                <div class="descricao form-group">
                    <x-TextArea name='description' :placeholder="__('view.post.description')" required/>
                </div>
                
                <div class="post-add-content">
                <div class="post-image" id='image-upload'>
                        <i class="bi bi-camera-fill"></i>
                    </div>
                    @error('midia')
                        <span class="form-input-error" for='midia'>{{$message}}</span>
                    @enderror


                    <input type="file" name='midia' id='midia'>
                </div>
                <div class="post-actions">
                    <button type='submit'>{{__('view.create-post.actions.submit')}}</button>
                    <button>{{__('view.create-post.actions.cancel')}}</button>
                </div>

            </form>
        </div>

    </div>
    <script>
    document.addEventListener("DOMContentLoaded", function(event) {
        const PLACEHOLDER_IMAGE = document.getElementById("image-upload");
        const MIDIA_INPUT = document.getElementById("midia")


        PLACEHOLDER_IMAGE.addEventListener('click', ()=>{
            MIDIA_INPUT.click();
        })

        MIDIA_INPUT.addEventListener('change',(e)=>{
            if (e.target.files[0]) {
                const url = URL.createObjectURL(e.target.files[0])
                PLACEHOLDER_IMAGE.classList.add('uploaded')
                PLACEHOLDER_IMAGE.style.backgroundImage = 'url('+url+')'
                return
            }
            PLACEHOLDER_IMAGE.classList.remove('uploaded')
            PLACEHOLDER_IMAGE.style.backgroundImage = 'url()'
        })
    });    
    </script>
@endsection
