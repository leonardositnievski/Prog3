<!DOCTYPE html>
<html lang="en">

<head>
    @include('templates.headers')

    @yield('header')
    <title>@yield('title') - {{ env('APP_NAME') }}</title>

</head>

<body>
    <header class='navbar'>
        <a href="{{ routeLang('home') }}"><img src="{{ asset('logo.png') }}" alt="{{ env('APP_NAME') }} logo"></a>
        <a href="{!! $view_name === 'home' ? '#' : routeLang('home') !!}" class="home-button link" {!! $view_name === 'home' ? 'active' : '' !!}><i
                class="bi bi-house-door-fill">home</i></a>



        <div class="search-container">
            <div class="search">
                <input type="text" id='procurar' list="resultados">
                <i class="bi bi-search"></i>
                <div id="resultados"></div>
            </div>
        </div>
        <div class='navbar-buttons'>

            <a href="{!! $view_name === 'settings' ? '#' : routeLang('settings') !!}" class="settings-button link" {!! $view_name === 'settings' ? 'active' : '' !!}>
                <i class="bi bi-gear">configuracoes</i>
            </a>
            @auth
                @if (auth()->user()->isAdmin)
                    <a href="{!! $view_name === 'admin.aprovacoes' ? '#' : routeLang('aprovacoes') !!}" class="account-button link" {!! $view_name === 'admin.aprovacoes' ? 'active' : '' !!}><i
                            class="bi bi-person-circle">Aprovacoes</i></a>

                @else
                    <a href="{!! $view_name === 'profile' ? '#' : routeLang('profile', auth()->user()->id) !!}" class="account-button link" {!! $view_name === 'profile' ? 'active' : '' !!}><i
                            class="bi bi-person-circle">conta</i></a>

                @endif
                <a href='{{ routeLang('logout') }}'>Logout</a>

            @endauth

            @guest
                <a href='{{ routeLang('login') }}'>Login</a>
            @endguest
        </div>
    </header>
    <main class='main-content'>
        @yield('content')
    </main>

    <x-Modal />

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="{{ URL::asset('js/pages/'.$view_name.'-page.js')}}"></script>
<script>

