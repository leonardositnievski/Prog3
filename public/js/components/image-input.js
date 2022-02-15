document.addEventListener('DOMContentLoaded', () => {

    const element = document.querySelectorAll('form.default input[type="file"]')
    Array.from(element).map((el)=> el.addEventListener('change', handleChange))

    function handleChange(e){
        const image = document.querySelector('.form-image[for="'+e.target.id+'"]');
        if (e.target.files[0]) {
            const url = URL.createObjectURL(e.target.files[0])
            image.classList.add('active')
            image.style.backgroundImage = 'url('+url+')'
            return
        }
        image.classList.remove('uploaded')
        image.style.backgroundImage = 'url()'
    }
})