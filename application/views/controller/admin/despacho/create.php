<div class="span-24">
	<div class="prepend-2 span-20">
		<div class="title"><?php echo ($despacho->ID_DESPACHO)?'Actualizar':'Nuevo'; ?> Despacho</div>
		<div class="span-20 required_fields line" align="center">
            <label>(*) Campos Obligatorios</label>
        </div>

		<div class="prepend-5 span-10" align="center">
			<div id="dialog_errores">
				<ul id="alerts" class="alerts"></ul>
			</div>
		</div>
                <div id="dialog" title="">
                        <p id="pedido_productos"> 
                            <div id="contenido"></div>
                        </p>
               </div>
		
		<br/><br/><br/>

		<form action="" method="post" name="frmDespacho" id="frmDespacho">
                    <?php if($despacho->ID_DESPACHO): ?>
                        <?php foreach ($pedidos as $value): ?>
                              <div class="span-20 line ">     
                                <div class="prepend-2 span-5 label"> N&Uacute;MERO DE PEDIDO: </div> 
                                <div class="prepend-2 span-10">                                    
                                    <?php echo Form::checkbox(''.$value["ID_PEDIDO"].'', 'ID_PEDIDO_'.$value["ID_PEDIDO"].'', FALSE, array('id'=>'ID_PEDIDO_'.$value["ID_PEDIDO"].'','class' => 'span-5','checked' => 'checked'));?>
                                    <div class="span-3 label"> <?php echo $value["ID_PEDIDO"]?> </div>   
                                    <a class='des-pedido-link' pedido_id='<?php echo $value["ID_PEDIDO"]?>' href=''>Ver Productos</a>
                                </div>                                  
                            </div>                                                          
                        <?php endforeach; ?>
                        <?php foreach ($pedidos_sin_despacho as $value): ?>
                              <div class="span-20 line ">     
                                <div class="prepend-2 span-5 label"> N&Uacute;MERO DE PEDIDO: </div> 
                                <div class="prepend-2 span-10">                                    
                                    <?php echo Form::checkbox(''.$value["ID_PEDIDO"].'', 'ID_PEDIDO_'.$value["ID_PEDIDO"].'', FALSE, array('id'=>'ID_PEDIDO_'.$value["ID_PEDIDO"].'','class' => 'span-5'));?>
                                    <div class="span-3 label"> <?php echo $value["ID_PEDIDO"]?> </div>      
                                    <a class='des-pedido-link' pedido_id='<?php echo $value["ID_PEDIDO"]?>' href=''>Ver Productos</a>
                                </div>                                  
                            </div>                                                          
                        <?php endforeach; ?>
                    
                    <?php else: ?>
                        <?php foreach ($pedidos_sin_despacho as $value): ?>
                            <div class="span-20 line ">     
                                <div class="prepend-2 span-5 label"> N&Uacute;MERO DE PEDIDO: </div> 
                                <div class="prepend-2 span-10">                                    
                                    <?php echo Form::checkbox(''.$value["ID_PEDIDO"].'', 'ID_PEDIDO_'.$value["ID_PEDIDO"].'', FALSE, array('id'=>'ID_PEDIDO_'.$value["ID_PEDIDO"].'','class' => 'span-5'));?>
                                    <div class="span-3 label"> <?php echo $value["ID_PEDIDO"]?> </div>     
                                    <a class='des-pedido-link' pedido_id='<?php echo $value["ID_PEDIDO"]?>' href=''>Ver Productos</a>
                                </div>                                  
                            </div>
                            
                        <?php endforeach; ?>
                    <?php endif; ?>
                        <input type="hidden" name="validar" id="validar" value="<?php echo ($validar)?$validar:0;?>" />
                        <input type="hidden" name="user" id="user" value="<?php echo ($user)?$user:'';?>" />
			<div class="span-20 " align="center"><br>
                            <input type="submit" id="btnSave" name="btnSave" value="Guardar"  />
			</div>
		</form>
                
	</div>
</div>