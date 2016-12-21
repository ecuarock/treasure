<?php


class Controller_Admin_Bodega extends Controller_Admin_Containers_Admin {

	public function action_index()
	{            
            HTTP::redirect('admin/bodega/select/');
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
			HTTP::redirect('admin/main');
		}
	}

    public function action_select()
	{
		$this->view = View::factory('controller/admin/bodega/select');
		$productos = ORM::factory('producto')->find_all();
                $bodega = ORM::factory('productoxbodega')->find_all();
                $producto = array();
                
                foreach ($productos as $value) {
                    $producto = $producto + array( $value->ID_PRODUCTO=>$value->DESCRIPCION);
                }
                
                if(! count($bodega))
                  $bodega=NULL;
		                   
                $this->view->set('bodega', $bodega);
                $this->view->set('producto', $producto);
	}   
    
}
?>