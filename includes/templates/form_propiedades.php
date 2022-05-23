
<fieldset>
                <legend>Información General</legend>
                <label for="titulo">Titulo:</label>
                <input type="text" id="titulo" name='propiedad[titulo]' placeholder="Ej. Casa en CDMX" value="<?php echo s($propiedad->titulo); ?>">
                
                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="propiedad[precio]" placeholder="Ej. 5000000" min="400000" value="<?php echo s($propiedad->precio); ?>">
                
                <label for="img">Imagen</label>
                <input type="file" id="img" accept="image/jpeg" name="propiedad[imagen]">
                <?php if(!empty( $propiedad->imagen)): ?>
                    <img src="../../imagenes/<?php echo $propiedad->imagen; ?>" alt="<?php echo s($propiedad->titulo);?>" class="small">
                <?php endif;?>
                <label for="descripcion">Descripción</label>
                <textarea name="propiedad[descripcion]" id="descripcion" ><?php echo s($propiedad->descripcion); ?></textarea>


            </fieldset>
            <fieldset>
                <legend>Información propiedad</legend>
                <label for="habitaciones">Habitaciones:</label>
                <input name="propiedad[habitaciones]" value="<?php echo s($propiedad->habitaciones); ?>" type="number" id="habitaciones"  min="1"  max="15" placeholder="Ej. 5">
                <label for="wc">Baños:</label>
                <input name="propiedad[wc]" type="number" id="wc" value="<?php echo s($propiedad->wc); ?>"  min="1"  max="15" placeholder="Ej. 5">
                <label for="estacionamiento">Estacionamientos:</label>
                <input name="propiedad[estacionamiento]" value="<?php echo s($propiedad->estacionamiento); ?>" type="number" id="estacionamiento"  min="1"  max="15" placeholder="Ej. 5">
            </fieldset>
            <fieldset>
                <legend>Vendedor</legend>
                 <select name="propiedad[vendedorId]" id="vendedor"> 
                    <option  value="0" selected disabled> --- Selecciona un vendedor ---</option>
                    <?php foreach($vendedores as $vendedor):
                        ?>
                         
                        <option  <?php echo $propiedad->vendedorId==$vendedor->id? 'selected' :''; ?> value="<?php echo s($vendedor->id) ?>"><?php echo s($vendedor->nombre)." ".s($vendedor->apellidos) ?></option>
                    <?php endforeach; ?>
                </select>
            </fieldset>