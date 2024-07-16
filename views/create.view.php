<?php require 'header.php'; ?>

<div class="edit_tienda">
    <h2>Crear Producto</h2>
    <form action="create.php" method="post" enctype="multipart/form-data">
        <input type="text" name="nombre" placeholder="Nombre del producto" required>
        <textarea name="descripcion" placeholder="Descripción del producto" required></textarea>
        <input type="number" name="precio" placeholder="Precio del producto" required>
        <input type="number" name="stock" placeholder="Stock del producto" required>
        <select name="codcat" required>
            <option value="">Seleccionar Categoría</option>
            <?php 
            $categorias = obtener_categorias($conexion);
            foreach($categorias as $categoria) {
                echo "<option value=\"{$categoria['CodCategoria']}\">{$categoria['nombre_categoria']}</option>";
            }
            ?>
        </select>
        <input type="file" name="imagen" required>
        <input type="submit" value="Crear Producto">
    </form>
</div>

<?php require '../footer.php'; ?>