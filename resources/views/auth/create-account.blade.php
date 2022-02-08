<!DOCTYPE html>
<html lang="en">
<head>
    @include('templates.headers')

</head>
<body>
    <div class='wrapper'>
        <form action="{{route('criar-conta')}}" method="post" class="default">
            @csrf
            <h1>{{__('view.create-account.title')}}</h1>
            <div class="form-group">
                <x-Input name='email' :placeholder="__('view.email')" type="email" required/>
            </div>
            
            <div class="form-group">
                <x-Input name='name' :placeholder="__('view.name')" required/>

            </div>

            <div class="form-group">
                <x-Input name='username' :placeholder="__('view.username')" required/>

            </div>
            

            <div class="form-group double-input">
                <div>
                    <x-Input name='password' :hint="__('view.password_hint')" type='password' :placeholder="__('view.password')" icon='bi bi-eye-slash-fill password-hide' required/>
                </div>
                <div>
                    <x-Input name='password_confirm' type='password' :placeholder="__('view.password_confirm')" icon='bi bi-eye-slash-fill password-hide' required/>
                </div>
            </div>

            <div class="form-group-buttons">
                <button type="submit">{{__('view.create-account.button')}}</button>
                <a href="{{route('login')}}">{{__('view.login')}}</a>
            </div>
    
           
        </form>
    </div>
    <script>

        document.addEventListener('DOMContentLoaded', function(){

            Array.from(document.getElementsByClassName('password-hide')).map((el)=>{

                el.addEventListener('click',(e)=>{
                    const input = document.getElementsByName(e.target.getAttribute('for'))[0];
                    if(!input){
                        return
                    }
                    if(input.type === 'password'){
                        input.type = 'text'
                        e.target.classList.add("bi-eye-fill"); 
                        e.target.classList.remove("bi-eye-slash-fill");
                    }else{
                        input.type = 'password'
                        e.target.classList.remove("bi-eye-fill"); 
                        e.target.classList.add("bi-eye-slash-fill");
                    }

                    setTimeout(() => {
                        input.type = 'password'
                        e.target.classList.remove("bi-eye-fill"); 
                        e.target.classList.add("bi-eye-slash-fill");
                    }, 2000);
                });
            
        })})

    </script>
</body>
</html>