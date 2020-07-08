<?php

if (isset($_SESSION['usuario'])) {
    header('Location: index.php');
}

if ($_SERVER['REQUEST_METHOD'] =='POST') {
    $usario = filter_var(strtolower($_POST['usuario']), FILTER_SANITIZE_STRING);
    $password = $_POST['password'];
    $password2 = $_POST['password2'];

    //echo "$usario . $password .$password2";
    
    $errores ='';

    if (empty($usario)or empty($password) or empty($password2)) {
        $errores .='<li>Por favor rellena todos los datos correctamente</li>';
} else {
    try {
        $conexion = new PDO('mysql: host=localhost;dbname=login_practica', 'root','');
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
      }

      $statement = $conexion->prepara('SELECT * FROM usuario WHERE usuario =:usuario LIMIT 1');
      $statament->exacute(array(':usuario'=> $usuario));
      $resultado=$statement->featch();

      if ($resultados !=false) {
          $errores .='<li>El nombre de usuario ya existe</li>';
        }

        $password = hash('sha512',$password);
        $password2 = hash('sha512',$password2);

        if ($password !=$password2){
            $errores .='<li>La contraseñas no soy iguales</li>';
        }
    }
    
    if($errores ==''){
        $statament =$conexion->prepara('INSERT INTO usuarios,(id, usuario,pass) VALUES(null,:usuario,:pass)');
        $statament->exacute(array(
            ':usuario'=>$usuario,
            'pass'=>$password
        ));

        header('Location: login.php');
    }
 }

require 'views/registrate.view.php';  

?> 