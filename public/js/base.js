
document.addEventListener('DOMContentLoaded', function(event){
    const modal = {
        mounted: false,
        open : false,
        overlay : document.getElementById('modal-overlay'),
        button : document.getElementById('modal-close'),
        content : document.getElementById('content'),
        ANIMATION_FORWARD: 'forward',
        ANIMATION_BACKWARD: 'backward',
        currentPage : [],
        pages: {
            '24':{
                text: 'Discurso de Odio',
                children : {
                    '42' : {
                        text: 'teste odio'
                    }
                }
            },
            '43':{
                text: 'Esta conta é falsa',
                children : {
                    '42' : {
                        text: 'teste falsa'
                    }
                }
            },
            '52':{
                text: 'Ele me agride',
            },
            '54':{
                text: 'Outro Motivo',
                children : {
                    '42' : {
                        text: 'teste outro motivo'
                    }
                }
            }
        },
        toggle : function(value = null){

            if(!this.mounted){
                this.init()
            }
            this.open = value ?? !this.open;

            this.overlay.removeAttribute('active')
        },
        init : function(){
            this.mountPage(this.pages , null ,true);
            this.mounted = true;
        },
        createBackButton : function(){
            const backButton = document.createElement('li');
            backButton.setAttribute('class', 'bi bi-caret-left-fill')
            backButton.innerText = 'Voltar';
            backButton.addEventListener('click', this.back)
            return backButton
        },
        mountPage : function(pageItens, direction = this.ANIMATION_FORWARD, init = false){
            const createPages = () =>{
                const ul = document.createElement('ul');
                ul.classList.add('denuncia-motivo')
                if (this.currentPage.length > 0) {
                    ul.append(this.createBackButton());
                }
                for (const id in pageItens) {
                    const page = pageItens[id];
                    const item = document.createElement('li');
                    page.children && item.classList.add('class', 'hasNextPage');
                    page.children && item.addEventListener('click', this.nextPage);
                    !page.children && item.addEventListener('click', this.itemClick);

                    // item.classList.add('class', direction === this.ANIMATION_FORWARD ? this.ANIMATION_BACK : this.ANIMATION_FORWARD);
                    
                    item.setAttribute('data-page-id', id);
                    item.innerText = page.text;
                    ul.append(item);
                }
                return ul;
            }

           
            this.content.getElementsByTagName('ul')[0]?.classList.add('toBeRemoved')
            const pages = createPages();
            this.content.append(pages)
            this.transition(direction , init);
        },
        transition: function(direction, init){
            if (init) {
                return
            }
            this.content.classList.add(direction)
            setTimeout(() => {
                this.content.classList.remove('forward')
                this.content.classList.remove('backward')
                modal.content.classList.add('reverse')

                this.content.getElementsByClassName('toBeRemoved')[0]?.remove()
            }, 500);
        },
        back : ()=>{
            modal.currentPage.pop();
            const page = modal.getCurrentPage();
            modal.content.classList.remove('reverse')
            modal.mountPage(page, modal.ANIMATION_BACKWARD)
        },
        itemClick : function(e){
            debugger
        },
        getCurrentPage: () =>{
            var next_page = modal.pages;
            modal.currentPage.forEach(page => {
                next_page = next_page[page].children;
            });
            return next_page;
        },
        nextPage : (e)=>{
            const next_page_id = e.currentTarget.dataset.pageId;
            modal.content.classList.add('reverse')
            modal.currentPage.push(next_page_id);
            const pages = modal.getCurrentPage();
            modal.mountPage(pages)
        }
    }
    modal.init();
    modal.button.addEventListener('click',(e)=>{
        modal.toggle();
    })

})
