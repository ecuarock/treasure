<?php defined('SYSPATH') or die('No direct access allowed.');

return array
(
	// 'user:controller:action:empty' => 'No existen Idiomas registrados',   THIS IS AN EXAMPLE
        //USUARIOS
        'admin:user:create:success' => 'Se ha creado el Usuario exitosamente.',
	'admin:user:create:update' => 'Se ha actualizado el Usuario exitosamente.',
        //DEPARTAMENTOS
        'admin:departamento:create:success' => 'Se ha creado el Departamento exitosamente.',
	'admin:departamento:create:update' => 'Se ha actualizado el Departamento exitosamente.',
        //PRODUCTOS
        'admin:producto:create:success' => 'Se ha creado el Producto exitosamente.',
	'admin:producto:create:update' => 'Se ha actualizado el Producto exitosamente.',
        'admin:producto:create:cantidad' => 'Se ha cambiado las cantidades de los productos en bodega',
        'admin:producto:create:nada' => 'Se han mantenido las cantidades de los productos en bodega',
        //PEDIDOS
        'admin:pedido:create:success' => 'Se ha creado el Pedido exitosamente.',
	'admin:pedido:create:update' => 'Se ha actualizado el Pedido exitosamente.',
        'admin:pedido:revisar:aprobado' => 'Se ha aprobado el Pedido exitosamente.',
        'admin:pedido:revisar:cancelado' => 'Se ha Cancelado el Pedido exitosamente.',
        //DESPACHOS
        'admin:despacho:create:success' => 'Se ha creado Despacho exitosamente.',
        'admin:despacho:create:update' => 'Se ha actualizado Despacho exitosamente.',
        'admin:despacho:estado:comprado'=>'Se a actualizado estado de Despacho a Comprado.',
        'admin:despacho:estado:enviado'=>'Se a actualizado estado de Despacho a Enviado.',
        'admin:despacho:estado:entregado'=>'Se a actualizado estado de Despacho a Entregado e ingresado a Stock',
        'admin:despacho:estado:cancelado'=>'Se a actualizado estado de Despacho y Pedidos.',
);

