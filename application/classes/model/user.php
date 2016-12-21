<?php defined('SYSPATH') or die('No direct access allowed.');
class Model_User extends ORM {
	public static $status_values = array('Activo' => 'Activo', 'Inactivo' => 'Inactivo');
        
        protected $_table_name = 'usuario';        
         
	public static function authenticate($username, $password)
	{
            $user = ORM::factory('user')->where('USUARIO', '=', $username)->find();   
            
		if (($user->loaded())!=false)
                {
			return false;
                }

		if ($user->ESTADO != 'Activo')
                {
			return false;
                }

		if ($password != $user->CONTRASENIA)
		{
			return false;
		}

        return $user;
	}

}

?>
