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
                                        {"bSortable":true},
					{"bSortable":false}
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
        
        $('[id^="boton_mas_"]').bind('click',function(){
            var ID = $(this).attr('id');
            ID = ID.split('_');
            ID = ID[2];
            var aux = parseInt($("#cantidad_resta_"+ID).val(), 10);
            aux = aux + 1;
            if(aux>$("#cantidad_original_"+ID).val())
                alert('La cantidad sobrepasa la cantidad en stock');
            else
            {
                $("#cantidad_resta_"+ID).val(aux);
                $("#cantidad_input_"+ID).val(aux);            

            }
        });
        
        $('[id^="boton_menos_"]').bind('click',function(){
            var ID = $(this).attr('id');
            ID = ID.split('_');
            ID = ID[2];
            var aux = parseInt($("#cantidad_resta_"+ID).val(), 10);
            aux = aux - 1;
            if(aux<0)
                alert('La cantidad no puede ser menor a 0');
            else
            {
                $("#cantidad_resta_"+ID).val(aux);
                $("#cantidad_input_"+ID).val(aux);            

            }
        });
        
        $('#btnSave').bind('click',function(){
            if(!confirm('¿Est\xe1 seguro de hacer la actualizaci\xf3n de bodega?','Confirmar Accion'))
                    {
                        return false;
                    }
        });
        
});


