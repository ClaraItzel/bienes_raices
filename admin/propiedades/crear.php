<?php 
require '../../includes/app.php';
use App\Propiedad;
$propiedad= new Propiedad;
debuggeando($propiedad);
$auth=estaAutenticado();
if(!$auth){
    header('Location: /bienes_raices');
}

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
$errores=[];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
/*     echo"<pre>";
var_dump($_POST);
echo"</pre>";*/
    echo"<pre>";
var_dump($_FILES);
echo"</pre>";

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

if (!$img["name"]) {
    $errores[]='La imagen es obligatoria';
}
//Validando por tamaño
$medida= 3000 * 100;
if ($img["size"]>$medida || $img['error']) {
    $errores[]='La imagen es muy pesada';
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
    //Generar un nombre unico a las imagenes
    $nombreImagen= md5( uniqid( rand(), true )).'.jpg';
    //subiendo la imagen

    move_uploaded_file($img["tmp_name"],$carpertaImg.$nombreImagen);

    


    if (!isset($_POST['vendedor'])) {
        $vendedor=0;
    }else{
        $vendedor=mysqli_real_escape_string($db,$_POST['vendedor']);
    }
    
    //insertar en la bd
    $query ="INSERT INTO propiedades (titulo, precio,imagen,descripcion,habitaciones,wc,estacionamientos,creado,vendedorId)
    Values('$titulo', '$precio','$nombreImagen','$descripcion','$habitaciones','$wc','$estacionamiento','$creado','$vendedor')";
    echo $query;
    $resultado= mysqli_query($db,$query);
    if ($resultado) {
       //Se redirecciona al usuario
        header('location: /bienes_raices/admin?msj=registadoCorrectamente&registrado=1');
    }
}else{
    echo 'no se inserto nada';
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
                <select name="vendedor">
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