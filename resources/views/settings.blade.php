@extends('templates.base')
@section('title', __('view.menu.settings'))
{{-- @section('header')
{{componentCSS('posts')}}
@endsection --}}
@section('content')

<div class="wrapper">
    <div class="settings">
        <form action="" method="POST" class="default">
            @csrf
            <h1>{{__('view.settings.title')}}</h1>
            <div class='form-group-inline'>
                <x-ToggleInput name='private_profile' :placeholder="__('view.settings.private_profile')" :value="auth()->user()->settings->private_profile"/>   
            </div>
            <h6>Mudar senha</h6>
            <div class='form-group'>
                <x-Input name='password' :placeholder="__('view.password')" type="password"  icon='bi bi-eye-slash-fill password-hide'/>   
            </div>
            <div class='form-group'>
                <x-Input name='password_confirmation' :placeholder="__('view.password_confirm')" type="password"  icon='bi bi-eye-slash-fill password-hide'/>   
            </div>
                
            <div class="form-group-buttons">
                <button type="submit">{{__('view.settings.save')}}</button>
            </div>
        </form>
    </div>


</div>

@endsection