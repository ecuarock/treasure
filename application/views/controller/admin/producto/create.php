<div class="span-24">
	<div class="prepend-2 span-20">
		<div class="title"><?php echo ($producto->ID_PRODUCTO)?'Actualizar':'Nuevo'; ?> Producto</div>
		<div class="span-20 required_fields line" align="center">
            <label>(*) Campos Obligatorios</label>
        </div>
		
		<div class="span-10 prepend-5 last">
			<ul id="alerts" class="alerts"></ul>
		</div>
		
		<form action="" method="post" name="frmProducto" id="frmProducto"><br/><br/>			
			<div class="span-20 line">
				<div class="prepend-5 span-4 label">
					* Producto:
				</div>
				<div class="span-8 label">
					<input class="span-8" type="text" name="DESCRIPCION" id="DESCRIPCION" value="<?php echo $producto->DESCRIPCION; ?>"/>
				</div>
			</div>
			
			<div class="span-20 line ">
                            <div class="prepend-5 span-4 label">* Departamento:</div>
                                <div class="span-8 last" id="cargardepartamento">
                                    <?php if($producto->ID_PRODUCTO): ?>
                                        <?php echo Form::select("ID_DEPARTAMENTO", array(''=>'-Seleccione-')+$departamento, $producto->ID_DEPARTAMENTO, array('id'=>'ID_DEPARTAMENTO','class' => 'span-8 select last')); ?>
                                    <?php else: ?>
                                        <?php echo Form::select("ID_DEPARTAMENTO", array(''=>'-Seleccione-')+$departamento, $producto->ID_DEPARTAMENTO, array('id'=>'ID_DEPARTAMENTO','class' => 'span-8 select last')); ?>
                                    <?php endif; ?>
                                </div>                            
			</div>
			<input type="hidden" name="ID_PRODUCTO" id="ID_PRODUCTO" value="<?php echo $producto->ID_PRODUCTO; ?>"/>
			<input type="hidden" name="nickname" id="nickname" value=""/>
			<div class="span-20 line" style="text-align: center;"><br/>
				<input id="btnSave" type="submit" value="Guardar"/>
			</div>
		</form>
	</div>
</div>