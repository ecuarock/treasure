<?php


class Controller_Admin_Pedido extends Controller_Admin_Containers_Admin {

	public function action_index()
	{            
            HTTP::redirect('admin/pedido/create/');
	}


    public function action_create()
	{
	//IF USER SUBMITTED FORM
        $this->view = View::factory( 'controller/admin/pedido/create' );
        
        //IF USER SUBMITTED FORM        
	$ID_PEDIDO = $this->request->param('params');
        $pedido = ORM::factory('pedido')->where('ID_PEDIDO', '=', $ID_PEDIDO)->find();
        $producto = ORM::factory('producto')->order_by('DESCRIPCION')->find_all()->as_array('ID_PRODUCTO', 'DESCRIPCION');        
        $this->view->set( 'producto', $producto );
        $user = ORM::factory('user')->where('ID_USUARIO', '=', $pedido->ID_USUARIO)->find();
        $this->view->set( 'user', $user->ID_USUARIO );
        if($ID_PEDIDO)
        {
            $PXP = ORM::factory('pedidodespachoxproducto')->where('ID_PEDIDO', '=', $ID_PEDIDO)->find_all()->as_array('ID_PRODUCTO', 'CANTIDAD' ); 
            $productos = count($PXP);
        }
        else
        {
            $PXP = '';
            $productos = 0;
        } 
        $this->view->set( 'PXP', $PXP );                
        $this->view->set( 'productos', $productos );
        
        
                
        //VALIDATE POST
        if( $this->request->post() )
        {
            
                try
                {       
                    
                    
                    $values= $this->request->post();
                    if($ID_PEDIDO)
                    {
                        $Eliminapxps = ORM::factory('pedidodespachoxproducto')->where('ID_PEDIDO', '=', $ID_PEDIDO)
                                                                              ->find_all();
                        foreach ($Eliminapxps as $Eliminapxp) {
                            DB::delete('pedido_despacho_x_producto')->where('ID_PDXP', '=', $Eliminapxp->ID_PDXP)
                                                                ->execute(Database::instance());
                        }                       
                    }
                                                               
                    $productosIngreso = array();
                    foreach ($values as $key => $value) {
                        if(strpos($key, 'CANTIDAD_')!== false)
                        {
                            $aux = explode('_', $key);
                            $productosIngreso = $productosIngreso + array($aux[1]=>$value);                            
                        }                        
                    }                    
                    if(!$ID_PEDIDO)
                    {
                    $tiempo = array('d'=>(int)date('d'),'m'=>(int)date('m'),'Y'=>(int)date('Y'),'H'=>(int)date('H'),'i'=>(int)date('i'));                    
                    $pedido->ID_USUARIO = Session::instance()->get('treasure_usuario');                    
                    $pedido->DIA = $tiempo['d'];
                    $pedido->MES = $tiempo['m'];
                    $pedido->ANIO = $tiempo['Y'];
                    $pedido->HORA = $tiempo['H'];
                    $pedido->MINUTO = $tiempo['i'];                    
                    $pedido->save();     
                    
                    $pedido2 = ORM::factory('pedido')->where('ID_USUARIO', '=', Session::instance()->get('treasure_usuario'))
                                     ->and_where('DIA', '=', $tiempo['d'])
                                     ->and_where('MES', '=', $tiempo['m'])
                                     ->and_where('ANIO', '=', $tiempo['Y'])
                                     ->and_where('HORA', '=', $tiempo['H'])
                                     ->and_where('MINUTO', '=', $tiempo['i'])
                                     ->find();     
                        foreach ($productosIngreso as $key=>$value) { 
                                $PXP2 = ORM::factory('pedidodespachoxproducto');
                                $PXP2->ID_PEDIDO = $pedido2->ID_PEDIDO;
                                $PXP2->ID_PRODUCTO = $key;
                                $PXP2->CANTIDAD = $value;
                                $PXP2->ESTADO = 'PEDIDO';
                                $PXP2->save();                                       
                        }
                    }
                    else
                    {
                        $pedido2 = ORM::factory('pedido')->where('ID_USUARIO', '=', $pedido->ID_USUARIO)
                                     ->and_where('DIA', '=', $pedido->DIA)
                                     ->and_where('MES', '=', $pedido->MES)
                                     ->and_where('ANIO', '=', $pedido->ANIO)
                                     ->and_where('HORA', '=', $pedido->HORA)
                                     ->and_where('MINUTO', '=', $pedido->MINUTO)
                                     ->find(); 
                        foreach ($productosIngreso as $key=>$value) { 
                                $PXP2 = ORM::factory('pedidodespachoxproducto');
                                $PXP2->ID_PEDIDO = $pedido2->ID_PEDIDO;
                                $PXP2->ID_PRODUCTO = $key;
                                $PXP2->CANTIDAD = $value;
                                $PXP2->ESTADO = 'PEDIDO';
                                $PXP2->save();                                       
                        }                       
                    }
                                                        
                        
                    if($ID_PEDIDO)
                        FlashMessenger::factory()->set_message('success', Kohana::message('admin', 'admin:pedido:create:update'));
                    else
                        FlashMessenger::factory()->set_message('success', Kohana::message('admin', 'admin:pedido:create:success')); 
                }
                catch(Exception $e)
                {
                    echo $e->getMessage();
                    FlashMessenger::factory()->set_message('error', $e->getMessage());
                }
                HTTP::redirect('admin/pedido/select/');
        }                        
                $this->view->set( 'pedido', $pedido );
	}	

