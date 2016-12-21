$(document).ready(function(){
    
    
    
	$('#btnSave').bind('click',function(){
            if(!confirm('¿Est\xe1 seguro de cambiar estado de Pedido a Aprobado?','Confirmar Accion'))
                    {
                        return false;
                    }
        });
        
        $('#btnCancel').bind('click',function(){
            if(!confirm('¿Est\xe1 seguro de cambiar estado de Pedido a Cancelado?','Confirmar Accion'))
                    {
                        return false;
                    }
        });
});