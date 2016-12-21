<?php defined('SYSPATH') or die('No direct script access.');

class Controller_User_Main extends Controller_User_Containers_User {
    
    public function action_index()
	{
            $option = $this->request->param('params');
            $user = ORM::factory('user')->where('ID_USUARIO', '=', Session::instance()->get('treasure_usuario'))->find();
            $name = ''.strtoupper ($user->NOMBRE).'';            
            $this->view = View::factory( 'controller/user/main' );
            $this->view->set('name',$name);
	}
}