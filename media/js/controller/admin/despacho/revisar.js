$(document).ready(function(){
    var validacheck=$("#validar").val();
    
    
    $('[id^="btn_"]').bind('click',function(){
            var ID=$(this).attr('id');
            ID = ID.split('_');
            ID = ID[1];
            
            if(ID=='Comprar')
            {
                if(!confirm('¿Est\xe1 seguro de cambiar estado de despacho a Comprado?','Confirmar Accion'))
                    {
                        return false;
                    }
            }
            if(ID=='Enviar')
            {
                if(!confirm('¿Est\xe1 seguro de cambiar estado de despacho a Enviado?','Confirmar Accion'))
                    {
                        return false;
                    }
            }
            if(ID=='Entregar')
            {
                if(!confirm('¿Est\xe1 seguro de cambiar estado de despacho a Entregado?','Confirmar Accion'))
                    {
                        return false;
                    }
            }
            if(ID=='Cancelar')
            {
                if(!confirm('¿Est\xe1 seguro de cambiar estado de despacho a Cancelado?\n\n\nNota: esto tambien cancela los pedidos aprobados anteriormente.','Confirmar Accion'))
                    {
                        return false;
                    }
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

