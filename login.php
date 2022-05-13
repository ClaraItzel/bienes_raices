<?php 
require 'includes/app.php';

$db= conectarDB();
$errores=[];

if ($_SERVER['REQUEST_METHOD']==='POST') {

    $email= mysqli_real_escape_string( $db,filter_var( $_POST["email"], FILTER_VALIDATE_EMAIL));
    $pass= mysqli_real_escape_string($db, $_POST["pass"]);


if (!$email) {
    $errores[]="El email es obligatorio o es inválido";
}
if (!$pass) {
    $errores[]="Tienes que poner un password";
}
if (empty($errores)) {
    //Revisando si el usuario existe
    $query = "SELECT * FROM usuarios WHERE email='${email}'";
    $result= mysqli_query($db,$query);
    if($result->num_rows){
        //Revisando si es password es correcto
        $usuario= mysqli_fetch_assoc($result);
        //verficar si el password existe
        $auth= password_verify($pass, $usuario['password']);
        if ($auth) {
            //Cuando el usuario de autentica
            session_start();

            //llenar arreglo en la sesion
            $_SESSION['usuario']= $usuario['email'];
            $_SESSION['login']= true;
            
            echo '<meta http-equiv="refresh" content="0;url=/bienes_raices/admin">';
        }else{
            $errores[]='El usuario o la contraseña son incorrectos';
        }
    }else{
        $errores[]= "El usuario no existe";
    }
}
}
//Incluye el header

incluirTemplate('header');
$auth= $_SESSION['login'] ?? false;
if ($auth) {
    header('location: /bienes_raices/');
}
?>
    <main class="contenedor seccion contenido-centrado">
        <h1>Iniciar sesión</h1>
        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>
        <form method="POST" class="form">
        <fieldset>
             <legend>Email y Password</legend>
            
             <label for="email"> Email</label>
             <input type="email" placeholder="Ej. correo@correo.com" required id="email" name="email">
             <label for="pass"> Password</label>
             <input type="password" placeholder="Pon tu password" required id="password" name="pass">
            
         </fieldset>
         <input type="submit" value="Iniciar sesión" class="btn anuncio__btn--verde">
        </form>
    </main>
    <?php  
 include "includes/templates/footer.php"
 ?>