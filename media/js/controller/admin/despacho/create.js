$(document).ready(function(){
    var validacheck=$("#validar").val();
    
    /*FORM VALIDATIONS*/
    $("#frmDespacho").validate({
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
                required: 'Debe elegir por lo menos un pedido',
                min: 'Debe elegir por lo menos un pedido'
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
    $('[id^="ID_PEDIDO_"]').bind('click',function(){
        if($(this).is(':checked'))
            {
                validacheck++;
                $('#validar').val(validacheck);
            }
         else
             {
                validacheck--;
                $('#validar').val(validacheck);
             }
	});  
        
        
    /* END LISTENERS */    
    $(function() {
            $( "#dialog" ).dialog({
                autoOpen: false,
                height: 350,
                width:550,
                show: "blind",
                hide: "blind"
            });
        });
    $(".des-pedido-link").click(function(e){
       e.preventDefault();
       var titulo_pedido = $(this).attr("pedido_id");
       var contenido_pedido = '';
       $( "#contenido" ).empty();
        $.ajax({
            url:document_root+'admin/despacho/get_content',
            async: false,
            type: "post",
            data: ({
                pedido_id: $(this).attr("pedido_id")
            }),
            dataType: 'json',
            success: function(data){
                contenido_pedido = data
            }
        });
        

       $( "#dialog" ).dialog( "open" );
       $( "#ui-dialog-title-dialog" ).html('Productos del Pedido: '+titulo_pedido);
       $( "#contenido" ).append(contenido_pedido);
       
    });
    
});

