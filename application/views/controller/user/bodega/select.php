<div class="span-24">
    <br><br>
    <div class="title">Bodega</div>
    <?php if($bodega): ?>
    <div class="span-24"><br>
        <form action="" method="post" name="frmBodega" id="frmBodega">
                <table id="tblBodega" >
                    <thead>
                        <tr>
                            <th class="span-3">PRODUCTO</th>
                            <th class="span-3">CANTIDAD</th>
                            <th class="span-3">CANTIDAD PARA EGRESO</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($bodega as $bod): ?>
                            <tr>
                                <td><?php echo $producto[$bod->ID_PRODUCTO] ?></td>
                                <td>
                                    <?php echo $bod->CANTIDAD; ?>
                                    <input type="hidden" name="cantidad_resta_<?php echo $bod->ID_PXB; ?>" id="cantidad_resta_<?php echo $bod->ID_PXB; ?>" value="0"/>
                                    <input type="hidden" name="cantidad_original_<?php echo $bod->ID_PXB; ?>" id="cantidad_original_<?php echo $bod->ID_PXB; ?>" value="<?php echo $bod->CANTIDAD; ?>"/>
                                </td>
                                <td id="<?php echo $bod->ID_PXB ?>">
                                    <input type="text" value="0" class="span-1 last" id="cantidad_input_<?php echo $bod->ID_PXB; ?>" readonly="readonly"/>
                                    <a class="span-1 last" id="boton_mas_<?php echo $bod->ID_PXB; ?>">
                                        <img src="<?php echo URL::site('media/img/add.png'); ?>"></img>
                                    </a>&emsp;
                                    <a class="span-1 last" id="boton_menos_<?php echo $bod->ID_PXB; ?>">
                                        <img src="<?php echo URL::site('media/img/del.png'); ?>"></img>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="span-24 " align="center"><br>
				<input type="submit" id="btnSave" name="btnSave" value="Guardar" />
                </div>            
            </form>
        </div>
    <?php else: ?>
        <div class="prepend-7 span-10 append-7 line last"><br/>
            <div class="alerts" style="text-align: center">
                No existen Productos registrados en bodega.
            </div>
        </div>
    <?php endif; ?>
</div>
