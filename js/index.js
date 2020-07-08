const usuario = document.getElementById('user');
const password = document.getElementById('pass');
const formulario = document.getElementById('formLogin');

formulario.addEventListener('submit', login);

function login(e){
    e.preventDefault();
    

    let usuarioVal= usuario.value;
    let passwordVal =password.value;

    if(usuarioval =='' || passwordVal ==''){
        creaMensaje('Verifica tus campos', 'danger');
        return;
    }

    if(localStorage.getItem('usuario')){
        let objeto = JSON.parse(localStorage.getItem('usuario'));

    if( usuarioVal == objeto.user && password == objeto.pass ){
        creaMensaje('Login Correcto', 'success');
        localStorage.setItem('sesion','activa');
        setTimeout(function(){
        window.open('./inicio.html','_self');
    }, 2000 );
    } else {
        creaMensaje('Usuario Incorecto', 'danger');
    }
 } else {
    creaMensaje('No hay registro', 'danger');
}

}
