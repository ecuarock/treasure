<?php


class Controller_Admin_User extends Controller_Admin_Containers_Admin {

	public function action_index()
	{            
            HTTP::redirect('admin/user/create/');
	}


    public function action_create()
	{
	//IF USER SUBMITTED FORM
        $this->view = View::factory( 'controller/admin/user/create' );
        
        //IF USER SUBMITTED FORM        
	$user_id = $this->request->param('params');
        $user = ORM::factory('user')->where('ID_USUARIO', '=', $user_id)->find();
        
        //VARIABLES FOR GET THE PROFILE OF USER FROM TABLE PERFILES
        $perfil = ORM::factory('perfil')->order_by('NOMBRE')->find_all()->as_array('ID_PERFIL', 'NOMBRE');
        $this->view->set('perfil',$perfil);
        
        //VARIABLES PARA OBTENER LOS DEPARTAMENTOS DEL USUARIO
        $departamento = ORM::factory('departamento')->order_by('NOMBRE')->find_all()->as_array('ID_DEPARTAMENTO', 'NOMBRE');
        $this->view->set('departamento',$departamento);
        
        //VALIDATE POST
        if( $this->request->post() )
        {
            
                try
                {                                    
                    
                    $values= $this->request->post();
                    
                    
                    
                    if($values['CONTRASENIA']=='')
                        $values['CONTRASENIA'] = $user->CONTRASENIA;
                    else
                        $values['CONTRASENIA'] = md5($values['CONTRASENIA']);
                    $user->values($values);
                    if(strlen($values['ID_DEPARTAMENTO'])==0)
                        $values['ID_DEPARTAMENTO']=NULL;
                    
                    if(!$user_id)
                        $usuario_nuevo = DB::insert('usuario', array('ID_USUARIO', 'ID_PERFIL', 'ID_DEPARTAMENTO', 'NOMBRE', 'APELLIDO', 'USUARIO', 'CONTRASENIA', 'ESTADO'))->values(array(NULL, $values['ID_PERFIL'], $values['ID_DEPARTAMENTO'], $values['NOMBRE'], $values['APELLIDO'], $values['USUARIO'], $values['CONTRASENIA'], $values['ESTADO']))->execute();
                    else
                        $usuario_nuevo = DB::update('usuario')->set (array('ID_PERFIL'=>$values['ID_PERFIL'], 'ID_DEPARTAMENTO'=>$values['ID_DEPARTAMENTO'], 'NOMBRE'=>$values['NOMBRE'], 'APELLIDO'=>$values['APELLIDO'], 'USUARIO'=>$values['USUARIO'], 'CONTRASENIA'=>$values['CONTRASENIA'], 'ESTADO'=>$values['ESTADO']))->where ('ID_USUARIO', '=', $user->ID_USUARIO)->execute ();
                        
                    if($user_id)
                        FlashMessenger::factory()->set_message('success', Kohana::message('admin', 'admin:user:create:update'));
                    else
                        FlashMessenger::factory()->set_message('success', Kohana::message('admin', 'admin:user:create:success'));  
                    
                    
                }
                catch(Exception $e)
                {
                    echo $e->getMessage();
                    FlashMessenger::factory()->set_message('error', $e->getMessage());
                }
                HTTP::redirect('admin/user/select/');
        }                        
                $this->view->set( 'user', $user );
	}	

   public function action_checkuser()
	{
		$this->auto_render=false;
		if ($this->request->is_ajax())
		{
			$id = arr::get($this->request->post(), 'id');
			$usuario = arr::get($this->request->post(), 'USUARIO');
                        
                        $usuario = strtolower($usuario);

			$valid = ORM::factory('user')->where(DB::expr("LOWER(USUARIO)"),'=',$usuario)->find();
                        
                        $user_id = $valid->ID_USUARIO;
                        
                                              
                        if($id!='')
                        {
                            if($id == $user_id)
                            {
                                echo json_encode(true);
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
		$this->view = View::factory('controller/admin/user/select');
		$users = ORM::factory('user')->find_all();                
                $perfiles = ORM::factory('perfil')->find_all();
                $deparamentos = ORM::factory('departamento')->find_all()->as_array();  
                $perfiles_array = array();
                $departamentos_array = array(NULL=>'NINGUNO');                
                foreach ($perfiles as $perfil)
                    $perfiles_array[$perfil->ID_PERFIL] = $perfil->NOMBRE;
                foreach ($deparamentos as $deparamento)
                    $departamentos_array[$deparamento->ID_DEPARTAMENTO] = $deparamento->NOMBRE;
                
                if(! $users->count())
                  $users=NULL;
		
                   
                   $this->view->set('users', $users);
                   $this->view->set('perfiles_array', $perfiles_array);
                   $this->view->set('departamentos_array', $departamentos_array);
	}   
    
}
?>