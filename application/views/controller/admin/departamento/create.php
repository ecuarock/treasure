<div class="span-24">
	<div class="prepend-2 span-20">
		<div class="title"><?php echo ($departamento->ID_DEPARTAMENTO)?'Actualizar':'Nuevo'; ?> Departamento</div>
		<div class="span-20 required_fields line" align="center">
            <label>(*) Campos Obligatorios</label>
        </div>
		
		<div class="span-10 prepend-5 last">
			<ul id="alerts" class="alerts"></ul>
		</div>
		
		<form action="" method="post" name="frmDepartamento" id="frmDepartamento"><br/><br/>			
			<div class="span-20 line">
				<div class="prepend-5 span-4 label">
					* Nombre:
				</div>
				<div class="span-8 label">
					<input class="span-8" type="text" name="NOMBRE" id="NOMBRE" value="<?php echo $departamento->NOMBRE; ?>"/>
				</div>
			</div>
			
			<div class="span-20 line" id="passContainer">
				<div class="prepend-5 span-4 label">
					* Descripcion:
				</div>
				<div class="span-8 label">
					<textarea class="span-8" name="DESCRIPCION" id="DESCRIPCION"><?php echo str_replace("\\n", "\n", $departamento->DESCRIPCION); ?></textarea>
				</div>
			</div>
			<input type="hidden" name="ID_DEPARTAMENTO" id="ID_DEPARTAMENTO" value="<?php echo $departamento->ID_DEPARTAMENTO; ?>"/>
			<input type="hidden" name="nickname" id="nickname" value=""/>
			<div class="span-20 line" style="text-align: center;"><br/>
				<input id="btnSave" type="submit" value="Guardar"/>
			</div>
		</form>
	</div>
</div>