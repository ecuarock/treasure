<div class="span-24">
    <br><br>
    <div class="title">Reporte Por Departamentos</div>
            <div class="span-22 results-container-all" >
                    <div class="prepend-6 span-10 last line">
                       <div class=" span-12 last line" >
                            <div class=" span-5  results-container-title">
                                Seleccione Departamento:
                            </div>
                            <div class="span-6 last ">
                                <?php echo Form::select("select_departamento", $departamentos_nombre, null, array('id'=>'select_departamento','class' => 'span-5 select last')); ?>
                            </div>
                       </div>
                       <div id="estado_content" class=" span-12 last line" style="display:none"><br>
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
            </div>
</div>
