<?php defined('SYSPATH') or die('No direct access allowed.');
class Model_Pedidodespachoxproducto extends ORM {
	public $status_values_pedido = array('PEDIDO' => 'Pedido', 'APROBADO' => 'Aprobado', 'CANCELADO' => 'Cancelado');
        public $status_values_despacho = array('CANCELADO' => 'Cancelado', 'EN PROCESO' => 'En Proceso', 'COMPRADO' => 'Comprado', 'ENVIADO' => 'Enviado', 'ENTREGADO' => 'Entregado');
        public $status_values_completo = array('PEDIDO' => 'Pedido', 'APROBADO' => 'Aprobado', 'CANCELADO' => 'Cancelado', 'CANCELADO' => 'Cancelado', 'EN PROCESO' => 'En Proceso', 'COMPRADO' => 'Comprado', 'ENVIADO' => 'Enviado', 'ENTREGADO' => 'Entregado');
        protected $_table_name = 'pedido_despacho_x_producto';
}

?>