document.addEventListener('DOMContentLoaded', function(event){
    const createModal = setupModal();
    const search_input = document.getElementById('procurar')
    const search_results = document.getElementById('resultados')
    timeout = null
    search_input.addEventListener('keyup',()=>{
        const text = search_input.value;
        $.ajax({
            'url' : "{{ route('procurar') }}?q="+text,
            'headers': {
                'Authorization':'Bearer {{auth()->user()->api_token}}'
            },
            success: (results)=>{
                search_results.innerHTML = '';
                for (const result of results) {
                    const a = document.createElement('a')
                    a.href = result.profile
                    const img = document.createElement('img')
                    img.src = result.photo_url
                    const span = document.createElement('span')
                    span.innerText = result.name
                    a.append(img);
                    a.append(span);
                    search_results.append(a);
                }
                if (timeout) {
                    clearTimeout(timeout)
                }
                timeout = setTimeout(() => {
                    search_results.innerHTML = ''; 
                }, 3000);
            }
        })


    })



    const denunciar_usuario_modal = createModal((m) => denunciaModalDriver(m, {
        type: 'modal-denunciar-post',
        open_button : 'modal-denunciar-button',
    }));

    const denunciar_comentario_modal = createModal((m) => denunciaModalDriver(m, {
        type: 'modal-denunciar-comment',
        open_button : 'post-comment-denunciar',
    }));

    const avaliacao_modal = createModal(avaliacao_driver)

    function avaliacao_driver(modal){
        const data = {
            lock : false
        }

        function onMount(e){
            modal.content.querySelector('#modal-avaliar-nome-usuario').innerText = e.target.dataset.username
            data.postId = e.target.dataset.postId
            Array.from(modal.content.querySelectorAll('textarea')).map(activateInput)
            modal.content.getElementsByTagName('BUTTON')[0].addEventListener('click', submit)
            Array.from(modal.content.querySelectorAll('.half-star')).map((el)=>{
                el.addEventListener('mouseenter',(e)=>{
                    if (data.lock) {
                        return
                    }
                    Array.from(modal.content.querySelectorAll('.half-star.active')).map((e)=>{
                        e.classList.remove('active')
                    })
                    activatePreviousSibling(e.target)
                    evaluateStars(modal.content.querySelector('#modal-avaliar-content'))
                    
                })

                el.addEventListener('click',(e)=>{
                    data.lock = !data.lock
                    activatePreviousSibling(e.target)
                    evaluateStars(modal.content.querySelector('#modal-avaliar-content'))
                    setTimeout(() => {
                        data.lock = false
                    }, 500);
                })
            })
        }

        function submit(e){
            e.preventDefault();
            const stars = modal.content.querySelectorAll('.half-star.active').length;
            const texto = modal.content.querySelector('textarea').value;
            debugger
            const post_data = {
                'token' : "{{ auth()->user()->api_token }}",
                'stars' : stars,
                'id' : data.postId,
                'texto' : texto
            }
            $.ajax({
                'url' : "{{ route('avaliar') }}",
                'method' : 'POST',
                'data' : post_data,
                success: ()=>{
                    modal.toggle()
                }
            });

        }
        function activateInput(el){
            el.value ? el.setAttribute('active','') : el.removeAttribute('active')
            el.addEventListener('change', (e)=>{
                const element = e.target
                removeError(element)
                element.value ? element.setAttribute('active','') : element.removeAttribute('active')
            })
            el.addEventListener('click', (e)=>{
                const element = e.target
                removeError(element)
            })
            el.addEventListener('focus', (e)=>{
                const element = e.target
                removeError(element)
            })
        }

        function removeError(element){
            element.classList.remove('error')
            const errorMessage = document.querySelector(`.form-input-error[for=${element.name}]`);
            if (errorMessage) {
                errorMessage.remove()
            }
        }


        function evaluateStars(root){
            for (let index = 0; index < root.children.length; index++) {
                const star_element = root.children.item(index);
                const [h_star_1, star_icon, h_star_2] = star_element.children;
                if (h_star_1.classList.contains('active') && h_star_2.classList.contains('active')) {
                    star_icon.setAttribute('class','bi bi-star-fill');
                }else if (h_star_1.classList.contains('active') || h_star_2.classList.contains('active')){
                    star_icon.setAttribute('class','bi-star-half');
                }else{
                    star_icon.setAttribute('class','bi-star');
                }

            }
        }
        function activatePreviousSibling(element){

            if (element.classList.contains('half-star')) {
                element.classList.add('active');
            }
            if (!element.previousElementSibling && !element.parentElement.previousElementSibling) {
                return true
            }
            return activatePreviousSibling(element.previousElementSibling ?? element.parentElement.previousElementSibling.lastElementChild);
        }
        return{
            type: 'modal-avaliar',
            open_button : 'post-actions-rate-button',
            onMount
        }
    }
})

