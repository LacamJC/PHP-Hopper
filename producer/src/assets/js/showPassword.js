const checkbox = document.getElementById('show');
checkbox.addEventListener('click', () => {
    let status = checkbox.checked;
    if (status) {
        if(document.getElementById('senha')){
            document.getElementById('senha').type = "text";
        }
        if(document.getElementById('confirma_senha')){
            document.getElementById('confirma_senha').type = "text";
        }
    } else {
        if(document.getElementById('senha')){
            document.getElementById('senha').type = "password";
        }
        if(document.getElementById('confirma_senha')){
            document.getElementById('confirma_senha').type = "password";
        }
    }
})