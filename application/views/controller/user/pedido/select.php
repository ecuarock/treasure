<div class="span-24">
    <br><br>
    <div class="title">Seleccionar Pedido Para Modificar</div>
    <?php if($pedido): ?>
    <div class="span-24"><br>
        <a href="<?php echo URL::site('user/pedido/create');?>">Crear Pedido</a><br/><br/>
            <table id="tblPedidos">
                <thead>
                    <tr>
                        <th class="span-3">N&Uacute;MERO DE PEDIDO</th>
                        <th class="span-3">USUARIO</th>
                        <th class="span-3">ANIO</th>
                        <th class="span-3">MES</th>
                        <th class="span-3">DIA</th>
                        <th class="span-1">EDITAR</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($pedido as $ped): ?>
                        <tr>
                            <td><?php echo $ped["ID_PEDIDO"] ?></td>
                            <td><?php echo $user[$ped["ID_USUARIO"]]?></td>
                            <td><?php echo $ped["ANIO"]?></td>
                            <td><?php echo $ped["MES"]?></td>
                            <td><?php echo $ped["DIA"] ?></td>
                            <td>
                                <a href="<?php echo URL::site('user/pedido/create/'.$ped["ID_PEDIDO"]); ?>">
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
                No existen Pedidos registrados.
            </div>
        </div>
    <?php endif; ?>
</div>
