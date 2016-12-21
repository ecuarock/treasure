<?php
class Controller_Control_Despacho extends Controller_Control_Containers_Control {

	public function action_index()
	{            
            HTTP::redirect('control/despacho/create/');
	}


            
    public function action_get_content()
    {
        $content='';
		if($this->request->is_ajax())
		{
			$pedido_id =  arr::get($this->request->post(), 'pedido_id');
			try
			{
                            $closed = ORM::factory('pedidodespachoxproducto')
                            ->where('ID_PEDIDO','=',$pedido_id)
                            ->find_all()->as_array();
                            foreach ($closed as $value) {
                                $nombre_producto = ORM::factory('producto')->where('ID_PRODUCTO', '=', $value->ID_PRODUCTO)->find();
                                $content = $content.'<div class="span-17 line"><div class="span-8 label"> '.$nombre_producto->DESCRIPCION.'</div><div class="span-8 label"> Cantidad: '.$value->CANTIDAD.'</div> </div> ';
                            }
				echo json_encode($content);
			}
			catch(Exception $e)
			{
				echo json_encode($e->getMessage());
			}

			$this->auto_render = FALSE;
		}
		else
		{
			HTTP::redirect('control/main');
		}
	}

   public function action_procesar()
	{
		$this->view = View::factory('controller/control/despacho/procesar');
                $despachosp = DB::query(Database::SELECT, "SELECT Distinct(`ID_DESPACHO`) FROM `pedido_despacho_x_producto` WHERE `ESTADO` in ('ENVIADO') AND `ID_DESPACHO` is not NULL")->execute()->as_array();
                $despacho = array();
                foreach ($despachosp as $value) {
                    $despachos = ORM::factory('despacho')->where('ID_DESPACHO', '=', $value)->find();
                    $despacho = $despacho + array($despachos->ID_DESPACHO=>$despachos->as_array());
                }
                $users = ORM::factory('user')->distinct('ID_USUARIO')->find_all()->as_array();
                $user = array();
                foreach ($users as $value) {     
                    $nombres = $value->NOMBRE.'<br>'.$value->APELLIDO;
                    $user = $user + array($value->ID_USUARIO=>$nombres);
                }                
                if(! count($despacho))
                  $despacho=NULL;
                $this->view->set('user', $user);  
                $this->view->set('despacho', $despacho);
	}

  public function action_revisar()
	{
	//IF USER SUBMITTED FORM
        $this->view = View::factory( 'controller/control/despacho/revisar' );
        
        //IF USER SUBMITTED FORM        
	$ID_DESPACHO = $this->request->param('params');
        $pedidos = DB::query(Database::SELECT, "SELECT Distinct(`ID_PEDIDO`) FROM `pedido_despacho_x_producto` WHERE `ESTADO` in ('ENVIADO') AND `ID_DESPACHO` = ".$ID_DESPACHO."")->execute()->as_array();
        $this->view->set( 'pedidos', $pedidos);
        $despacho = ORM::factory('despacho')->where('ID_DESPACHO', '=', $ID_DESPACHO)->find();
        $this->view->set( 'despacho', $despacho );
        $user = ORM::factory('user')->where('ID_USUARIO', '=', $despacho->ID_USUARIO)->find();
        $this->view->set( 'user', $user->ID_USUARIO );
        $validar = count($pedidos);
        $this->view->set( 'validar', $validar );
        
        //VALIDATE POST
        if( $this->request->post() )
        {
            
                try
                {   
                    $values= $this->request->post();
                    $proceso = 0;
                    $pedidoProceso = array();
                    echo Debug::vars($values);
                    foreach ($values as $key=>$value) {
                        if(strpos($value, 'Comprar')!== false)
                        {
                            $proceso = 1;
                        } 
                        if(strpos($value, 'Enviar')!== false)
                        {
                            $proceso = 2;
                        } 
                        if(strpos($value, 'Entregar')!== false)
                        {
                            $proceso = 3;
                        } 
                        if(strpos($value, 'Cancelar')!== false)
                        {
                            $proceso = 4;
                        } 
                        if(strpos($key, 'ID_PEDIDO_')!== false)
                        {
                            $aux = explode('_', $key);
                            $pedidoProceso = $pedidoProceso + array($aux[2]=>$aux[2]);
                        }
                    }
                    switch ($proceso)
                    {
                        case 1:foreach ($pedidoProceso as $value) {
                                    DB::update('pedido_despacho_x_producto')->set(array('ID_DESPACHO'=>$ID_DESPACHO,'ESTADO'=>'COMPRADO'))->where('ID_PEDIDO', '=', $value)
                                                                ->execute();                            
                                }
                                FlashMessenger::factory()->set_message('success', Kohana::message('admin', 'admin:despacho:estado:comprado'));
                               break;
                        case 2:foreach ($pedidoProceso as $value) {
                                    DB::update('pedido_despacho_x_producto')->set(array('ID_DESPACHO'=>$ID_DESPACHO,'ESTADO'=>'ENVIADO'))->where('ID_PEDIDO', '=', $value)
                                                                ->execute();                            
                                }
                                FlashMessenger::factory()->set_message('success', Kohana::message('admin', 'admin:despacho:estado:enviado'));
                               break;
                        case 3:foreach ($pedidoProceso as $value) {
                                    $producto = ORM::factory('pedidodespachoxproducto')->where('ID_PEDIDO', '=', $value)->find_all();
                                    foreach ($producto as $value2) {
                                        $cantidad = ORM::factory('productoxbodega')->where('ID_PRODUCTO', '=', $value2->ID_PRODUCTO)->find();
                                        $valor = $cantidad->CANTIDAD + $value2->CANTIDAD;
                                        DB::update('producto_x_bodega')->set(array('CANTIDAD'=>$valor,))->where('ID_PRODUCTO', '=', $value2->ID_PRODUCTO)->execute();  
                                    }
                                    DB::update('pedido_despacho_x_producto')->set(array('ID_DESPACHO'=>$ID_DESPACHO,'ESTADO'=>'ENTREGADO'))->where('ID_PEDIDO', '=', $value)
                                                                ->execute();                            
                                }
                                
                                FlashMessenger::factory()->set_message('success', Kohana::message('admin', 'admin:despacho:estado:entregado'));
                               break;
                        case 4:foreach ($pedidoProceso as $value) {
                                    DB::update('pedido_despacho_x_producto')->set(array('ID_DESPACHO'=>$ID_DESPACHO,'ESTADO'=>'CANCELADO'))->where('ID_PEDIDO', '=', $value)
                                                                ->execute();                            
                                }
                                FlashMessenger::factory()->set_message('error', Kohana::message('admin', 'admin:despacho:estado:cancelado'));
                               break;
                        default : HTTP::redirect('control/main');
                            break;
                    }  
                }
                catch(Exception $e)
                {
                    echo $e->getMessage();
                    FlashMessenger::factory()->set_message('error', $e->getMessage());
                }
                HTTP::redirect('control/despacho/procesar/');
        }                        
                $this->view->set( '$despacho', $despacho );
	} 
}
?>