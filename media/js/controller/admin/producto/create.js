$(document).ready(function(){
    /*FORM VALIDATIONS*/
        $("#frmProducto").validate({
            errorLabelContainer: "#alerts",
            wrapper: "li",
            onfocusout: false,
            onkeyup: false,
                async:false,
            rules: {
                DESCRIPCION: {
                    required: true,
                    remote:{
                                url: document_root+"admin/producto/checkdescripcion",
                                type: 'post',
                                data:{                                  
                                    id: $('#ID_PRODUCTO').val()                                    
                                }
                            },
                    maxlength: 50
                },
                ID_DEPARTAMENTO: {
                    required: true
                }
            },
            messages:{
                DESCRIPCION: {
                    required: 'El campo "Producto" es obligatorio.',
                    maxlength: 'El campo "Producto" debe contener m&aacute;ximo 50 caracteres.',
                    remote: 'El Producto ingresado ya existe.'
                },
                ID_DEPARTAMENTO: {
                    required: 'El campo "Departamento" es obligatorio.'
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
    
    
});
