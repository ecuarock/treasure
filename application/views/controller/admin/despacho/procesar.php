<div class="span-24">
    <br><br>
    <div class="title">Seleccionar Despacho Para Procesar</div>
    <?php if($despacho): ?>
    <div class="span-24"><br>
        <a href="<?php echo URL::site('admin/despacho/create');?>">Crear Despacho</a><br/><br/>
            <table id="tblPedidos">
                <thead>
                    <tr>
                        <th class="span-3">N&Uacute;MERO DE DESPACHO</th>
                        <th class="span-3">USUARIO</th>
                        <th class="span-3">ANIO</th>
                        <th class="span-3">MES</th>
                        <th class="span-3">DIA</th>
                        <th class="span-1">REVISAR</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($despacho as $desp): ?>
                        <tr>
                            <td><?php echo $desp["ID_DESPACHO"] ?></td>
                            <td><?php echo $user[$desp["ID_USUARIO"]]?></td>
                            <td><?php echo $desp["ANIO"]?></td>
                            <td><?php echo $desp["MES"]?></td>
                            <td><?php echo $desp["DIA"] ?></td>
                            <td>
                                <a href="<?php echo URL::site('admin/despacho/revisar/'.$desp["ID_DESPACHO"]); ?>">
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
                No existen Despachos registrados.
            </div>
        </div>
    <?php endif; ?>
</div>
