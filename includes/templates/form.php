<fieldset>
    <legend>Información General</legend>
    <label for="titulo">Titulo:</label>
    <input name="titulo" type="text" id="titulo" placeholder="Titulo Propiedad" value="<?php echo s($propiedad->titulo); ?>">

    <label for="precio">Precio: </label>
    <input name="precio" type="number" id="precio" placeholder="Precio" value="<?php echo s($propiedad->precio); ?>">

    <label for="imagen">Imagen: </label>
    <input name="imagen" type="file" id="imagen">
    
    <?php if($propiedad->imagen): ?>
        <img src="/imagenes/<?php echo s($propiedad->precio); ?>" alt="Imagen actual" class="imagen-tabla">
    <?php endif; ?>

    <label for="descripcion">Descripción:</label>
    <textarea name="descripcion" id="descripcion"><?php echo s($propiedad->descripcion) ; ?></textarea>

</fieldset>


<fieldset>
    <legend>Información Propiedad</legend>

    <label for="habitaciones">Habitaciones:</label>
    <input name="habitaciones" type="number" min="1" max="10" step="1" id="habitaciones" value="<?php echo s($propiedad->habitaciones); ?>">

    <label for="toilet">Baños:</label>
    <input name="toilet" type="number" min="1" max="10" step="1" id="toilet" value="<?php echo s($propiedad->toilet); ?>">

    <label for="garage">garage:</label>
    <input name="garage" type="number" min="1" max="10" step="1" id="garage" value="<?php echo s($propiedad->garage); ?>">

    <legend>Información Vendedor:</legend>
    <label for="nombre_vendedor">Nombre:</label>

    <select name="vendedorId" id="nombre_vendedor">
        <option selected value="">-- Seleccione --</option>
        <option value="1">1</option>
        <?php while ($resultado) : ?>
            <option <?php echo $vendedorId === $resultado['idvendedores'] ? 'selected' : '' ?> value="<?php echo $resultado['idvendedores']; ?>"><?php echo $row['nombre'] . " " . $row['apellido']; ?>
            <?php endwhile; ?>
    </select>

</fieldset>
<?php
echo "<pre>";
echo var_dump($resultado);
echo "</pre>";
?>