<?php
class LoginView {
//mostrar formulario de login con posible mensaje de error
public function showLogin($error = null){
    include "Template/login.phtml";
}
function showMessage(){
    include "Template/msg.phtml";
}
}