<?php 
require '../../includes/app.php';
use App\Propiedad;
use App\Vendedor;
use Intervention\Image\ImageManagerStatic as Imge;
estaAutenticado();
$db=conectarDB();
//Creando una propiedad vacía
$propiedad= new Propiedad;

//Consulta para obtener vendedores
$vendedores= Vendedor::all();



//Arreglo con msj de error
$errores=Propiedad::getErrores();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    $propiedad= new Propiedad($_POST['propiedad']);
    //subiendo archivos
   
 
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
       
    $errores= $propiedad->validar();

if (empty($errores)) {
    
   
       /*Primero creamos una carpeta */

       if(!is_dir(CARPETA_IMAGENES)){
          mkdir(CARPETA_IMAGENES); 
       }
   //Guarda la imagen en el servidor
   $imagen->save( CARPETA_IMAGENES .$nombreImagen);
       //GUarda en bd
  $resultado= $propiedad->guardar(); 
 
}


}

incluirTemplate('header');
?>
    <main class="contenedor seccion">
        <h1>Crear</h1>
        <a href="/bienes_raices/admin/" class="anuncio__btn--verde">Volver</a>
        <?php foreach ($errores as $error): ?>
        <?php echo '<p class="alerta error">'.$error.'</p>';?>
           <?php endforeach; ?>
        <form class="form" method="POST" action="crear.php" enctype="multipart/form-data">
            <?php include '../../includes/templates/form_propiedades.php'; ?>
            <input type="submit" class="anuncio__btn" value="Crear propiedad">
        </form>
       
    </main>
    <?php  
incluirTemplate('footer');
 ?>