<?php require 'header.php'; ?>

<style> 

img { 
    height: 200px;
}

</style>

<div class="container">
    <?php $count = 0; ?>
    <?php foreach($posts as $post): ?>
        <?php $count++; ?>
        <div class="square">
            <div class="image-container">
                <img src="<?php echo RUTA; ?>/weather/images/<?php echo $post['imagen']; ?>" alt="">
            </div>
            <a href="playa.php?id=<?php echo $post['id']; ?>">
                <div class="content"><?php echo $post['nombre']; ?></div>
            </a>
            <div class="icon-container">
                <?php
                // Obtener los servicios para la playa actual utilizando PDO
                $playa_id = $post['id'];
                $query = "SELECT Servicios.nombre, Servicios.descripcion, Servicios.icono 
                          FROM Playas_Servicios 
                          JOIN Servicios ON Playas_Servicios.servicio_id = Servicios.id 
                          WHERE Playas_Servicios.playa_id = :playa_id";
                $stmt = $conexion->prepare($query);
                $stmt->execute(['playa_id' => $playa_id]);
                $servicios = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach($servicios as $servicio): ?>
                    <div class="icon" title="<?php echo $servicio['descripcion']; ?>">
                        <img src="<?php echo RUTA; ?>/iconos/<?php echo $servicio['icono']; ?>" alt="<?php echo $servicio['nombre']; ?>">
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php if ($count % 3 == 0): ?>
            <div style="flex-basis: 100%; height: 0;"></div> <!-- Este div limpia la línea después de cada fila de tres elementos -->
        <?php endif; ?>
    <?php endforeach; ?>
</div> 

<?php require 'paginacion_playas.php' ?>

<?php require 'footer.php'; ?>