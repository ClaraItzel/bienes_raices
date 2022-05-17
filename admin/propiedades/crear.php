<?php 
require '../../includes/app.php';
use App\Propiedad;
use Intervention\Image\ImageManagerStatic as Imge;
estaAutenticado();
$db=conectarDB();

//consulta
$consulta= "SELECT * FROM vendedores";
$resConsulta= mysqli_query($db,$consulta);

//iniciando variables
$titulo ='';
$precio ='';
$descripcion ='';
$habitaciones ='';
$wc ='';
$estacionamiento ='';

//Arreglo con msj de error
$errores=Propiedad::getErrores();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $propiedad= new Propiedad($_POST);
    //subiendo archivos

 
    //Generar un nombre unico a las imagenes
    $nombreImagen= md5( uniqid( rand(), true )).'.jpg';
      //Asignar files a una variable
        $img=$_FILES["imagen"];


        //Realiza un resize a la imagen con intervetion
        if ($img['tmp_name']) {
        $imagen= Imge::make($img['tmp_name'])->fit(800,600);
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
  if ($resultado) {
      header('Location:/bienes_raices/admin?registrado=1');
  } 
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
            <fieldset>
                <legend>Información General</legend>
                <label for="titulo">Titulo:</label>
                <input type="text" id="titulo" name='titulo' placeholder="Ej. Casa en CDMX" value="<?php echo $titulo; ?>">
                
                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" placeholder="Ej. 5000000" min="400000" value="<?php echo $precio; ?>">
                
                <label for="img">Imagen</label>
                <input type="file" id="img" accept="image/jpeg" name="imagen">

                <label for="descripcion">Descripción</label>
                <textarea name="descripcion" id="descripcion" ><?php echo $descripcion; ?></textarea>


            </fieldset>
            <fieldset>
                <legend>Información propiedad</legend>
                <label for="habitaciones">Habitaciones:</label>
                <input name="habitaciones" value="<?php echo $habitaciones; ?>" type="number" id="habitaciones"  min="1"  max="15" placeholder="Ej. 5">
                <label for="wc">Baños:</label>
                <input name="wc" type="number" id="wc" value="<?php echo $wc; ?>"  min="1"  max="15" placeholder="Ej. 5">
                <label for="estacionamiento">Estacionamientos:</label>
                <input name="estacionamiento" value="<?php echo $estacionamiento; ?>" type="number" id="estacionamiento"  min="1"  max="15" placeholder="Ej. 5">
            </fieldset>
            <fieldset>
                <legend>Vendedor</legend>
                <select name="vendedorId">
                    <option  value="0" selected disabled> --- Selecciona un vendedor ---</option>
                    <?php while($row= mysqli_fetch_assoc($resConsulta)): ?>
                         <?php 
                         if (!isset($_POST['vendedor'])) {
                            $vendedor=0;
                        }else{
                            $vendedor=$_POST['vendedor'];
                        } ?>
                        <option  <?php echo $vendedor==$row['id']? 'selected' :''; ?> value="<?php echo $row['id'] ?>"><?php echo $row['nombre']." ".$row['apellidos'] ?></option>
                    <?php endwhile ?>
                </select>
            </fieldset>
            <input type="submit" class="anuncio__btn" value="Crear propiedad">
        </form>
       
    </main>
    <?php  
incluirTemplate('footer');
 ?>