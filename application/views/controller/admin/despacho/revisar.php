<div class="span-24">
	<div class="prepend-2 span-20">
		<div class="title">Actualizacion de Estado de Despacho</div>
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
                                    <?php echo Form::checkbox(''.$value["ID_PEDIDO"].'', 'ID_PEDIDO_'.$value["ID_PEDIDO"].'', FALSE, array('id'=>'ID_PEDIDO_'.$value["ID_PEDIDO"].'','class' => 'span-5','checked' => 'checked','disabled'=>'disable'));?>
                                    <div class="span-3 label"> <?php echo $value["ID_PEDIDO"]?> </div>   
                                    <a class='des-pedido-link' pedido_id='<?php echo $value["ID_PEDIDO"]?>' href=''>Ver Productos</a>
                                    <input type="hidden" name="<?php echo 'ID_PEDIDO_'.$value["ID_PEDIDO"].''?>" id="<?php echo 'ID_PEDIDO_'.$value["ID_PEDIDO"].''?>" value="<?php echo $value["ID_PEDIDO"];?>" />
                                </div>                                  
                            </div>                                                          
                        <?php endforeach; ?>
                    <?php endif; ?>
			<div class="span-20 " align="center"><br>
                            <input type="submit" id="btn_Comprar" name="btn_Comprar" value="Comprar"  />&emsp;&emsp;
                            <input type="submit" id="btn_Enviar" name="btn_Enviar" value="Enviar"  />&emsp;&emsp;
                            <input type="submit" id="btn_Entregar" name="btn_Entregar" value="Entregar"  />&emsp;&emsp;
                            <input type="submit" id="btn_Cancelar" name="btn_Cancelar" value="Cancelar"  />
			</div>
		</form>
                <div class="span-20 " align="center"><br> 
                <a href="javascript:window.history.go(-1);">Regresar</a>
                </div>
	</div>
</div>