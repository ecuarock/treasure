<?php defined('SYSPATH') or die('No direct script access.');


class Controller_Login extends Controller_Containers_Login {
	
	/**
	 * DEFAULT ACTION
	 */
	public function action_index()
	{
             
		Session::instance()->set( 'treasure_usuario', FALSE );
		//IF USER SUBMITTED FORM
			if( $this->request->post() )
			{
				//VERIFYING USER
                               
			$user = Model_User::authenticate(arr::get($this->request->post(), 'txtUsername'), md5(arr::get($this->request->post(), 'txtPassword')));
                                        

                    if($user)
                    {
                        $username_usr = $user->USUARIO;
                        $type = $user->ID_PERFIL;
                        $id = $user->ID_USUARIO;
                        $usertype_usr = Model_Perfil::verifica_perfil($type);
                    }

					if (isset($username_usr))
					{
                                                
						Session::instance()->set('treasure_usuario', $id);
						Session::instance()->set('exceptions', array());
                                                
                                                if($usertype_usr==1)
                                                {
                                                    HTTP::redirect('admin/main');
                                                }
                                                if($usertype_usr==2)
                                                {
                                                    HTTP::redirect('user/main' );
                                                }
                                                if($usertype_usr==3)
                                                {
                                                    HTTP::redirect('manager/main' );
                                                }
                                                if($usertype_usr==4)
                                                {
                                                    HTTP::redirect('control/main' );
                                                }
                                                if($usertype_usr==5)
                                                {
                                                    HTTP::redirect('supplier/main' );
                                                }
                                                
					}
					else
					{
						$this->view = View::factory( 'controller/login' );
						$this->view->set( 'error_validation', 1 );
					}
			}
			else
			{
				$this->view = View::factory( 'controller/login' );
				$this->view->set( 'error_validation', 0 );
			}	
	}
	
}