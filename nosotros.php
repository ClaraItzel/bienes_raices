<?php 
require 'includes/funciones.php';
incluirTemplate('header');
?>
    <main class="contenedor seccion seccion-nostros">
        <h1 class="seccion__titulo">Conoce Sobre Contacto</h1>
        <section class="nosotros">
            <div class="nosotros__img">
                <picture>
                    <source srcset="build/img/nosotros.webp" type="image/webp">
                    <source srcset="build/img/nosotros.jpg" type="image/jpg">
                     <img src="build/img/nosotros.jpg" loading="lazy" alt="sobre nosotros">
                </picture>
            </div>
            <div class="nosotros__txt">
                <p class="nosotros__txt-bold">25 Años de experiencia</p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt ratione consequuntur temporibus, nisi excepturi aliquam a magnam suscipit, nam quae iste? Aspernatur quae eius odit, quos obcaecati ipsam numquam perferendis possimus ullam, laudantium aliquid maiores, dolore iusto dignissimos sapiente voluptatum odio doloribus eveniet quisquam nihil aperiam perspiciatis suscipit. Quam magnam odit unde molestias voluptate, laboriosam pariatur, dolorem, quidem debitis quos officia! Tempore aliquid minus praesentium, officiis asperiores minima fugit nulla numquam molestias totam hic esse, pariatur laudantium quas voluptas inventore!
                </p>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dolor maiores odit, aspernatur labore veritatis nobis possimus assumenda cumque provident deleniti omnis impedit in natus quasi commodi numquam, doloremque, at officiis temporibus aliquid. Delectus, mollitia sapiente ducimus maiores, doloremque, alias placeat molestiae natus eum quidem ab a illo esse beatae quaerat.</p>
            </div>
        </section>
    </main>
    <?php  
    incluirTemplate('footer');
 ?>