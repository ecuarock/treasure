<?php defined('SYSPATH') or die('No direct script access.');

class Helper_Supplier_Menu {
    public static function menu($seg1 = null, $seg2 = null, $seg3 = null)
    {		
        $items = array();
        
          
                
         /*DESPACHOS*/
         $items[] = array('id' => 1, 'parent_id' => 0, 'title' => 'Despachos', 'link' => '#');
         $items[] = array('id' => 2, 'parent_id' => 1, 'title' => 'Nuevo', 'link' => 'supplier/despacho/create');
         $items[] = array('id' => 3, 'parent_id' => 1, 'title' => 'Modificar', 'link' => 'supplier/despacho/select');
         $items[] = array('id' => 4, 'parent_id' => 1, 'title' => 'Procesar', 'link' => 'supplier/despacho/procesar');
         
         
         
                 
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
