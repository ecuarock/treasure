$(document).ready(function(){
    var pagina = 0;
    /* LISTENERS */      
        $('#select_estado').bind('change',function(){
            show_ajax_loader();
            if($('#select_estado').val()!='')
            {
                if( ($('#select_estado').val()=='PEDIDO' ) || ($('#select_estado').val()=='APROBADO') || ($('#select_estado').val()=='CANCELADO') )
                    pagina = 1;
                else
                    pagina = 2;
                $('#anios_content').css('display','none');
                $('#select_anios_content').empty();
                $('#meses_content').css('display','none');
                $('#select_meses_content').empty();
                $('#tblContainer').css('display','none');
                $('#tblContainer').empty();
                $('#select_anios_content').load(
                    document_root+"admin/reporte/load_anios",
                    {
                        sent_estado: $('#select_estado').val(),
                        sent_pagina: pagina
                    },  
                    function() {
                        hide_ajax_loader()
                        $('#select_anios').bind('change',function(){
                                show_ajax_loader();
                               if($('#select_anios').val()!='')
                                {
                                    
                                        
                                    $('#meses_content').css('display','none');
                                    $('#select_meses_content').empty();
                                    $('#tblContainer').css('display','none');
                                    $('#tblContainer').empty();
                                    $('#select_meses_content').load(
                                          document_root+"admin/reporte/load_meses",
                                            {
                                                sent_estado: $('#select_estado').val(),
                                                sent_anio: $('#select_anios').val(),
                                                sent_pagina: pagina
                                            },   
                                            function()
                                            {
                                                hide_ajax_loader()
                                                $('#select_meses').bind('change',function(){
                                                    show_ajax_loader();
                                                    if($('#select_meses').val()!='')
                                                    {
                                                        $('#tblContainer').css('display','none');
                                                        $('#tblContainer').empty();
                                                        $('#tblContainer').load(
                                                        document_root+"admin/reporte/load_producto_table",
                                                        {
                                                            sent_estado: $('#select_estado').val(),
                                                            sent_anio: $('#select_anios').val(),
                                                            sent_mes: $('#select_meses').val(),
                                                            sent_pagina: pagina
                                                        },
                                                        function()
                                                        {
                                                            hide_ajax_loader()
                                                            $('#tblContainer').css('display','block');
                                                            $('#tblProducto').dataTable({
                                                                    "bJQueryUI": true,
                                                                    "sPaginationType": "full_numbers",
                                                                    "oLanguage": {
                                                                            "oPaginate": {
                                                                                    "sFirst": "Primera",
                                                                                    "sLast": "&Uacute;ltima",
                                                                                    "sNext": "Siguiente",
                                                                                    "sPrevious": "Anterior"
                                                                            },
                                                                            "sLengthMenu": "Mostrar _MENU_ registros por P&aacute;gina",
                                                                            "sZeroRecords": "No se encontraron resultados",
                                                                            "sInfo": "Mostrando _START_ a _END_ de _TOTAL_ registros",
                                                                            "sInfoEmpty": "Mostrando 0 a 0 de 0 registros",
                                                                            "sInfoFiltered": "(filtrado de _MAX_ registros en total)",
                                                                            "sSearch": "Criterio de B&uacute;squeda:",
                                                                            "sProcessing": "Filtrando.."
                                                                    },
                                                                            "aoColumns": [
                                                                                            {"bSortable":true},
                                                                                            {"bSortable":true},
                                                                                            {"bSortable":true},
                                                                    ],
                                                                            "sDom" : '<"H"Tfr>t<"F"pli>',
                                                                            "oTableTools": {
                                                                            "sSwfPath": document_root+"media/swf/copy_cvs_xls_pdf.swf",
                                                                            "aButtons":    [{
                                                                                            "sExtends": "xls",
                                                                                            "sButtonText": "Exportar a Excel"
                                                                                    }]


                                                                    }
                                                                });
//                                                                $(function() {
//                                                                $( "#dialog" ).dialog({
//                                                                    autoOpen: false,
//                                                                    height: 350,
//                                                                    width:550,
//                                                                    show: "blind",
//                                                                    hide: "blind"
//                                                                    });
//                                                                });
//                                                                $(".des-pedido-link").click(function(e){
//                                                                    e.preventDefault();
//                                                                    var titulo_pedido = $(this).attr("pedido_id");
//                                                                    var contenido_pedido = '';
//                                                                    $( "#contenido" ).empty();
//                                                                     $.ajax({
//                                                                         url:document_root+'admin/reporte/get_content',
//                                                                         async: false,
//                                                                         type: "post",
//                                                                         data: ({
//                                                                             pedido_id: $(this).attr("pedido_id"),
//                                                                             sent_pagina: $('#pagina').val()
//                                                                             
//                                                                         }),
//                                                                         dataType: 'json',
//                                                                         success: function(data){
//                                                                             contenido_pedido = data
//                                                                         }
//                                                                     });
//
//
//                                                                    $( "#dialog" ).dialog( "open" );                                                                    
//                                                                    if($('#pagina').val()==1)
//                                                                        $( "#ui-dialog-title-dialog" ).html('Productos del Pedido: '+titulo_pedido);
//                                                                    if($('#pagina').val()==2)
//                                                                        $( "#ui-dialog-title-dialog" ).html('Productos del Despacho: '+titulo_pedido);
//                                                                    $( "#contenido" ).append(contenido_pedido);
//
//                                                                 });
                                                        }                                                    
                                                        );
                                                   }
                                                   else
                                                   {
                                                       alert('Debe Selecionar un mes');
                                                       $('#tblContainer').css('display','none');
                                                       $('#tblContainer').empty();
                                                       hide_ajax_loader();
                                                   }
                                                });
                                                $('#meses_content').css('display','block')
                                            }
                            
                                    );
                                }
                                else
                                {
                                    alert('Debe Selecionar un a\xf1o');
                                    $('#meses_content').css('display','none');
                                    $('#select_meses_content').empty();
                                    $('#tblContainer').css('display','none');
                                    $('#tblContainer').empty();
                                    hide_ajax_loader();
                                }
                        
                        }),
                        $('#anios_content').css('display','block')
                      }
                );        

            }
            else
            {
                alert('Debe Selecionar un estado');
                $('#anios_content').css('display','none');
                $('#select_anios_content').empty();
                $('#meses_content').css('display','none');
                $('#select_meses_content').empty();
                $('#tblContainer').css('display','none');
                $('#tblContainer').empty();
                hide_ajax_loader();
            }
            
        });
        
    /* END LISTENERS */
    
    
});


