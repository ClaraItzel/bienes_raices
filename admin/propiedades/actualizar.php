<?php

use App\Propiedad;
use Intervention\Image\ImageManagerStatic as Imge;
require '../../includes/app.php';
estaAutenticado();

 $id= filter_var($_GET['id'], FILTER_VALIDATE_INT) ;


 if (!$id) {
     header('location: /bienes_raices/admin');
 }

//Obteniendo propiedades
$propiedad= Propiedad::find($id);

//consulta
$consulta= "SELECT * FROM vendedores";
$resConsulta= mysqli_query($db,$consulta);



//Arreglo con msj de error
$errores=Propiedad::getErrores();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //Asignar atributos
    $args= $_POST['propiedad']; 
    $propiedad->sincronizar($args);
   
    
    $errores=$propiedad->validar();
 

    //Generar un nombre unico a las imagenes
    $nombreImagen= md5( uniqid( rand(), true )).'.jpg';
//Asignar files a una variable
$img=$_FILES['propiedad']["tmp_name"];

//Realiza un resize a la imagen con intervetion
if ($img['imagen']) {
$imagen= Imge::make($img['imagen'])->fit(800,600);
//Subida de archivos a la BD setteando la img
$propiedad->setImagen($nombreImagen);

}





if (empty($errores)) {


    exit;
    //insertar en la bd
    $query ="UPDATE propiedades SET titulo='${titulo}',
            precio='${precio}', imagen='${nombreImagen}', descripcion='${descripcion}',
            habitaciones=${habitaciones},wc=${wc},estacionamiento=${estacionamiento},
            vendedorId=${vendedor} where id=${id}";
   echo $query;

    $resultado= mysqli_query($db,$query);
    if ($resultado) {
       //Se redirecciona al usuario
        header('location: /bienes_raices/admin?msj=registadoCorrectamente&registrado=2');
    }
}else{
    echo 'no se inserto nada';
}


}

incluirTemplate('header');
?>
    <main class="contenedor seccion">
        <h1>Actualizar</h1>
        <a href="/bienes_raices/admin/" class="anuncio__btn--verde">Volver</a>
        <?php foreach ($errores as $error): ?>
        <?php echo '<p class="alerta error">'.$error.'</p>';?>
           <?php endforeach; ?>
        <form class="form" method="POST"  enctype="multipart/form-data">
        <?php include '../../includes/templates/form_propiedades.php'; ?>
            <input type="submit" class="anuncio__btn" value="Actualizar propiedad">
        </form>
       
    </main>
    <?php  
incluirTemplate('footer');
 ?>