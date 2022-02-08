<!DOCTYPE html>
<html lang="en">
<head>
    @include('templates.headers')

</head>
<body>
    <div class='wrapper'>
        <form action="{{route('login')}}" method="post" class="default">
            @csrf
            <h1>{{__('view.login')}}</h1>
            <div class="form-group">
                <x-Input name='username' :placeholder="__('view.username')" required/>
            </div>
    
            <div class="form-group">
                <x-Input name='password' :placeholder="__('view.password')"  icon='bi bi-eye-slash-fill password-hide' required />
            </div>
    
            <div class="form-group-buttons">
                <button type="submit">{{__('view.login')}}</button>
                <a href="{{route('criar-conta')}}">{{__('view.create-account.title')}}</a>
            </div>
    
           
        </form>
    </div>
</body>
</html>