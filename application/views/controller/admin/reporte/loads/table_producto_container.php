<table id="tblProducto" class="center">
                <thead>
                    <tr>
                        <th class="span-3">PRODUCTO</th>
                        <th class="span-3">DEPARTAMENTO</th>
                        <th class="span-3">CANTIDAD</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($requisicion as $ped): ?>
                        <tr>
                            <td><?php echo $producto[$ped["ID_PRODUCTO"]] ?></td>
                            <td><?php echo $departamento[$dep[$ped["ID_PRODUCTO"]]]?></td>
                            <td><?php echo $ped["CANTIDAD"]?></td>
                        </tr>

                    <?php endforeach; ?>
                </tbody>
</table>
