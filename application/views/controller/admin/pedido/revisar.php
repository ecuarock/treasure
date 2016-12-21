<div class="span-24">
	<div class="prepend-2 span-20">
                <div class="title">Aprobaci&oacute;n o Cancelaci&oacute;n de Pedido</div>
		<div class="span-20 required_fields line" align="center">
            <label>(*) Campos Obligatorios</label>
        </div>

		<div class="prepend-5 span-10" align="center">
			<div id="dialog_errores">
				<ul id="alerts" class="alerts"></ul>
			</div>
		</div>
		
		<br/><br/><br/>

		<form action="" method="post" name="frmPedido" id="frmPedido">
                    <?php if($pedido->ID_PEDIDO): ?>
                        <?php foreach ($producto as $key => $value): ?>   
                            <?php if(array_key_exists($key,$PXP)): ?>
                                <div class="span-20 line ">                                  
                                    <div class="span-10">                                             
                                        <?php echo Form::checkbox(''.$key.'', $key, FALSE, array('id'=>'ID_PRODUCTO_'.$key.'','class' => 'span-5','checked' => 'checked','disabled' => 'disable' ));?>
                                        <div class="span-5 label"> <?php echo $value?> </div>                                                                                                                 
                                    </div> 
                                    <div class="span-10 last">
                                        <div class="prepend-2 span-3 label"> *Cantidad: </div>  
                                        <input type="text" class="span-1 last" name="CANTIDAD_<?php echo $key?>" id='CANTIDAD_<?php echo $key?>' value="<?php echo $PXP[$key]?>" title='El campo "Cantidad" es obligatorio.' disabled="disable" maxlength="2"/>
                                   </div>                                   
                                </div>   
                            <?php endif; ?>
                        <?php endforeach; ?>                    
                    <?php endif; ?>
                <input type="hidden" name="id" id="id" value="<?php echo ($pedido->ID_PEDIDO)?$pedido->ID_PEDIDO:'';?>"/>
                    <div class="span-20 " align="center"><br>
                        <input type="submit" id="btnSave" name="btnSave" value="Aprobar"  />&emsp;&emsp;
                        <input type="submit" id="btnCancel" name="btnCancel" value="Cancelar"  />
                    </div>
		</form>
                <div class="span-20 " align="center"><br> 
                <a href="javascript:window.history.go(-1);">Regresar</a>
                </div>
	</div>
</div>