$(document).ready(function(){
    /*FORM VALIDATIONS*/
        $("#frmUser").validate({
            errorLabelContainer: "#alerts",
            wrapper: "li",
            onfocusout: false,
            onkeyup: false,
                async:false,
            rules: {
                NOMBRE: {
                    required: true,
                    maxlength: 30,
                    textOnly: true
                },
                APELLIDO: {
                    required: true,
                    maxlength: 30,
                    textOnly: true
                },
                ID_PERFIL:{
                    required: true
                },
                USUARIO:{
                    required: true,
                    remote:{
                                url: document_root+"admin/user/checkuser",
                                type: 'post',
                                data:{                                  
                                    id: $('#id').val()                                    
                                }
                            },
                    maxlength: 20,
                    minlength: 5,
                    textOnly: true
                },
                ESTADO: {
                    required: true
                }
            },
            messages:{
                NOMBRE: {
                    required: 'El campo "Nombre" es obligatorio.',
                    maxlength: 'El campo "Nombre" debe contener m&aacute;ximo 50 caracteres.',
                    textOnly: 'El campo "Nombre" solo puede contener letras.'
                },
                APELLIDO: {
                    required: 'El campo "Apellido" es obligatorio.',
                    maxlength: 'El campo "Apellido" debe contener m&aacute;ximo 50 caracteres.',
                    textOnly: 'El campo "Apellido" solo puede contener letras.'
                },
                ID_PERFIL:{
                    required: 'El campo "Cargo" es obligatorio.'
                },
                USUARIO:{
                    required: 'El campo "Usuario" esobligatorio.',
                    remote: 'El Usuario ingresado ya existe.',
                    maxlength: 'El campo "Usuario" debe contener m&iacute;nimo 20 caracteres.',
                    minlength: 'El campo "Usuario" debe contener m&iacute;nimo 5 caracteres.',
                    textOnly: 'El campo "Usuario" debe contener solo caracteres.'
                },
                ESTADO: {
                    required: 'El campo "Estado" es obligatorio.'
                }
            },
            submitHandler: function(form) {
                $('#type_id').attr('disabled',false);
                $('#btnSave').attr('disabled', 'true');
                $('#btnSave').val('Espere por favor...');
                form.submit();
            }
        });
    /*END FORM VALIDATIONS*/
    
    //VALIDATES FIELDS WHEN IT'S AN UPDATE
        if(!$("#id").val())
       addPasswordRules();
   
       if($("#cargarperfil option:selected").val()!=2)
           {
                $('#cargardepartamento').css('display','none');
                $('#ID_DEPARTAMENTO').rules('remove');
                $('#ID_DEPARTAMENTO').val('');
           }
    
    /* LISTENERS */
        $('[id^="change_pass_"]').bind('click',function(){
			if($(this).val()=='yes'){
				$('#passContainer').css('display','block');
				addPasswordRules();
			}else{
				$('#passContainer').css('display','none');
				$('#CONTRASENIA').rules('remove');
				$('#confPassword').rules('remove');
				$('#password').val('');
				$('#confPassword').val('');
			}
		});  
                
        $("#cargarperfil").bind('change',function(){                        
                        if($("#cargarperfil option:selected").val()==2){
                            $('#cargardepartamento').css('display','block');
                            addDepartaentoRules();                           
                        }else{
				$('#cargardepartamento').css('display','none');
				$('#ID_DEPARTAMENTO').rules('remove');
				$('#ID_DEPARTAMENTO').val('');
			}
                        
    
                });
                
        $("#USUARIO").bind('change',function(){
            var nick = $("#USUARIO").val()
            $('#nickname').val(nick);
        });
        
                
        
    /* END LISTENERS */     
    
});

//ADD PASSWORD RULES 
function addPasswordRules()
{
    $('#CONTRASENIA').rules('add',{
        required:true,
        minlength: 6,
        maxlength: 15,
        messages: {
            required:'El campo "Contrase&ntilde;a" es obligatorio.',
            minlength: 'El campo "Contrase&ntilde;a" debe contener m&iacute;nimo 6 caracteres.',
            maxlength: 'El campo "Contrase&ntilde;a" debe contener m&aacute;ximo 15 caracteres.'
        }
    });
    $('#confPassword').rules('add',{
        required:true,
        minlength: 6,
        maxlength: 15,
        equalTo: "#CONTRASENIA",                    
        messages: {
            required: 'El campo "Confirmar Contrase&ntilde;a" es obligatorio.',
            minlength: 'El campo "Confirmar Contrase&ntilde;a" debe contener m&iacute;nimo 6 caracteres.',
            maxlength: 'El campo "Confirmar Contrase&ntilde;a" debe contener m&aacute;ximo 15 caracteres.',
            equalTo: 'El campo "Contrase&ntilde;a" y "Confirmar Contrase&ntilde;a" deben coincidir.'
        }
    });
}


function addDepartaentoRules()
{
    $('#ID_DEPARTAMENTO').rules('add',{
        required:true,
        messages: {
            required: 'El campo "Departamento" es obligatorio.'
        }
    });
}