<table id="tblPedidos" class="center">
                <thead>
                    <tr>
                        <th class="span-3">N&Uacute;MERO DE PEDIDO</th>
                        <th class="span-3">USUARIO</th>
                        <th class="span-3">ANIO</th>
                        <th class="span-3">MES</th>
                        <th class="span-3">DIA</th>
                        <th class="span-1">REVISAR</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($ID_PEDIDO as $ped): ?>
                        <tr>
                            <td><?php echo ($pagina==1)?$ped["ID_PEDIDO"]:$ped["ID_DESPACHO"]; ?></td>
                            <td><?php echo $user[$ped["ID_USUARIO"]]?></td>
                            <td><?php echo $ped["ANIO"]?></td>
                            <td><?php echo $ped["MES"]?></td>
                            <td><?php echo $ped["DIA"] ?></td>
                            <td>
                                <a class="des-pedido-link" href="" pedido_id="<?php echo ($pagina==1)?$ped["ID_PEDIDO"]:$ped["ID_DESPACHO"]; ?>">Ver Productos</a>
                            </td>
                        </tr>

                    <?php endforeach; ?>
                </tbody>
</table>
