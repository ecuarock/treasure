$(document).ready(function(){
    var validacheck=$("#validar").val();
    
    /*FORM VALIDATIONS*/
    $("#frmPedido").validate({
        errorLabelContainer: "#alerts",
        wrapper: "li",
        onfocusout: false,
        onkeyup: false,
        async:false,
        rules: {     
            validar: {
                required: true,
                min: true
            }
                
        },
        messages:{   
            validar: {
                required: 'Debe elegir por lo menos un producto',
                min: 'Debe elegir por lo menos un producto'
            }
        },           

        submitHandler: function(form) {  
            $('#btnSave').attr('disabled', 'true');
            $('#btnSave').val('Espere por favor...');
            form.submit();
        }
    });
    /*END FORM VALIDATIONS*/
    
    /* LISTENERS */
    $('[id^="ID_PRODUCTO_"]').bind('click',function(){
        if($(this).is(':checked'))
            {
                $('#CANTIDAD_'+$(this).val()+'').attr('disabled',false);
                validacheck++;
                $('#validar').val(validacheck);
                $('#CANTIDAD_'+$(this).val()+'').rules('add',{
                    required:true,
                    maxlength: 2,
                    digits: true,
                    messages: {
                        required:'El campo "Cantidad" es obligatorio.',
                        maxlength: 'El campo "Cantidad" debe contener m&aacute;ximo 2 digitos.',
                        digits: 'El campo "Cantidad" debe contener solo digitos.'
                    }
                }); 
            }
         else
             {
                $('#CANTIDAD_'+$(this).val()+'').attr('disabled',true);
                $('#CANTIDAD_'+$(this).val()+'').val('');
                validacheck--;
                $('#validar').val(validacheck);
             }
	});    
        
        
    /* END LISTENERS */     
    
});

//ADD PASSWORD RULES 
function addAniadirRules(aumenta)
{    
    $('#CANTIDAD_'+aumenta).rules('add',{
        required:true,
        maxlength: 2,
        digits: true,
        messages: {
            required:'El campo "Cantidad" es obligatorio.',
            maxlength: 'El campo "Cantidad" debe contener m&aacute;ximo 2 digitos.',
            digits: 'El campo "Contrase&ntilde;a" debe contener solo digitos.'
        }
    });    
}