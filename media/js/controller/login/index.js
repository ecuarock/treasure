$(document).ready(function(){
	/*FORM VALIDATIONS*/
	$("#frmLogin").validate({
		errorLabelContainer: "#alerts",
		wrapper: "li",
		onfocusout: false,
		onkeyup: false,
		rules: {
			txtUsername: {
				required: true
			},
                        txtPassword: {
                                required: true
                        }
		},
		submitHandler: function(form) {	                        
			$('#btnSave').attr('disabled', 'true');
                        $('#btnSave').val('Espere por favor...');
			form.submit();
		}
	});
	
	//DIALOG FOR VALIDATION ALERTS
	$("#dialog_validation").dialog({
			autoOpen: false,
			//height: 200,
			width: 380,
			maxHeight :200,
			maxWidth :380,
			modal: true,
			hide: 'slide',
			show: 'slide',
			title: 'Alertas'
	});
	//END DIALOG FOR VALIDATION
	
	//DIALOG FOR ERROR ALERTS
	if($('#has_error').val()){		
		$("#dialog_errors").dialog({
				autoOpen: false,
				//height: 200,
				width: 380,
				maxHeight :200,
				maxWidth :380,
				modal: true,
				hide: 'slide',
				show: 'slide',
				title: 'Error'
		});
			
		$("#dialog_errors").dialog('open');	
	}
	//END DIALOG FOR ERRORS
	
	$('#btnSave').bind('click',function(){		
		if ($("#frmLogin").valid()){
                                $('#btnSave').val('Espere por favor...');
				$("#frmLogin").submit();
                                
		}else{
			$("#dialog_validation").dialog('open');
		}
	});
	$("body").bind('keypress',function(e){
		if(e.which == 13){
			$('#btnSave').focus();
			$('#btnSave').click();                        
		}
	});
});