function denunciaModalDriver(modal, info){
    const ANIMATION_FORWARD= 'forward';
    const ANIMATION_BACKWARD= 'backward';
    const data = {
        current : null,
        content : null,
        currentPage : []
    }
    const pages = @json(categorias_denuncias());

    function createBackButton(){
        const backButton = document.createElement('li');
        backButton.setAttribute('class', 'bi bi-caret-left-fill')
        backButton.innerText = 'Voltar';
        backButton.addEventListener('click', back)
        return backButton
    };

    function mountPage(pageItens, direction = ANIMATION_FORWARD, init = false){
            const createPages = () =>{
                const ul = document.createElement('ul');
                ul.classList.add('denuncia-motivo')
                if (data.currentPage.length > 0) {
                    ul.append(createBackButton());
                }
                for (const id in pageItens) {
                    const page = pageItens[id];
                    const item = document.createElement('li');
                    page.children && item.classList.add('class', 'hasNextPage');
                    page.children && item.addEventListener('click', nextPage);
                    !page.children && item.addEventListener('click', itemClick);

                    // item.classList.add('class', direction === this.ANIMATION_FORWARD ? this.ANIMATION_BACK : this.ANIMATION_FORWARD);
                    
                    item.setAttribute('data-page-id', id);
                    item.innerText = page.text;
                    ul.append(item);
                }
                return ul;
            }

            data.content.getElementsByTagName('ul')[0]?.classList.add('toBeRemoved')
            const pages = createPages();
            data.content.append(pages)
            transition(direction , init);
    }

    function transition(direction, init){
        if (init) {
            return
        }
        data.content.classList.add(direction)
        setTimeout(() => {
            data.content.classList.remove('forward')
            data.content.classList.remove('backward')
            data.content.classList.add('reverse')

            data.content.getElementsByClassName('toBeRemoved')[0]?.remove()
        }, 500);
    }

    function back(){
        data.currentPage.pop();
        const page = getCurrentPage();
        data.content.classList.remove('reverse')
        mountPage(page, ANIMATION_BACKWARD)
    }
    function itemClick(e){
        debugger
        data.content.innerHTML = '';

        
        const post_data = {
            'denuncia_tipo' : e.target.dataset.pageId,
            'post_id' : data.current.postId
        }

        $.ajax({
            url : '{{route("denunciar")}}',
            method : 'POST',
            headers: {
                'Authorization':'Bearer {{auth()->user()->api_token}}'
            },
            data : post_data,
            success: ()=>{
                const wrapper = document.createElement('div');
                const h1 = document.createElement('h1');
                h1.innerText = '{{__("view.report.sucess")}}'
                const text = document.createElement('p');
                text.innerText = '{{__("view.report.sucess_text")}}'
                wrapper.append(h1)
                wrapper.append(text)
                data.content.append(wrapper)
            },
            error : ()=>{
                debugger
                const h1 = document.createElement('h1');
                h1.innerText = '{{__("view.report.error")}}'
                data.content.append(h1)
            }
        })

    }

    function getCurrentPage(){
        var next_page = pages;
        data.currentPage.forEach(page => {
            next_page = next_page[page].children;
        });
        return next_page;
    }
    function  nextPage(e){
        const next_page_id = e.currentTarget.dataset.pageId;
        data.content.classList.add('reverse')
        data.currentPage.push(next_page_id);
        const pages = getCurrentPage();
        mountPage(pages)
    }

    function onMount(e){
        data.content = modal.content.querySelector('#content');
        mountPage(pages , null ,true);
        modal.content.querySelector('#modal-denunciar-nome-usuario').innerText = e.target.dataset.username
        data.current = e.target.dataset;
    }
    
    function onUnMount(){
        data.current = null
        data.currentPage = []
        
    }
    return {
        type: 'modal-denunciar',
        open_button : 'modal-denunciar-button',
        onMount,
        onUnMount,
        ...info
    }
};

function setupModal() {
    const modal_data = {
        mounted: false,
        open : false,
        overlay : document.getElementById('modal-overlay'),
        button : document.getElementById('modal-close'),
        content : document.getElementById('modal-content'),
        active : null,
        toggle
    }

    function toggle(){
        if(!modal_data.mounted){
            init()
        }
        modal_data.open = !modal_data.open;

        modal_data.overlay.toggleAttribute('active')
    }
    
    function init(){
        document.getElementById('modal-close').addEventListener('click',(e)=>{
            toggle();
        })
    }

    function mount(template_name){
        while (modal_data.content.lastChild.id !== 'modal-close') {
            modal_data.content.removeChild(modal_data.content.lastChild);
        }
        const template = document.getElementById(template_name);
        const modal_content = template.content.cloneNode(true)
        modal_data.content.dataset.active = template_name
        modal_data.content.append(modal_content);
    }

    return function createModal(driver_function){
        const driver = driver_function(modal_data);

        !driver.init || driver.init();

        Array.from(document.getElementsByClassName(driver.open_button)).map((el)=>{
            el.addEventListener('click',(e)=>{
                !modal_data.active?.onUnMount || modal_data.active.onUnMount();
                modal_data.active = driver;
                mount(driver.type);
                toggle()
                !driver?.onMount || driver.onMount(e)
            })
        })
        
    
        return {
            content : modal_data.content,
            button : modal_data.button,
            overlay : modal_data.overlay,
            data : modal_data,
            toggle,
        }
    }
}
</script>

</html>
