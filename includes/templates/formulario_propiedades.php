<fieldset>
    <legend>Información General</legend>

    <label for="titulo">Título</label>
    <input type="text" id="titulo" name="propiedad[titulo]" placeholder="Título Propiedad" value="<?php echo s($propiedad->titulo); ?>">

    <label for="precio">Precio</label>
    <input type="number" id="precio" name="propiedad[precio]" placeholder="Precio Propiedad" value="<?php echo s($propiedad->precio); ?>">

    <label for="imagen">Imagen</label>
    <input type="file" id="imagen" accept="image/jpeg, image/png" name="propiedad[imagen]"> 

    <?php if($propiedad->imagen): ?>

        <img src="/imagenes/<?php echo $propiedad->imagen ?>" alt="" class="imagen-small">

    <?php endif; ?>


    <!-- accept nos ayuda a limitar los archivos que puede subir el usuario -->
    <!--cada navegador interpreta la interfaz de file-->

    <label for="descripcion">Descripción</label>
    <textarea  id="descripcion" name="propiedad[descripcion]" cols="30" rows="10"><?php echo s($propiedad->descripcion); ?></textarea>
</fieldset>

<fieldset>
    <legend for="habitaciones">Habitaciones</legend>
    <input 
    type="number" 
    id="habitaciones" 
    name="propiedad[habitaciones]" 
    placeholder="Ej: 3" 
    min="1" 
    max="9" 
    value="<?php echo s($propiedad->habitaciones); ?>">

    <legend for="wc">Baños</legend>
    <input 
    type="number" 
    id="wc" 
    name="propiedad[wc]" 
    placeholder="Ej: 3" 
    min="1" 
    max="9" 
    value="<?php echo s($propiedad->wc); ?>">

    <legend for="estacionamiento">Estacionamiento</legend>
    <input type="number" id="estacionamiento" name="propiedad[estacionamiento]" placeholder="Ej: 3" min="1" max="9" value="<?php echo s($propiedad->estacionamiento); ?>">

</fieldset>

<fieldset>
    <legend>Vendedor</legend>
    
</fieldset>