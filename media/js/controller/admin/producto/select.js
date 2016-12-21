$(document).ready(function(){
	$('#tblProductos').dataTable({
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
});


