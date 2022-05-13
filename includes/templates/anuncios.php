<?php 
//importar bd
$db= conectarDB();
//consultar
$query="SELECT * from propiedades LIMIT ${limite}";
//obtner bd
$result= mysqli_query($db, $query);

?>

<div class="contenedor__anuncios">
    <?php while($propiedad=mysqli_fetch_assoc($result)): ?>
            <div class="anuncio">
                <picture>
                   <img src="imagenes/<?php echo $propiedad['imagen']; ?>" alt="anuncio1" loading="lazy">
                <picture>
                <div class="anuncio__contenido">
                    <h3><?php echo $propiedad['titulo']; ?></h3>
                    <p><?php echo $propiedad['descripcion']; ?></p>
                    <p class="precio"> $<?php echo $propiedad['precio']; ?></p>
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
                     <a class="anuncio__btn" href="anuncio.php?id=<?php echo $propiedad['id']; ?>">
                         Ver Propiedad
                     </a>
                </div><!--Contenido anuncio-->
            </div>  <!--Anuncio-->
            <?php endwhile;?>
        </div><!--Contenedor Anuncio-->
        <?php mysqli_close($db);?>