<?php 
require '../includes/app.php';
estaAutenticado();
use App\Propiedad;
//Implementando método para obtener propiedades
$propiedades= Propiedad::all();


//Muestra un mensaje condicional
$msj= $_GET["registrado"] ?? null; //Busca este valor y si no lo encuentra le asigna null

//Eliminando
if ($_SERVER['REQUEST_METHOD']=== 'POST') {
    $id= $_POST['id'];
    $id= filter_var($id,FILTER_VALIDATE_INT);
    if ($id) {

          //Eliminando el archivo de la imagen
          $query="SELECT imagen FROM propiedades where id= ${id}";
          $resultado= mysqli_query($db,$query);
          $propiedad= mysqli_fetch_assoc($resultado);
          $carpertaImg='../imagenes/';
          unlink($carpertaImg. $propiedad['imagen']);

        //Elimina la propiedad de la db
        $query= "DELETE FROM propiedades where id= ${id}";
        $resultado= mysqli_query($db, $query);
        if ($resultado) {
            header('location: /bienes_raices/admin?registrado=3');
        }
      
        
    }
}

incluirTemplate('header');
?>
    <main class="contenedor seccion">
        <h1>Administrador de bienes raíces</h1>
        <?php if ($msj==1): ?>
         <p class="alerta exito"> Anuncio Creado Correctamente</p>
         <?php elseif($msj==2): ?>
            <p class="alerta exito"> Anuncio Actualizado Correctamente</p>
            <?php elseif($msj==3): ?>
            <p class="alerta exito"> Anuncio Eliminado Correctamente</p>
         <?php endif; ?>
        <a href="/bienes_raices/admin/propiedades/crear.php" class="anuncio__btn--verde">Nueva propiedad</a>
        <div class="tabla">
           <table class="propiedades">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Titulo</th>
                    <th>Imagen</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>

            </thead>
            <tbody> <!--Se muestran resultados -->
            <?php foreach( $propiedades as $propiedad ): ?>
                <tr>
                    
                        <td class="propiedades__num"><?php echo $propiedad->id; ?></td>
                        <td><?php echo $propiedad->titulo; ?></td>
                        <td><img src="../imagenes/<?php echo $propiedad->imagen; ?>" alt="imagen de <?php echo $propiedad->titulo; ?>"></td>
                        <td class="center"> $<?php echo $propiedad->precio; ?></td>
                        <td>
                            <form method="POST" class="w-100">
                                <input type="hidden" name="id" id="id" value="<?php echo $propiedad->id ?>">
                            <input type="submit" value="Eliminar" class="btn__block--rojo">
                            </form>
                           
                            <a href="propiedades/actualizar.php?id=<?php echo $propiedad->id; ?>" class="btn__block--amarillo">Actualizar</a>
                        </td>
                   
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table> 
        </div>
        
    </main>

    
    <?php
    //Cerramos conexión  
    mysqli_close($db);
incluirTemplate('footer');
 ?>