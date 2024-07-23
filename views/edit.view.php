<?php require 'header.php'; ?>

<div class="edit_tienda">
    <h2>Editar Producto</h2>
    <form action="edit.php?id=<?php echo htmlspecialchars($producto['CodProd']); ?>" method="post" enctype="multipart/form-data">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($producto['nombre']); ?>" required>
        
        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" name="descripcion" required><?php echo htmlspecialchars($producto['descripcion']); ?></textarea>
        
        <label for="precio">Precio:</label>
        <input type="number" id="precio" name="precio" value="<?php echo htmlspecialchars($producto['precio']); ?>" required>
        
        <label for="stock">Stock:</label>
        <input type="number" id="stock" name="stock" value="<?php echo htmlspecialchars($producto['stock']); ?>" required>
        
        <!-- Select para el estado del producto -->
        <label for="estado">Estado:</label>
        <select id="estado" name="estado" required>
            <option value="1" <?php if ($producto['estado'] === '1') echo 'selected'; ?>>Activo</option>
            <option value="2" <?php if ($producto['estado'] === '2') echo 'selected'; ?>>Inactivo</option>
        </select>

        <!-- Select para la categoría del producto -->
        <label for="codcat">Categoría:</label>
        <select id="codcat" name="codcat" required>
            <?php 
            $categorias = obtener_categorias($conexion);
            foreach($categorias as $categoria) {
                $selected = ($producto['CodCat'] == $categoria['CodCategoria']) ? 'selected' : '';
                echo "<option value=\"{$categoria['CodCategoria']}\" $selected>" . htmlspecialchars($categoria['nombre_categoria']) . "</option>";
            }
            ?>
        </select>

        <!-- Input para la imagen -->
        <label for="imagen">Imagen:</label>
        <input type="file" id="imagen" name="imagen">

        <!-- Input oculto para la imagen guardada -->
        <input type="hidden" name="imagen-guardada" value="<?php echo htmlspecialchars($producto['imagen']); ?>">

        <input type="submit" value="Guardar Cambios">
    </form>
</div>

<?php require '../footer.php'; ?>