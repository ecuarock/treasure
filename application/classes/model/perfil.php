<?php defined('SYSPATH') or die('No direct access allowed.');
class Model_Perfil extends ORM {
	public static $status_values = array('Activo' => 'Activo', 'Inactivo' => 'Inactivo');
        
        protected $_table_name = 'perfil';



    
	public static function verifica_perfil($id_perfil)
	{
            $perfil = ORM::factory('perfil')->where('ID_PERFIL', '=', $id_perfil)->find();   
            
		if (strtolower(trim($perfil->NOMBRE))=='administrador')
                {
                        $ret = 1;
			return $ret;
                }
                if (strtolower(trim($perfil->NOMBRE))=='solicitante')
                {
			$ret = 2;
			return $ret;
                }
                if (strtolower(trim($perfil->NOMBRE))=='aprovador')
                {
			$ret = 3;
			return $ret;
                }
                if (strtolower(trim($perfil->NOMBRE))=='controlador')
                {
			$ret = 4;
			return $ret;
                }
                if (strtolower(trim($perfil->NOMBRE))=='proveedor')
                {
			$ret = 5;
			return $ret;
                }
                else
                    return 0;
	}
}

?>