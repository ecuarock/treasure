<?php defined('SYSPATH') or die('No direct script access.');

class Helper_Manager_Menu {
    public static function menu($seg1 = null, $seg2 = null, $seg3 = null)
    {		
        $items = array();
        
             
	 /*PEDIDOS*/
         $items[] = array('id' => 1, 'parent_id' => 0, 'title' => 'Pedidos', 'link' => '#');
         $items[] = array('id' => 2, 'parent_id' => 1, 'title' => 'Aprobar', 'link' => 'manager/pedido/aprobar');
         
         
		// Build the current path
		$current = '';
		$current .= $seg1 ? $seg1 : '';
		$current .= $seg2 ? ('/' . $seg2): '';
		$current .= $seg3 ? ('/' . $seg3): '';
		
		// Let's get the body of the current page
		//$body = ORM::factory('entry')->where('link','=', $current)->find()->body;
		$options = array('link_prepend' => '', 'current_path' => $current);
	
        return MenuStructure::factory($items, $options)->get_menu();

    }
    
}

?>
