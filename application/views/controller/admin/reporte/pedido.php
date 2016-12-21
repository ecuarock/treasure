<div class="span-24">
    <br><br>
    <div class="title">Reporte de <?php echo ($pagina==1)?'Pedidos':'Despachos'; ?></div>
            <div class="span-22 results-container-all" >
                    <div class="prepend-6 span-10 last line">
                       <div class=" span-12 last line" >
                            <div class=" span-5  results-container-title">
                                Seleccione Estado:
                            </div>
                            <div class="span-6 last ">
                                <?php echo Form::select("select_estado", $estados, null, array('id'=>'select_estado','class' => 'span-5 select last')); ?>
                            </div>
                        </div>
                        <div id="anios_content" class=" span-12 last line" style="display:none"><br>
                            <div class=" span-5  results-container-title">
                                Seleccione A&Ntilde;O:
                            </div>
                            <div id="select_anios_content" class="span-6 last">
                                
                            </div>
                        </div>
                        <div id="meses_content" class=" span-12 last line" style="display:none"><br>
                            <div class=" span-5  results-container-title">
                                Seleccione MES:
                            </div>
                            <div id="select_meses_content" class="span-6 last">
                                
                            </div>
                        </div>
                         
                    </div>
                 
                    <div class="prepend-2 span-20 ">
                        <div id="tblContainer" style="display:none" css="center">
                            
                        </div>
                    </div>
                
                    <div id="dialog" title="">
                        <p id="pedido_productos"> 
                            <div id="contenido"></div>
                        </p>
                    </div>
                    <input type="hidden" name="pagina" id="pagina" value="<?php echo $pagina; ?>"/>

            </div>
    
</div>
