
<div class="span-24">
    <br><br>
    <div class="title">Bodega</div>
    <?php if($bodega): ?>
    <div class="span-24"><br>
            <table id="tblBodega" >
                <thead>
                    <tr>
                        <th class="span-3">PRODUCTO</th>
                        <th class="span-3">CANTIDAD</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($bodega as $bod): ?>
                        <tr>
                            <td><?php echo $producto[$bod->ID_PRODUCTO] ?></td>
                            <td id="<?php echo $bod->ID_PXB ?>">
                                <span id="cantidad_<?php echo $bod->ID_PXB; ?>" class="text" style="display: inline;"><?php echo $bod->CANTIDAD; ?></span>
                                <input type="text" value="<?php echo $bod->CANTIDAD; ?>" class="editbox" style="display: none;" id="cantidad_input_<?php echo $bod->ID_PXB; ?>"
                            </td>
                        </tr>

                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="prepend-7 span-10 append-7 line last"><br/>
            <div class="alerts" style="text-align: center">
                No existen Productos registrados en bodega.
            </div>
        </div>
    <?php endif; ?>
</div>
