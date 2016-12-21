<div class="span-24">
    <br><br>
    <div class="title">Seleccionar Usuario</div>
    <?php if($users): ?>
    <div class="span-24"><br>
        <a href="<?php echo URL::site('admin/user/create');?>">Crear Usuario</a><br/><br/>
            <table id="tblUsuarios">
                <thead>
                    <tr>
                        <th class="span-3">NOMBRE</th>
                        <th class="span-3">APELLIDO</th>
                        <th class="span-3">CARGO</th>
                        <th class="span-3">DEPARTAMENTO</th>
                        <th class="span-3">USUARIO</th>
                        <th class="span-2">ESTADO</th>
                        <th class="span-1">EDITAR</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($users as $user): ?>
                        <tr>
                            <td><?php echo $user->NOMBRE ?></td>
                            <td><?php echo $user->APELLIDO ?></td>
                            <td><?php echo $perfiles_array[$user->ID_PERFIL]?></td>
                            <td><?php echo $departamentos_array[$user->ID_DEPARTAMENTO]?></td>
                            <td><?php echo $user->USUARIO ?></td>
                            <td><?php echo $user->ESTADO ?></td>
                            <td>
                                <a href="<?php echo URL::site('admin/user/create/'.$user->ID_USUARIO); ?>">
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
                No existen Usuarios registrados.
            </div>
        </div>
    <?php endif; ?>
</div>
