<?php


class Controller_User_Bodega extends Controller_User_Containers_User {

	public function action_index()
	{            
            HTTP::redirect('user/bodega/select/');
	}
	

   public function action_editcontent()
	{
		if($this->request->is_ajax())
		{
			$pxb_id =  arr::get($this->request->post(), 'pxb_id');
                        $cantidad =  arr::get($this->request->post(), 'cantidad');
			try
			{
                            DB::update('producto_x_bodega')->set(array('CANTIDAD'=>$cantidad))->where('ID_PXB', '=', $pxb_id)
                                                                ->execute();
                            $content = (int)$cantidad;
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
			HTTP::redirect('user/main');
		}
	}

    public function action_select()
	{
		$this->view = View::factory('controller/user/bodega/select');
                $departamento = ORM::factory('user')->where('ID_USUARIO', '=', Session::instance()->get('treasure_usuario'))->find();                
		$productos = ORM::factory('producto')->where('ID_DEPARTAMENTO', '=', $departamento->ID_DEPARTAMENTO)->find_all();
                $producto = array();
                foreach ($productos as $value) {
                    $producto = $producto + array($value->ID_PRODUCTO => $value->ID_PRODUCTO);
                }
                $bodega = ORM::factory('productoxbodega')->where('ID_PRODUCTO', 'IN', $producto)->find_all();
                $producto = array();                
                foreach ($productos as $value) {
                    $producto = $producto + array( $value->ID_PRODUCTO=>$value->DESCRIPCION);
                }              
                
                if(! count($bodega))
                  $bodega=NULL;
                
                if( $this->request->post() )
                {

                        try
                        {                                    

                            $values= $this->request->post();
                                
                            $producto_resta = array();
                            
                            foreach ($values as $key => $value) {
                                if(strpos($key, 'cantidad_resta_')!== false)
                                {
                                    $aux = explode('_', $key);
                                    if($value!=0)
                                        $producto_resta = $producto_resta + array($aux[2] => $value);
                                }                        
                            }
                            
                            if(count($producto_resta))
                            {
                                foreach ($producto_resta as $key => $value) {
                                    $aux = ORM::factory('productoxbodega')->where('ID_PXB', '=', $key)->find();
                                    $aux = $aux->CANTIDAD - $value;
                                    $actualizar_cantidad = DB::update('producto_x_bodega')->set (array('CANTIDAD'=>$aux))->where ('ID_PXB', '=', $key)->execute ();                                    
                                }
                            }
                            if(count($producto_resta))
                                FlashMessenger::factory()->set_message('success', Kohana::message('admin', 'admin:producto:create:cantidad'));
                            else
                                FlashMessenger::factory()->set_message('success', Kohana::message('admin', 'admin:producto:create:nada'));  


                        }
                        catch(Exception $e)
                        {
                            echo $e->getMessage();
                            FlashMessenger::factory()->set_message('error', $e->getMessage());
                        }
                        HTTP::redirect('user/main/');
                }
		                   
                $this->view->set('bodega', $bodega);
                $this->view->set('producto', $producto);
	}   
    
}
?>