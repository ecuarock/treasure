<?php
class Controller_Admin_Producto extends Controller_Admin_Containers_Admin {

	public function action_index()
	{            
            HTTP::redirect('admin/producto/create/');
	}


    public function action_create()
	{
	//IF USER SUBMITTED FORM
        $this->view = View::factory( 'controller/admin/producto/create' );
        
        //IF USER SUBMITTED FORM        
	$ID_PRODUCTO = $this->request->param('params');
        $producto = ORM::factory('producto')->where('ID_PRODUCTO', '=', $ID_PRODUCTO)->find();
        $this->view->set('producto',$producto);
        $departamento = ORM::factory('departamento')->order_by('NOMBRE')->find_all()->as_array('ID_DEPARTAMENTO', 'NOMBRE');
        $this->view->set('departamento',$departamento);
        
                
        //VALIDATE POST
        if( $this->request->post() )
        {
                try
                {              
                    
                    $values= $this->request->post();
                    
                    $producto->values($values);
                    
                    if(!$ID_PRODUCTO)
                    {
                        $producto_nuevo = DB::insert('producto', array('ID_PRODUCTO', 'ID_DEPARTAMENTO', 'DESCRIPCION'))->values(array(NULL, $values['ID_DEPARTAMENTO'], $values['DESCRIPCION']))->execute();
                        $aux = mysql_insert_id();
                        $producto_nuevo = DB::insert('producto_x_bodega', array('ID_PXB', 'ID_PRODUCTO', 'ID_BODEGA', 'CANTIDAD'))->values(array(NULL, $aux, 1, 0))->execute();
                    }
                    else
                        $producto_nuevo = DB::update('producto')->set (array('ID_DEPARTAMENTO'=>$values['ID_DEPARTAMENTO'], 'DESCRIPCION'=>$values['DESCRIPCION']))->where ('ID_PRODUCTO', '=', $producto->ID_PRODUCTO)->execute();
                                  
                        
                    if($ID_PRODUCTO)
                        FlashMessenger::factory()->set_message('success', Kohana::message('admin', 'admin:producto:create:update'));
                    else
                        FlashMessenger::factory()->set_message('success', Kohana::message('admin', 'admin:producto:create:success')); 
                }
                catch(Exception $e)
                {
                    echo $e->getMessage();
                    FlashMessenger::factory()->set_message('error', $e->getMessage());
                }
                HTTP::redirect('admin/producto/select/');
        }                        
                $this->view->set( 'producto', $producto );
	}	

   public function action_checkdescripcion()
	{
		$this->auto_render=false;
		if ($this->request->is_ajax())
		{
			$ID = arr::get($this->request->post(), 'id');
			$DESCRIPCION = arr::get($this->request->post(), 'DESCRIPCION');
                        $DESCRIPCION = strtolower($DESCRIPCION);
                        
			$valid = ORM::factory('producto')->where(DB::expr("LOWER(DESCRIPCION)"),'=',$DESCRIPCION)->find();
                        
                        
                        $producto_id = $valid->ID_PRODUCTO;
                        
                                              
                        if($ID!='')
                        {
                            if($ID == $producto_id)
                            {
                                echo json_encode(true);
                            }
                            else
                            {
                                if($producto_id==null)
                                {
                                    echo json_encode(true);
                                }
                                else
                                {
                                    echo json_encode(false);
                                }                                
                            }
                        }
                        else
                        {
                            if($producto_id==null)
                            {
                                echo json_encode(true);
                            }
                            else
                            {
                                echo json_encode(false);
                            }
                        }
			
		}
	}

    public function action_select()
	{
		$this->view = View::factory('controller/admin/producto/select');
		$productos = ORM::factory('producto')->find_all();    
                $departamento = ORM::factory('departamento')->order_by('NOMBRE')->find_all()->as_array('ID_DEPARTAMENTO', 'NOMBRE');
                $this->view->set('departamento',$departamento);
                
                if(! $productos->count())
                  $productos=NULL;
		                   
                $this->view->set('productos', $productos);
	}   
    
}
?>