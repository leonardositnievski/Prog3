<div id='modal-overlay'>
    <div id='modal-content'>
        <div class="bi bi-x-lg" id='modal-close'></div>

    </div>
</div>

<template id='modal-denunciar-post'>
    <h1>Denunciar publicação</h1>
    <p>Por que você acha que a publicação de <span id='modal-denunciar-nome-usuario'></span> não segue as <a href='#'> Regras da comunidade</a>?</p>
    <div id="content" class='reverse'>

    </div>
</template>

<template id='modal-denunciar-comment'>
    <h1>Denunciar comentario</h1>
    <p>Por que você acha que o comentario de <span id='modal-denunciar-nome-usuario'></span> não segue as <a href='#'> Regras da comunidade</a>?</p>
    <div id="content" class='reverse'>

    </div>
</template>


<template id='modal-avaliar'>
    <h1>Avaliar Publicação</h1>
    <p>O que você achou da publicação de <span id='modal-avaliar-nome-usuario'></span></p>
    <div id="modal-avaliar-content" class='reverse'>
        <div class='star'>
            <div class="half-star"></div>
            <i class="bi bi-star"></i>
            <div class="half-star"></div>
        </div>
        <div class='star'>
            <div class="half-star"></div>
            <i class="bi bi-star"></i>
            <div class="half-star"></div>
        </div>
        <div class='star'>
            <div class="half-star"></div>
            <i class="bi bi-star"></i>
            <div class="half-star"></div>
        </div>
        <div class='star'>
            <div class="half-star"></div>
            <i class="bi bi-star"></i>
            <div class="half-star"></div>
        </div>
        <div class='star'>
            <div class="half-star"></div>
            <i class="bi bi-star"></i>
            <div class="half-star"></div>
        </div>
    </div>
    <form class='default'>

        <div class="form-group">
            <x-TextArea rows='4' name='avaliacao_texto' placeholder='Avaliação'/>
        </div>

        <div class="form-group-buttons">
            <button type="submit">{{__('view.post.actions.rate.button')}}</button>
        </div>

    </form>
</template>
