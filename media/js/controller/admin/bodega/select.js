$(document).ready(function(){
	$('#tblBodega').dataTable({
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
					{"bSortable":true}
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
        
        $('[id^="cantidad_"]').bind('click',function(){
            var ID=$(this).attr('id');
            ID = ID.split('_');
            ID = ID[1];
            
            $("#cantidad_"+ID).hide();
            $("#cantidad_input_"+ID).show();
                     
            
            
        }).change(function()
        {
        var ID=$(this).attr('id');
            ID = ID.split('_');
            ID = ID[2];
        var cantidad = $("#cantidad_input_"+ID).val();
        var original = $("#cantidad_"+ID).html();
        var validar = cantidad.length;
        $("#cantidad_"+ID).html('<img src="'+document_root+'media/img/load.gif" />'); // Loading image

        if(validar>0)
        {
            if(!isNaN(cantidad))
            {
                if(cantidad>=0)
                {
                    $.ajax({
                    type: "POST",
                    url:document_root+'admin/bodega/editcontent',
                    data: ({
                        pxb_id: ID,
                        cantidad: cantidad
                    }),
                    cache: false,
                    success: function(data)
                    {
                        $("#cantidad_"+ID).html(data);
                        $("#cantidad_input_"+ID).val(data);
                    }
                    });
                }
                else
                {
                    alert('Escriba solo n\xfameros positivos.');
                    $("#cantidad_"+ID).html(original);
                    $("#cantidad_input_"+ID).val(original);
                }
            }
            else
            {                
                alert('Escriba solo n\xfameros.');
                $("#cantidad_"+ID).html(original);
                $("#cantidad_input_"+ID).val(original);
            }
        }
        else
        {
            alert('Debe ingresar un valor.');
            $("#cantidad_"+ID).html(original);
            $("#cantidad_input_"+ID).val(original);
        }

        });
        
        $(".editbox").mouseup(function() 
        {
            return false
        });
        
        $(document).mouseup(function()
        {
            $(".editbox").hide();
            $(".text").show();
        });
});


