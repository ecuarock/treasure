<div class="span-24">
	<div class="prepend-2 span-20">
		<div class="title"><?php echo ($pedido->ID_PEDIDO)?'Actualizar':'Nuevo'; ?> Pedido</div>
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
                            
                                <div class="span-20 line ">                                  
                                               <div class="span-10">   
                                                        <?php if(array_key_exists($key,$PXP)): ?>
                                                             <?php echo Form::checkbox(''.$key.'', $key, FALSE, array('id'=>'ID_PRODUCTO_'.$key.'','class' => 'span-5','checked' => 'checked' ));?>
                                                          
                                                        <?php else: ?>
                                                             <?php echo Form::checkbox(''.$key.'', $key, FALSE, array('id'=>'ID_PRODUCTO_'.$key.'','class' => 'span-5'));?>
                                                            
                                                        <?php endif; ?>
                                                   <div class="span-5 label"> <?php echo $value?> </div>                                
                                               </div> 
                                               <div class="span-10 last"> 
                                                   <div class="prepend-2 span-3 label"> *Cantidad: </div>  
                                                        <?php if(array_key_exists($key,$PXP)): ?>
                                                             <input type="text" class="span-1 last" name="CANTIDAD_<?php echo $key?>" id='CANTIDAD_<?php echo $key?>' value="<?php echo $PXP[$key]?>" title='El campo "Cantidad" es obligatorio.' maxlength="2"/>
                                                             
                                                        <?php else: ?>
                                                             <input type="text" class="span-1 last" name="CANTIDAD_<?php echo $key?>" id='CANTIDAD_<?php echo $key?>' value="" title='El campo "Cantidad" es obligatorio.' disabled="disable" maxlength="2"/>
                                                             
                                                        <?php endif; ?>
                                                   <input type="hidden" name="<?php echo $key?>" id="<?php echo $key?>" value="<?php echo $key?>"/>
                                               </div>                                   
                                    </div> 
                            
                        <?php endforeach; ?>
                    
                    <?php else: ?>
                        <?php foreach ($producto as $key => $value): ?>
                            <div class="span-20 line ">                                  
                                    <div class="span-10">                                    
                                        <?php echo Form::checkbox(''.$key.'', $key, FALSE, array('id'=>'ID_PRODUCTO_'.$key.'','class' => 'span-5'));?>
                                        <div class="span-5 label"> <?php echo $value?> </div>                                
                                    </div>
                                    <div class="span-10 last"> 
                                        <div class="prepend-2 span-3 label"> *Cantidad: </div>  
                                        <input type="text" class="span-1 last" name="CANTIDAD_<?php echo $key?>" id='CANTIDAD_<?php echo $key?>' value="" title='El campo "Cantidad" es obligatorio.' disabled="disable" maxlength="2"/>
                                        <input type="hidden" name="<?php echo $key?>" id="<?php echo $key?>" value="<?php echo $key?>"/>
                                    </div>                                   
                            </div>
                            
                        <?php endforeach; ?>
                                
                            <div id="lineas" name="lineas" clas="span-20 line"><br><br>

                            </div>
                    
                    <?php endif; ?>
                        
            
            <input type="hidden" name="id" id="id" value="<?php echo ($pedido->ID_PEDIDO)?$pedido->ID_PEDIDO:'';?>"/>
            <input type="hidden" name="validar" id="validar" value="<?php echo ($productos)?$productos:0;?>" />
            <input type="hidden" name="user" id="user" value="<?php echo ($user)?$user:'';?>" />
            <input type="hidden" name="productos" id="productos" value="" />
			<div class="span-20 " align="center"><br>
                            <input type="submit" id="btnSave" name="btnSave" value="Guardar"  />
			</div>
		</form>
	</div>
</div>