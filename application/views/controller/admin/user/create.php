
<div class="span-24">
	<div class="prepend-2 span-20">
		<div class="title"><?php echo ($user->ID_USUARIO)?'Actualizar':'Nuevo'; ?> Usuario</div>
		<div class="span-20 required_fields line" align="center">
            <label>(*) Campos Obligatorios</label>
        </div>

		<div class="prepend-5 span-10" align="center">
			<div id="dialog_errores">
				<ul id="alerts" class="alerts"></ul>
			</div>
		</div>
		
		<br/><br/><br/>

		<form action="" method="post" name="frmUser" id="frmUser">
			
			<div class="span-20 line ">
                            <div id="managerContainer">
                                <div class="prepend-2 span-3 label">* Nombre:</div>
				<div class="span-5">
					<input type="text" class="span-4" name="NOMBRE" id="NOMBRE" value="<?php echo $user->NOMBRE; ?>" title='El campo "Nombre" es obligatorio.' />
				</div>
                            </div>
                            <div class="prepend-1 span-4 label">* Cargo:</div>
                                <div class="span-2 last" id="cargarperfil">
                                    <?php if($user->ID_USUARIO): ?>
                                        <?php echo Form::select("ID_PERFIL", array(''=>'-Seleccione-')+$perfil, $user->ID_PERFIL, array('id'=>'ID_PERFIL','class' => 'span-4 select last')); ?>
                                    <?php else: ?>
                                        <?php echo Form::select("ID_PERFIL", array(''=>'-Seleccione-')+$perfil, $user->ID_PERFIL, array('id'=>'ID_PERFIL','class' => 'span-4 select last')); ?>
                                    <?php endif; ?>
                                </div>                            
			</div>
			
			<div class="span-20 line ">
				<div class="prepend-2 span-3 label">* Apellido:</div>
				<div class="span-5">
					<input type="text" class="span-4" name="APELLIDO" id="APELLIDO" value="<?php echo $user->APELLIDO; ?>" title='El campo "Nombre" es obligatorio.' />
				</div>
                                <div id="cargardepartamento" style="display:<?php echo($user->ID_PERFIL!=1)?'block':'none'; ?>">
                                    <div class="prepend-1 span-4 label">* Departamento:</div>
                                    <div class="span-2 last">
                                        <?php if($user->ID_USUARIO): ?>
                                            <?php echo Form::select("ID_DEPARTAMENTO", array(''=>'-Seleccione-')+$departamento, $user->ID_DEPARTAMENTO, array('id'=>'ID_DEPARTAMENTO','class' => 'span-4 select last')); ?>
                                        <?php else: ?>
                                            <?php echo Form::select("ID_DEPARTAMENTO", array(''=>'-Seleccione-')+$departamento, $user->ID_DEPARTAMENTO, array('id'=>'ID_DEPARTAMENTO','class' => 'span-4 select last')); ?>
                                        <?php endif; ?>
                                    </div>
                               </div>    
			</div>

                        <div class="span-20 line ">
				<div class="span-10 " id="containerusuario">
					<div class="prepend-2 span-3 label">* Usuario:</div>
					<div class="span-5 last">
						<input type="text" class="span-4" name="USUARIO" id="USUARIO" value="<?php echo $user->USUARIO; ?>" maxlength="20" />
					</div>
				</div>
                                
                                <div class="prepend-1 span-4 label" id="containerstatus">* Estado:</div>
                                    <div class="span-2 last" id="statuscontainer">
                                        <?php if(!$user->ID_USUARIO): ?>
                                            <?php echo Form::select('ESTADO', array(''=>'-Seleccione-')+Model_User::$status_values, $user->ESTADO, array('id'=>'ESTADO', 'class'=>'span-4 select')) ;?>
                                        <?php else: ?>
                                            <?php echo Form::select('ESTADO', array(''=>'-Seleccione-')+Model_User::$status_values, $user->ESTADO, array('id'=>'ESTADO', 'class'=>'span-4 select')) ;?>
                                        <?php endif; ?>
                                    </div>                                    

			</div>
            
                        <?php if($user->ID_USUARIO): ?>
                            <div class="span-20 line">
                                <div class="prepend-1 span-4 label">Cambiar contrase&ntilde;a?</div>
                                <div class="span-4 label">
                                <input type="radio" id="change_pass_yes" name="change_pass" value="yes"/>Si
                                <input type="radio" id="change_pass_no" name="change_pass" value="no" checked="checked"/>No
                                </div>
                            </div>
                        <?php endif; ?>

            <div class="span-20 line" id="passContainer" style="display:<?php echo($user->ID_USUARIO)?'none':'block'; ?>">
                <div class="span-20 line ">
                    <div class="prepend-2 span-3 label">* Contrase&ntilde;a:</div>
                    <div class="span-5 line">
                        <input type="password" class="span-4" name="CONTRASENIA" id="CONTRASENIA" maxlength="15"/>
                    </div>

                    <div class="prepend-1 span-4 label" id="containerstatus">*  Confimar Contrase&ntilde;a:</div>
                    <div class="span-2 line last" id="statuscontainer">
                        <input type="password" class="span-4" name="confPassword" id="confPassword" maxlength="15"/>
                    </div>
                </div>
            </div>
            
            <input type="hidden" name="id" id="id" value="<?php echo ($user->ID_USUARIO)?$user->ID_USUARIO:'';?>"/>
            <input type="hidden" name="nickname" id="nickname" value="<?php echo ($user->USUARIO)?$user->USUARIO:'';?>"/>
			<div class="span-20 " align="center"><br>
				<input type="submit" id="btnSave" name="btnSave" value="Guardar" />
			</div>
		</form>
	</div>
</div>