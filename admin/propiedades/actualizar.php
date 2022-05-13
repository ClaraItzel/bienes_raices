<?php 
require '../../includes/funciones.php';
$auth=estaAutenticado();
if(!$auth){
    header('Location: /bienes_raices');
}
 $id= filter_var($_GET['id'], FILTER_VALIDATE_INT) ;


 if (!$id) {
     header('location: /bienes_raices/admin');
 }
 
//conexion a bd
require '../../includes/config/database.php';
$db=conectarDB();
//Obteniendo propiedades
$consultaProp="SELECT * FROM propiedades WHERE id=".$id;
$resultadoProp= mysqli_query($db,$consultaProp);
$propiedad= mysqli_fetch_assoc($resultadoProp);
if (!$propiedad) {
    header('location: /bienes_raices/admin');
}
//consulta
$consulta= "SELECT * FROM vendedores";
$resConsulta= mysqli_query($db,$consulta);

//iniciando variables
$titulo =$propiedad['titulo'];
$precio =$propiedad['precio'];
$descripcion =$propiedad['descripcion'];
$habitaciones =$propiedad['habitaciones'];
$wc =$propiedad['wc'];
$estacionamiento =$propiedad['estacionamientos'];
$vendedor=$propiedad['vendedorId'];
$imgPropiedad=$propiedad['imagen'];

//Arreglo con msj de error
$errores=[];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
/*     echo"<pre>";
var_dump($_POST);
echo"</pre>";*/


$titulo =mysqli_real_escape_string($db,$_POST['titulo']);
$precio =mysqli_real_escape_string($db,$_POST['precio']);
$descripcion =mysqli_real_escape_string($db,$_POST['descripcion']);
$habitaciones =mysqli_real_escape_string($db,$_POST['habitaciones']);
$wc =mysqli_real_escape_string($db,$_POST['wc']);
$estacionamiento =mysqli_real_escape_string($db,$_POST['estacionamiento']);
$creado= date('Y/m/d');

//Asignar files a una variable
$img=$_FILES["imagen"];

if (!isset($_POST['vendedor'])) {
    $vendedor=0;
}else{
    $vendedor=mysqli_real_escape_string($db,$_POST['vendedor']);
}


//Validando por tamaño
$medida= 3000 * 100;
if ($img["size"]>$medida ) {
    $errores[]='La imagen es muy pesada '.$img["size"];
}
 
if(!$titulo){
    $errores[]= "Debes añadir un titulo";
}
if (!$precio) {
    $errores[]= 'El precio es obligatorio';
}
if (strlen($descripcion) <50) {
    $errores[]='La descripción es obligatoria y debe tener almenos 50 caracteres';
}
if (!$habitaciones) {
    $errores[]='El numero de habitaciones es obligatorio';
}
if (!$wc) {
    $errores[]='El numero de baños es obligatorio';
}
if (!$habitaciones) {
    $errores[]='El numero de lugares de estacionamiento es obligatorio';
}
if ($vendedor=0) {
    $errores[]='Selecciona un vendedor';
}
/*  echo"<pre>";
var_dump($errores);
echo"</pre>"; */



if (empty($errores)) {
//subiendo archivos
/*Primero creamos una carpeta */
     $carpertaImg='../../imagenes/';
    if(!is_dir($carpertaImg)){
      mkdir($carpertaImg); 
    }
    $nombreImagen='';
    if ($img['name']) {
        unlink($carpertaImg. $propiedad['imagen']);
          //Generar un nombre unico a las imagenes
     $nombreImagen= md5( uniqid( rand(), true )).'.jpg';
     //subiendo la imagen
 
     move_uploaded_file($img["tmp_name"],$carpertaImg.$nombreImagen);
    }else{
        $nombreImagen=$propiedad['imagen'];
    }

     
   

    


    if (!isset($_POST['vendedor'])) {
        $vendedor=0;
    }else{
        $vendedor=mysqli_real_escape_string($db,$_POST['vendedor']);
    }
    
    //insertar en la bd
    $query ="UPDATE propiedades SET titulo='${titulo}',
            precio='${precio}', imagen='${nombreImagen}', descripcion='${descripcion}',
            habitaciones=${habitaciones},wc=${wc},estacionamientos=${estacionamiento},
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
            <fieldset>
                <legend>Información General</legend>
                <label for="titulo">Titulo:</label>
                <input type="text" id="titulo" name='titulo' placeholder="Ej. Casa en CDMX" value="<?php echo $titulo; ?>">
                
                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" placeholder="Ej. 5000000" min="400000" value="<?php echo $precio; ?>">
                
                <label for="img">Imagen:</label>
                <input type="file" id="img" accept="image/jpeg" name="imagen">
                <img class="small" src="../../imagenes/<?php echo $imgPropiedad ?>" alt="">
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
                <select name="vendedor">
                    <option  value="0"  disabled> --- Selecciona un vendedor ---</option>
                    <?php while($row= mysqli_fetch_assoc($resConsulta)): ?>
                        
                        <option  <?php echo $vendedor==$row['id']? 'selected' :''; ?> value="<?php echo $row['id'] ?>"><?php echo $row['nombre']." ".$row['apellidos'] ?></option>
                    <?php endwhile ?>
                </select>
            </fieldset>
            <input type="submit" class="anuncio__btn" value="Actualizar propiedad">
        </form>
       
    </main>
    <?php  
incluirTemplate('footer');
 ?>