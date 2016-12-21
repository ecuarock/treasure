<?php defined('SYSPATH') or die('No direct script access.');

class Helper_Admin_Menu {
    public static function menu($seg1 = null, $seg2 = null, $seg3 = null)
    {		
        $items = array();
        
        
        /*USUARIO*/
        $items[] = array('id' => 1, 'parent_id' => 0, 'title' => 'Usuario', 'link' => '#');        
        $items[] = array('id' => 2, 'parent_id' => 1, 'title' => 'Nuevo', 'link' => 'admin/user/create');
        $items[] = array('id' => 3, 'parent_id' => 1, 'title' => 'Modificar', 'link' => 'admin/user/select');

        /*DEPARTAMENTOS*/
         $items[] = array('id' => 4, 'parent_id' => 0, 'title' => 'Departamentos', 'link' => '#');
         $items[] = array('id' => 5, 'parent_id' => 4, 'title' => 'Nuevo', 'link' => 'admin/departamento/create');         
         $items[] = array('id' => 6, 'parent_id' => 4, 'title' => 'Modificar', 'link' => 'admin/departamento/select');
           
         /*PRODUCTOS*/
         $items[] = array('id' => 7, 'parent_id' => 0, 'title' => 'Productos', 'link' => '#');
         $items[] = array('id' => 8, 'parent_id' => 7, 'title' => 'Nuevo', 'link' => 'admin/producto/create');
         $items[] = array('id' => 9, 'parent_id' => 7, 'title' => 'Modificar', 'link' => 'admin/producto/select');     
                 
	 /*PEDIDOS*/
         $items[] = array('id' => 10, 'parent_id' => 0, 'title' => 'Pedidos', 'link' => '#');
         $items[] = array('id' => 11, 'parent_id' => 10, 'title' => 'Nuevo', 'link' => 'admin/pedido/create');
         $items[] = array('id' => 12, 'parent_id' => 10, 'title' => 'Modificar', 'link' => 'admin/pedido/select');
         $items[] = array('id' => 13, 'parent_id' => 10, 'title' => 'Aprobar', 'link' => 'admin/pedido/aprobar');
                
         /*DESPACHOS*/
         $items[] = array('id' => 14, 'parent_id' => 0, 'title' => 'Despachos', 'link' => '#');
         $items[] = array('id' => 15, 'parent_id' => 14, 'title' => 'Nuevo', 'link' => 'admin/despacho/create');
         $items[] = array('id' => 16, 'parent_id' => 14, 'title' => 'Modificar', 'link' => 'admin/despacho/select');
         $items[] = array('id' => 17, 'parent_id' => 14, 'title' => 'Procesar', 'link' => 'admin/despacho/procesar');
         
         /*BODEGA*/
         $items[] = array('id' => 20, 'parent_id' => 0, 'title' => 'Bodega', 'link' => '#');
         $items[] = array('id' => 21, 'parent_id' => 20, 'title' => 'Manejo', 'link' => 'admin/bodega/select');
         
         /*REPORTES*/
         $items[] = array('id' => 22, 'parent_id' => 0, 'title' => 'Reportes', 'link' => '#');
         $items[] = array('id' => 23, 'parent_id' => 22, 'title' => 'Pedidos', 'link' => 'admin/reporte/pedido');
         $items[] = array('id' => 24, 'parent_id' => 22, 'title' => 'Despachos', 'link' => 'admin/reporte/despacho');
         $items[] = array('id' => 25, 'parent_id' => 22, 'title' => 'Productos', 'link' => 'admin/reporte/producto');
         $items[] = array('id' => 26, 'parent_id' => 22, 'title' => 'Departamentos', 'link' => 'admin/reporte/departamento');
         
                 
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
