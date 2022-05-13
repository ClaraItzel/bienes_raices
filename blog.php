<?php 
require 'includes/funciones.php';
incluirTemplate('header');
?>
    <main class="contenedor seccion contenido-centrado">
        <h1>Nuestro Blog</h1>
        <article class="blog__entrada">
            <div class="blog__imagen">
                    <picture>
                        <source srcset="build/img/blog1.webp" type="image/webp">
                        <source srcset="build/img/blog1.jpg" type="image/jpg">
                        <img src="build/img/blog1.jpg" alt="Entrada Blog" loading="lazy">
                    </picture>
            </div>            
            <div class="blog__texto">
                <a href="entrada.php">
                   <h4>
                       Terraza en el techo de tu casa 
                   </h4> 
                    </a>
                <p>Escrito el: <span> 05/04/2021</span> por <span>Juanito Torombolord</span></p>
                <p>Consejos para construir una terraza en el techo de tu casa con los mejores meteriales y ahorrando dinero</p>
            </div>    
        </article>
        <article class="blog__entrada">
            <div class="blog__imagen">
                    <picture>
                        <source srcset="build/img/blog2.webp" type="image/webp">
                        <source srcset="build/img/blog2.jpg" type="image/jpg">
                        <img src="build/img/blog2.jpg" alt="Entrada Blog" loading="lazy">
                    </picture>
            </div>            
            <div class="blog__texto">
                <a href="entrada.php">
                    <h4>
                       Guía para la decoracion de tu hogar   
                    </h4>
                   </a>
                <p>Escrito el: <span> 02/04/2021</span> por <span>Admin</span></p>
                <p>Maximiza el espacio en tu hogar con esta guía, aprende a combinar muebles y colores para darle vida a tu espacio</p>
            </div>    
        </article>
        <article class="blog__entrada">
            <div class="blog__imagen">
                    <picture>
                        <source srcset="build/img/blog3.webp" type="image/webp">
                        <source srcset="build/img/blog3.jpg" type="image/jpg">
                        <img src="build/img/blog3.jpg"alt="Entrada Blog" loading="lazy">
                    </picture>
            </div>            
            <div class="blog__texto">
                <a href="entrada.php">
                    <h4>
                       Guía para la decoracion de tu hogar   
                    </h4>
                   </a>
                <p>Escrito el: <span> 02/04/2021</span> por <span>Admin</span></p>
                <p>Maximiza el espacio en tu hogar con esta guía, aprende a combinar muebles y colores para darle vida a tu espacio</p>
            </div>    
        </article>
        <article class="blog__entrada">
            <div class="blog__imagen">
                    <picture>
                        <source srcset="build/img/blog4.webp" type="image/webp">
                        <source srcset="build/img/blog4.jpg" type="image/jpg">
                        <img src="build/img/blog4.jpg" alt="Entrada Blog" loading="lazy">
                    </picture>
            </div>            
            <div class="blog__texto">
                <a href="entrada.php">
                    <h4>
                       Guía para la decoracion de tu hogar   
                    </h4>
                   </a>
                <p>Escrito el: <span> 02/04/2021</span> por <span>Admin</span></p>
                <p>Maximiza el espacio en tu hogar con esta guía, aprende a combinar muebles y colores para darle vida a tu espacio</p>
            </div>    
        </article>
    </main>
    <?php  
    incluirTemplate('footer');
 ?>