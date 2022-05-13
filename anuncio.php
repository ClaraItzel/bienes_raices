<?php 
require 'includes/app.php';
$db= conectarDB();

incluirTemplate('header');
$id=filter_var($_GET['id'],FILTER_VALIDATE_INT) ;
if(!$id){
    header('location: /bienes_raices');
}
$consulta="Select * from propiedades where id= ${id}";
$result= mysqli_query($db, $consulta);

$propiedad=mysqli_fetch_assoc($result);
$numRows=mysqli_num_rows($result);

if ($numRows==0) {
    header('location: /bienes_raices');
}
?>
    <main class="contenedor seccion contenido-centrado">
        <h1>
        <?php echo $propiedad['titulo']; ?>
        </h1>
        
            <img src="imagenes/<?php echo $propiedad['imagen']; ?>" alt="Casa en frente del bosque" loading="lazy">
        
        <div class="propiedadTxt">
            <p class="precio">$<?php echo $propiedad['precio']; ?></p>
            <ul class="anuncio__iconos">
                <li>
                    <picture>
                        <source srcset="build/img/wc.webp" type="image/webp">
                        <source srcset="build/img/wc.jpg" type="image/jpg">
                        <img src="build/img/wc.jpg" alt="Cantidad de baños" loading="lazy">
                    </picture>
                    <p><?php echo $propiedad['wc']; ?></p>
                </li>
            
                <li>
                    <picture>
                        <source srcset="build/img/coche.webp" type="image/webp">
                        <source srcset="build/img/coche.jpg" type="image/jpg">
                        <img src="build/img/coche.jpg" alt="Cantidad de estacionamientos" loading="lazy">
                    </picture>
                    <p><?php echo $propiedad['estacionamientos']; ?></p>
                </li>
              
                <li>
                    <picture>
                        <source srcset="build/img/cama.webp" type="image/webp">
                        <source srcset="build/img/cama.jpg" type="image/jpg">
                        <img src="build/img/cama.jpg" alt="Cantidad de dormitorios" loading="lazy">
                    </picture>
                   <p><?php echo $propiedad['habitaciones']; ?></p> 
                </li>
             </ul>
             <?php echo $propiedad['descripcion']; ?>
        </div>
    </main>
    <?php  
    mysqli_close($db);
incluirTemplate('footer');
 ?>