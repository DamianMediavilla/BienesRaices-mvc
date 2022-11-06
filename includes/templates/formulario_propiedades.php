<fieldset>
    <legend>Información General</legend>

    <label for="titulo">Titulo:</label>
    <input type="text" id="titulo" name="propiedad[titulo]" placeholder="Titulo Propiedad" value="<?php echo s( $propiedad->titulo ); ?>">

    <label for="precio">Precio:</label>
    <input type="number" id="precio" name="propiedad[precio]" placeholder="Precio Propiedad" value="<?php echo s($propiedad->precio); ?>">

    <label for="imagen">Imagen:</label>
    <input type="file" id="imagen" accept="image/jpeg, image/png" name="propiedad[imagen]">

    <?php if($propiedad->imagen) { ?>
        <img src="/imagenes/<?php echo $propiedad->imagen ?>" class="imagen-small">
    <?php } ?>

    <label for="descripcion">Descripción:</label>
    <textarea id="descripcion" name="propiedad[descripcion]"><?php echo s($propiedad->descripcion); ?></textarea>

</fieldset>

<fieldset>
    <legend>Información Propiedad</legend>

    <label for="habitaciones">Habitaciones:</label>
    <input 
        type="number" 
        id="habitaciones" 
        name="propiedad[habitaciones]" 
        placeholder="Ej: 3" 
        min="1" 
        max="9" 
        value="<?php echo s($propiedad->habitaciones); ?>">

    <label for="toilet">Baños:</label>
    <input type="number" id="toilet" name="propiedad[toilet]" placeholder="Ej: 3" min="1" max="9" value="<?php echo s($propiedad->toilet); ?>">

    <label for="garage">garage:</label>
    <input type="number" id="garage" name="propiedad[garage]" placeholder="Ej: 3" min="1" max="9" 
        value="<?php echo s($propiedad->garage); ?>">

</fieldset>

<fieldset>
    <legend>Vendedor</legend>

    <select name="propiedad[vendedorId]" id="nombre_vendedor">
        <option selected value="">-- Seleccione --</option>
        <?php foreach($vendedores as $vendedor) { ?>
            <option <?php echo $propiedad->vendedorId === $vendedor->id ? 'selected' : '' ?> value="<?php echo s($vendedor->id); ?>"><?php echo s($vendedor->nombre) . " " . s($vendedor->apellido); ?>
        <?php  } ?>
    </select>

</fieldset>