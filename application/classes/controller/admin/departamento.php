<?php


class Controller_Admin_Departamento extends Controller_Admin_Containers_Admin {

	public function action_index()
	{            
            HTTP::redirect('admin/departamento/create/');
	}


    public function action_create()
	{
	//IF USER SUBMITTED FORM
        $this->view = View::factory( 'controller/admin/departamento/create' );
        
        //IF USER SUBMITTED FORM        
	$ID_DEPARTAMNTO = $this->request->param('params');
        $departamento = ORM::factory('departamento')->where('ID_DEPARTAMENTO', '=', $ID_DEPARTAMNTO)->find();
        
                
        //VALIDATE POST
        if( $this->request->post() )
        {
            
                try
                {                                    
                    $values= $this->request->post();
                    
                    
                    $departamento->values($values);
                    
                    if(!$ID_DEPARTAMNTO)
                        $departamento_nuevo = DB::insert('departamento', array('ID_DEPARTAMENTO', 'NOMBRE', 'DESCRIPCION'))->values(array(NULL, $values['NOMBRE'], $values['DESCRIPCION']))->execute();
                    else
                        $departamento_nuevo = DB::update('departamento')->set (array('NOMBRE'=>$values['NOMBRE'], 'DESCRIPCION'=>$values['DESCRIPCION']))->where ('ID_DEPARTAMENTO', '=', $departamento->ID_DEPARTAMENTO)->execute();
                    
                                      
                        
                    if($departamento->ID_DEPARTAMENTO)
                        FlashMessenger::factory()->set_message('success', Kohana::message('admin', 'admin:departamento:create:update'));
                    else
                        FlashMessenger::factory()->set_message('success', Kohana::message('admin', 'admin:departamento:create:success'));                      
                }
                catch(Exception $e)
                {
                    echo $e->getMessage();
                    FlashMessenger::factory()->set_message('error', $e->getMessage());
                }
                HTTP::redirect('admin/departamento/select/');
        }                        
                $this->view->set( 'departamento', $departamento );
	}	

   public function action_checknombre()
	{
		$this->auto_render=false;
		if ($this->request->is_ajax())
		{
			$ID = arr::get($this->request->post(), 'id');
                        
			$NOMBRE = strtolower(arr::get($this->request->post(), 'NOMBRE'));
                        
			$valid = ORM::factory('departamento')->where(DB::expr("LOWER(NOMBRE)"),'like',$NOMBRE)->find();
                        
                        $user_id = $valid->ID_DEPARTAMENTO;
                        
                                              
                        if($ID!='')
                        {
                            if($ID == $user_id)
                            {
                                echo json_encode(true);
                            }
                            else
                            {
                                echo json_encode(false);
                            }
                        }
                        else
                        {
                            if($user_id==null)
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
		$this->view = View::factory('controller/admin/departamento/select');
		$departamentos = ORM::factory('departamento')->find_all();    
                
                if(! $departamentos->count())
                  $departamentos=NULL;
		                   
                $this->view->set('departamentos', $departamentos);
	}   
    
}
?>