  public function action_select()
	{
		$this->view = View::factory('controller/admin/pedido/select');
                $pedidosp = DB::query(Database::SELECT, "SELECT Distinct(`ID_PEDIDO`) FROM `pedido_despacho_x_producto` WHERE `ESTADO`='PEDIDO' AND `ID_DESPACHO` is NULL")->execute()->as_array();
                $pedido = array();
                foreach ($pedidosp as $value) {
                    $pedidos = ORM::factory('pedido')->where('ID_PEDIDO', '=', $value)->find();
                    $pedido = $pedido + array($pedidos->ID_PEDIDO=>$pedidos->as_array());
                }
                $users = ORM::factory('user')->distinct('ID_USUARIO')->find_all()->as_array();
                $user = array();
                foreach ($users as $value) {     
                    $nombres = $value->NOMBRE.'<br>'.$value->APELLIDO;
                    $user = $user + array($value->ID_USUARIO=>$nombres);
                }
                
                if(! count($pedido))
                  $pedido=NULL;
                $this->view->set('user', $user);  
                $this->view->set('pedido', $pedido);
	}	

  public function action_aprobar()
	{
		$this->view = View::factory('controller/admin/pedido/aprobar');
                $pedidosp = DB::query(Database::SELECT, "SELECT Distinct(`ID_PEDIDO`) FROM `pedido_despacho_x_producto` WHERE `ESTADO`='PEDIDO' AND `ID_DESPACHO` is NULL")->execute()->as_array();
                $pedido = array();
                foreach ($pedidosp as $value) {
                    $pedidos = ORM::factory('pedido')->where('ID_PEDIDO', '=', $value)->find();
                    $pedido = $pedido + array($pedidos->ID_PEDIDO=>$pedidos->as_array());
                }
                $users = ORM::factory('user')->distinct('ID_USUARIO')->find_all()->as_array();
                $user = array();
                foreach ($users as $value) {     
                    $nombres = $value->NOMBRE.'<br>'.$value->APELLIDO;
                    $user = $user + array($value->ID_USUARIO=>$nombres);
                }
                
                if(! count($pedido))
                  $pedido=NULL;
                $this->view->set('user', $user);  
                $this->view->set('pedido', $pedido);
	}

  public function action_revisar()
	{
	//IF USER SUBMITTED FORM
        $this->view = View::factory( 'controller/admin/pedido/revisar' );
        
        //IF USER SUBMITTED FORM        
	$ID_PEDIDO = $this->request->param('params');
        $pedido = ORM::factory('pedido')->where('ID_PEDIDO', '=', $ID_PEDIDO)->find();
        $producto = ORM::factory('producto')->order_by('DESCRIPCION')->find_all()->as_array('ID_PRODUCTO', 'DESCRIPCION');        
        $this->view->set( 'producto', $producto );
        if($ID_PEDIDO)
        {
            $PXP = ORM::factory('pedidodespachoxproducto')->where('ID_PEDIDO', '=', $ID_PEDIDO)->find_all()->as_array('ID_PRODUCTO', 'CANTIDAD' ); 
        }
        else
        {
            $PXP = '';
        } 
        $this->view->set( 'PXP', $PXP );        
        
        
                
        //VALIDATE POST
        if( $this->request->post() )
        {
            
                try
                {       
                    
                    
                    $values= $this->request->post();
                    if(isset($values['btnCancel']))
                    {
                        $pedidos = ORM::factory('pedidodespachoxproducto')->where('ID_PEDIDO', '=', $ID_PEDIDO)->and_where('ESTADO', '=', 'PEDIDO')->find_all();                    
                        foreach ($pedidos as $value) {
                            DB::update('pedido_despacho_x_producto')->set(array('ESTADO' => 'CANCELADO'))->where('ID_PDXP', '=', $value->ID_PDXP)->execute();              
                        }  
                        FlashMessenger::factory()->set_message('error', 'Se ha Cancelado el Pedido exitosamente.');
                    }
                    else 
                    {
                        $pedidos = ORM::factory('pedidodespachoxproducto')->where('ID_PEDIDO', '=', $ID_PEDIDO)->and_where('ESTADO', '=', 'PEDIDO')->find_all();                    
                        foreach ($pedidos as $value) {
                            DB::update('pedido_despacho_x_producto')->set(array('ESTADO' => 'APROBADO'))->where('ID_PDXP', '=', $value->ID_PDXP)->execute();              
                        } 
                        FlashMessenger::factory()->set_message('success', Kohana::message('admin', 'admin:pedido:revisar:aprobado'));
                    }
                }
                catch(Exception $e)
                {
                    echo $e->getMessage();
                    FlashMessenger::factory()->set_message('error', $e->getMessage());
                }
                HTTP::redirect('admin/pedido/aprobar/');
        }                        
                $this->view->set( 'pedido', $pedido );
	} 
}
?>