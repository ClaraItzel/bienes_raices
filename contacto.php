<?php 
require 'includes/app.php';
incluirTemplate('header');
?>
    <main class="contenedor seccion contenido-centrado">
        <h1>Contacto</h1>
        <picture>
            <source srcset="build/img/destacada3.webp" type="image/webp">
            <source srcset="build/img/destacada3.jpg" type="image/jpg">
            <img src="build/img/destacada3.jpg" alt="formulario" loading="lazy">
        </picture>
     <form class="form">
         <fieldset>
             <legend>Informacion personal</legend>
             <label for="nombre"> Nombre</label>
             <input type="text" placeholder="Ej. Juan" id="nombre">
             <label for="email"> Email</label>
             <input type="email" placeholder="Ej. correo@correo.com" id="email">
             <label for="tel"> Telefono</label>
             <input type="tel" placeholder="Ej. +52 12-34-56-78" id="tel">
             <label for="msj"> Mensaje</label>
             <textarea name="" id="msj" ></textarea>
         </fieldset>
         <fieldset>
             <legend>Información sobre la propiedad</legend>
             <label for="opc"> Vende o compra</label>
             <select id="opc">
                 <option value="" selected disabled>--Seleccione--</option>
                 <option value="Compra">Compra</option>
                 <option value="Vende">Vende</option>
           
             </select>
             <label for="precio"> Precio o presupuesto</label>
             <input type="number" placeholder="Ej. +52 12-34-56-78" id="precio">
         </fieldset>
         <fieldset>
             <legend>
                 Información sobre la propiedad
             </legend>
             <p>¿Cómo desea ser contactado?</p>
             <div class="contacto">
                 <label for="contactar__tel">Teléfono</label>
                 <input name="contacto" type="radio" value="Teléfono" id="contacto__tel">

                <label for="contactar__mail">Email</label>
                 <input name="contacto" type="radio" value="Email" id="contacto__mail">
             </div>
             <p>Si eligio teléfono, elija la fecha y la hora</p>
             <label for="fecha"> Fecha</label>
             <input type="date" id="fecha">
             <label for="hora"> Hora</label>
             <input type="time" id="hora" min="09:00" max="21:00">

         </fieldset>
         <input type="submit" class="anuncio__btn--verde" value="Enviar">
     </form>
    </main>
    <?php  
    incluirTemplate('footer');
 ?>