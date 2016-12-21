
<div class="span-24">
    <br><br>
    <div class="title">Seleccionar Producto</div>
    <?php if($productos): ?>
    <div class="span-24"><br>
        <a href="<?php echo URL::site('admin/producto/create');?>">Crear Producto</a><br/><br/>
            <table id="tblProductos">
                <thead>
                    <tr>
                        <th class="span-3">PRODUCTO</th>
                        <th class="span-3">DEPARTAMENTO</th>
                        <th class="span-1">EDITAR</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($productos as $producto): ?>
                        <tr>
                            <td><?php echo $producto->DESCRIPCION ?></td>
                            <td><?php echo $departamento[$producto->ID_DEPARTAMENTO]?></td>
                            <td>
                                <a href="<?php echo URL::site('admin/producto/create/'.$producto->ID_PRODUCTO); ?>">
                                    <img src="<?php echo URL::site('media/img/edit.png'); ?>"></img>
                                </a>
                            </td>
                        </tr>

                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="prepend-7 span-10 append-7 line last"><br/>
            <div class="alerts" style="text-align: center">
                No existen Productos registrados.
            </div>
        </div>
    <?php endif; ?>
</div>
