$(document).ready(function(){
    /*FORM VALIDATIONS*/
        $("#frmDepartamento").validate({
            errorLabelContainer: "#alerts",
            wrapper: "li",
            onfocusout: false,
            onkeyup: false,
                async:false,
            rules: {
                NOMBRE: {
                    required: true,
                    maxlength: 50,
                    textOnly: true,
                    remote:{
                                url: document_root+"admin/departamento/checknombre",
                                type: 'post',
                                data:{                                  
                                    id: $('#ID_DEPARTAMENTO').val()
                                }
                            }
                },
                DESCRIPCION: {
                    required: true,
                    textOnly: true
                }
            },
            messages:{
                NOMBRE: {
                    required: 'El campo "Nombre" es obligatorio.',
                    maxlength: 'El campo "Nombre" debe contener m&aacute;ximo 50 caracteres.',
                    textOnly: 'El campo "Nombre" solo puede contener letras.',
                    remote: 'El Nombre del departamento ya existe.'
                },
                DESCRIPCION: {
                    required: 'El campo "Descripcion" es obligatorio.',
                    textOnly: 'El campo "Descripcion" solo puede contener letras.'
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
    
    /* LISTENERS */                
        $("#NOMBRE").bind('change',function(){
            var nick = $("#NOMBRE").val()
                $('#nickname').val(nick);
        });        
                
        
    /* END LISTENERS */     
    
});

