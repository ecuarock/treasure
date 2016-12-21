
<div class="span-24">
    <br><br>
    <div class="title">Seleccionar Departamento</div>
    <?php if($departamentos): ?>
    <div class="span-24"><br>
        <a href="<?php echo URL::site('admin/departamento/create');?>">Crear Departamento</a><br/><br/>
            <table id="tblDepartamentos">
                <thead>
                    <tr>
                        <th class="span-3">NOMBRE</th>
                        <th class="span-3">DESCRIPCI&Oacute;N</th>
                        <th class="span-1">EDITAR</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($departamentos as $departamento): ?>
                        <tr>
                            <td><?php echo $departamento->NOMBRE ?></td>
                            <td><?php echo $departamento->DESCRIPCION ?></td>
                            <td>
                                <a href="<?php echo URL::site('admin/departamento/create/'.$departamento->ID_DEPARTAMENTO); ?>">
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
                No existen Departamentos registrados.
            </div>
        </div>
    <?php endif; ?>
</div>
