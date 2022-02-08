


document.addEventListener('DOMContentLoaded', function(event){
    Array.from(document.querySelectorAll('form.default input')).map((el)=>{
        if (el.type === 'hidden') {
            return
        }
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

        function removeError(element){
            element.classList.remove('error')
            const errorMessage = document.querySelector(`.form-input-error[for=${element.name}]`);
            if (errorMessage) {
                errorMessage.remove()
            }
        }
    })
})