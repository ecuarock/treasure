<?php
class Controller_Admin_Reporte extends Controller_Admin_Containers_Admin {

	public function action_index()
	{            
            HTTP::redirect('admin/main/');
	}


    public function action_pedido()
	{
	//IF USER SUBMITTED FORM
        $this->view = View::factory( 'controller/admin/reporte/pedido' );
        $pagina=1;
        $estados = array(NULL=>"-Seleccione-") + ORM::factory('pedidodespachoxproducto')->status_values_pedido;
        $this->view->set('estados',$estados);
        $this->view->set('pagina',$pagina);                      
	}
        
   public function action_despacho()
	{
	//IF USER SUBMITTED FORM
        $this->view = View::factory( 'controller/admin/reporte/pedido' );
        $pagina=2;
        $estados = array(NULL=>"-Seleccione-") + ORM::factory('pedidodespachoxproducto')->status_values_despacho;
        $this->view->set('estados',$estados);
        $this->view->set('pagina',$pagina);                      
	}
        
   public function action_producto()
	{
	//IF USER SUBMITTED FORM
        $this->view = View::factory( 'controller/admin/reporte/producto' );
        $pagina=2;
        $estados = array(NULL=>"-Seleccione-") + ORM::factory('pedidodespachoxproducto')->status_values_completo;
        $this->view->set('estados',$estados);
        $this->view->set('pagina',$pagina);                      
	}
        
    public function action_departamento()
	{
	//IF USER SUBMITTED FORM
        $this->view = View::factory( 'controller/admin/reporte/departamento' );
        $departamentos = ORM::factory('departamento')->find_all();
        $departamentos_nombre = array();
        foreach ($departamentos as $value) {
            $departamentos_nombre = $departamentos_nombre + array($value->ID_DEPARTAMENTO => ucwords($value->NOMBRE));            
        }        
        $departamentos_nombre = array(NULL=>"-Seleccione-") + $departamentos_nombre;
        $estados = array(NULL=>"-Seleccione-") + ORM::factory('pedidodespachoxproducto')->status_values_completo;
        $this->view->set('estados',$estados);
        $this->view->set('departamentos_nombre',$departamentos_nombre);                  
	}
        
   public function action_load_anios()
	{
		$this->auto_render=false;
		if ($this->request->is_ajax())
                {     
                    $estado = arr::get($this->request->post(), 'sent_estado');
                    $pagina = arr::get($this->request->post(), 'sent_pagina');
                    if($pagina==1)
                        $anios = DB::query(Database::SELECT, "SELECT Distinct(`ANIO`) FROM `pedido` as p, `pedido_despacho_x_producto` as px WHERE `ESTADO` like '".$estado."' AND p.ID_PEDIDO = px.ID_PEDIDO order by `ANIO`")->execute()->as_array();
                    else
                        $anios = DB::query(Database::SELECT, "SELECT Distinct(`ANIO`) FROM `despacho` as d, `pedido_despacho_x_producto` as px WHERE `ESTADO` like '".$estado."' AND d.ID_DESPACHO = px.ID_DESPACHO order by `ANIO`")->execute()->as_array();
                    $anioarray = array();
                    foreach ($anios as $value) 
                        {
                            $anioarray = $anioarray + array($value['ANIO'] => $value['ANIO']);
                        }
                    if(count($anioarray))
                        $anioarray = array(NULL=>"-Seleccione-") + $anioarray;
                    else
                        $anioarray = array(NULL=>"NO EXISTE REGISTROS");
                    
                    $this->view = View::factory( 'controller/admin/reporte/loads/anios_container' );
                    $this->view->set('anioarray',$anioarray);
                    
                    echo $this->view;
                    $this->auto_render = FALSE;                                
                }
	} 

   public function action_load_departamentos_anios()
	{
		$this->auto_render=false;
		if ($this->request->is_ajax())
                {     
                    $estado = arr::get($this->request->post(), 'sent_estado');
                    $departamento = arr::get($this->request->post(), 'sent_departamento');
                    $productos = DB::query(Database::SELECT, "SELECT distinct(`ID_PRODUCTO`) FROM `producto` WHERE `ID_DEPARTAMENTO`=".$departamento."")->execute()->as_array();
                    $producto = array();    
                    foreach ($productos as $value) {
                        $producto = $producto + array($value['ID_PRODUCTO']=>$value['ID_PRODUCTO']);                        
                    }
                    $producto = implode(',', $producto);
                    $ID_PEDIDO = DB::query(Database::SELECT, "SELECT distinct(`ID_PEDIDO`) FROM `pedido_despacho_x_producto` WHERE `ID_PRODUCTO` IN (".$producto.") ORDER BY `ID_PEDIDO`")->execute()->as_array();
                    $pedidos = array();
                    foreach ($ID_PEDIDO as $value) {
                        $pedidos = $pedidos + array($value['ID_PEDIDO']=>$value['ID_PEDIDO']);
                    }
                    $pedidos = implode(',', $pedidos);                                       
                    $anios = DB::query(Database::SELECT, "SELECT Distinct(`ANIO`) FROM `pedido` as p, `pedido_despacho_x_producto` as px WHERE `ESTADO` like '".$estado."' AND p.ID_PEDIDO = px.ID_PEDIDO AND p.ID_PEDIDO IN (".$pedidos.") order by `ANIO`")->execute()->as_array();
                    $anioarray = array();
                    foreach ($anios as $value) 
                        {
                            $anioarray = $anioarray + array($value['ANIO'] => $value['ANIO']);
                        }
                    if(count($anioarray))
                        $anioarray = array(NULL=>"-Seleccione-") + $anioarray;
                    else
                        $anioarray = array(NULL=>"NO EXISTE REGISTROS");                    
                    $this->view = View::factory( 'controller/admin/reporte/loads/anios_container' );
                    $this->view->set('anioarray',$anioarray);                    
                    echo $this->view;
                    $this->auto_render = FALSE;                                
                }
	} 
        
   public function action_load_meses()
	{
		$this->auto_render=false;
		if ($this->request->is_ajax())
                {         
                    
                    $estado=arr::get($this->request->post(), 'sent_estado');
                    $anio=arr::get($this->request->post(), 'sent_anio');
                    $pagina = arr::get($this->request->post(), 'sent_pagina');
                    if($pagina==1)
                        $meses = DB::query(Database::SELECT, "SELECT Distinct(`MES`) FROM `pedido` as p, `pedido_despacho_x_producto` as px WHERE `ESTADO` like '".$estado."' AND p.ANIO = ".$anio." AND p.ID_PEDIDO = px.ID_PEDIDO order by `MES`")->execute()->as_array();
                    else
                        $meses = DB::query(Database::SELECT, "SELECT Distinct(`MES`) FROM `despacho` as d, `pedido_despacho_x_producto` as px WHERE `ESTADO` like '".$estado."' AND d.ANIO = ".$anio." AND d.ID_DESPACHO = px.ID_DESPACHO order by `MES`")->execute()->as_array();
                    $mesesarray = array();
                    foreach ($meses as $value) 
                        {
                            $mesesarray = $mesesarray + array($value['MES'] => $value['MES']);
                        }
                    $mesesarray = array(NULL=>"-Seleccione-") + $mesesarray;
                    
                    $this->view = View::factory( 'controller/admin/reporte/loads/meses_container' );
                    $this->view->set('mesesarray',$mesesarray);
                    
                    echo $this->view;
                    $this->auto_render = FALSE;

                                
                }
	}
        
    public function action_load_departamento_meses()
	{
		$this->auto_render=false;
		if ($this->request->is_ajax())
                {         
                    
                    $estado=arr::get($this->request->post(), 'sent_estado');
                    $anio=arr::get($this->request->post(), 'sent_anio');
                    $departamento = arr::get($this->request->post(), 'sent_departamento');                    
                    $productos = DB::query(Database::SELECT, "SELECT distinct(`ID_PRODUCTO`) FROM `producto` WHERE `ID_DEPARTAMENTO`=".$departamento."")->execute()->as_array();
                    $producto = array();    
                    foreach ($productos as $value) {
                        $producto = $producto + array($value['ID_PRODUCTO']=>$value['ID_PRODUCTO']);                        
                    }
                    $producto = implode(',', $producto);
                    $ID_PEDIDO = DB::query(Database::SELECT, "SELECT distinct(`ID_PEDIDO`) FROM `pedido_despacho_x_producto` WHERE `ID_PRODUCTO` IN (".$producto.") ORDER BY `ID_PEDIDO`")->execute()->as_array();
                    $pedidos = array();
                    foreach ($ID_PEDIDO as $value) {
                        $pedidos = $pedidos + array($value['ID_PEDIDO']=>$value['ID_PEDIDO']);
                    }
                    $pedidos = implode(',', $pedidos);                     
                    $meses = DB::query(Database::SELECT, "SELECT Distinct(`MES`) FROM `pedido` as p, `pedido_despacho_x_producto` as px WHERE `ESTADO` like '".$estado."' AND p.ANIO = ".$anio." AND p.ID_PEDIDO = px.ID_PEDIDO AND p.ID_PEDIDO IN (".$pedidos.") order by `MES`")->execute()->as_array();                    
                    $mesesarray = array();
                    foreach ($meses as $value) 
                        {
                            $mesesarray = $mesesarray + array($value['MES'] => $value['MES']);
                        }
                    $mesesarray = array(NULL=>"-Seleccione-") + $mesesarray;                    
                    $this->view = View::factory( 'controller/admin/reporte/loads/meses_container' );
                    $this->view->set('mesesarray',$mesesarray);                    
                    echo $this->view;
                    $this->auto_render = FALSE;

                                
                }
	}
        
    public function action_load_table()
	{
		$this->auto_render=false;
		if ($this->request->is_ajax())
                {         
                    
                    $estado=arr::get($this->request->post(), 'sent_estado');
                    $anio=arr::get($this->request->post(), 'sent_anio');
                    $mes=arr::get($this->request->post(), 'sent_mes');
                    $pagina = arr::get($this->request->post(), 'sent_pagina');
                    if($pagina==1)
                        $ID_PEDIDOS = DB::query(Database::SELECT, "SELECT Distinct(p.ID_PEDIDO) FROM `pedido` as p, `pedido_despacho_x_producto` as px WHERE `ESTADO` like '".$estado."' AND p.ANIO = ".$anio." AND p.MES = ".$mes." AND p.ID_PEDIDO = px.ID_PEDIDO order by `ID_PEDIDO`")->execute()->as_array();
                    else
                        $ID_PEDIDOS = DB::query(Database::SELECT, "SELECT Distinct(d.ID_DESPACHO) FROM `despacho` as d, `pedido_despacho_x_producto` as px WHERE `ESTADO` like '".$estado."' AND d.ANIO = ".$anio." AND d.MES = ".$mes." AND d.ID_DESPACHO = px.ID_DESPACHO order by `ID_DESPACHO`")->execute()->as_array();
                    $ID_PEDIDO = array();
                    foreach ($ID_PEDIDOS as $value) 
                        {
                            if($pagina==1)
                            {
                                $pedido = ORM::factory('pedido')->where('ID_PEDIDO', '=', (int)$value['ID_PEDIDO'])->find()->as_array();
                                $ID_PEDIDO = $ID_PEDIDO + array($pedido['ID_PEDIDO'] => $pedido);
                            }
                            else
                            {
                                $pedido = ORM::factory('despacho')->where('ID_DESPACHO', '=', (int)$value['ID_DESPACHO'])->find()->as_array();
                                $ID_PEDIDO = $ID_PEDIDO + array($pedido['ID_DESPACHO'] => $pedido);
                            }
                            
                        }
                    $users = ORM::factory('user')->distinct('ID_USUARIO')->find_all()->as_array();
                    $user = array();
                    foreach ($users as $value) {     
                        $nombres = $value->NOMBRE.'<br>'.$value->APELLIDO;
                        $user = $user + array($value->ID_USUARIO=>$nombres);
                    }
                    $this->view = View::factory( 'controller/admin/reporte/loads/table_container' );
                    $this->view->set('ID_PEDIDO',$ID_PEDIDO);
                    $this->view->set('user',$user);
                    $this->view->set('pagina',$pagina);
                    echo $this->view;
                    $this->auto_render = FALSE;

                                
                }
	}
        
    public function action_load_producto_table()
	{
		$this->auto_render=false;
		if ($this->request->is_ajax())
                {         
                    
                    $estado=arr::get($this->request->post(), 'sent_estado');
                    $anio=arr::get($this->request->post(), 'sent_anio');
                    $mes=arr::get($this->request->post(), 'sent_mes');
                    $pagina = arr::get($this->request->post(), 'sent_pagina');
                    if($pagina==1)
                        $ID_PEDIDOS = DB::query(Database::SELECT, "SELECT Distinct(p.ID_PEDIDO) FROM `pedido` as p, `pedido_despacho_x_producto` as px WHERE `ESTADO` like '".$estado."' AND p.ANIO = ".$anio." AND p.MES = ".$mes." AND p.ID_PEDIDO = px.ID_PEDIDO order by `ID_PEDIDO`")->execute()->as_array();
                    else
                        $ID_PEDIDOS = DB::query(Database::SELECT, "SELECT Distinct(d.ID_DESPACHO) FROM `despacho` as d, `pedido_despacho_x_producto` as px WHERE `ESTADO` like '".$estado."' AND d.ANIO = ".$anio." AND d.MES = ".$mes." AND d.ID_DESPACHO = px.ID_DESPACHO order by `ID_DESPACHO`")->execute()->as_array();
                    $ID_PEDIDO = array();
                    foreach ($ID_PEDIDOS as $value) 
                        {
                            if($pagina==1)
                            {
                                $pedido = ORM::factory('pedido')->where('ID_PEDIDO', '=', (int)$value['ID_PEDIDO'])->find()->as_array();
                                $ID_PEDIDO = $ID_PEDIDO + array($pedido['ID_PEDIDO']);
                            }
                            else
                            {
                                $pedido = ORM::factory('despacho')->where('ID_DESPACHO', '=', (int)$value['ID_DESPACHO'])->find()->as_array();
                                $ID_PEDIDO[] = $pedido['ID_DESPACHO'];
                            }
                            
                        }
                    $ID_PEDIDO = implode(',', $ID_PEDIDO);
                    $productos = ORM::factory('producto')->find_all();
                    $producto = array();
                    $dep = array();
                    foreach ($productos as $value) {     
                        $producto = $producto + array($value->ID_PRODUCTO=>$value->DESCRIPCION);
                        $dep = $dep + array($value->ID_PRODUCTO=>$value->ID_DEPARTAMENTO);
                    }
                    if($pagina==1)
                        $requisicion = DB::query(Database::SELECT, "SELECT `ID_PRODUCTO` , SUM(`CANTIDAD`) AS CANTIDAD FROM `pedido_despacho_x_producto` WHERE `ID_PEDIDO` IN ( ".$ID_PEDIDO." ) GROUP BY `ID_PRODUCTO` ORDER BY `ID_PRODUCTO`")->execute()->as_array();
                    else
                        $requisicion = DB::query(Database::SELECT, "SELECT `ID_PRODUCTO` , SUM(`CANTIDAD`) AS CANTIDAD FROM `pedido_despacho_x_producto` WHERE `ID_DESPACHO` IN ( ".$ID_PEDIDO." ) GROUP BY `ID_PRODUCTO` ORDER BY `ID_PRODUCTO`")->execute()->as_array();
                    $departamentos = ORM::factory('departamento')->find_all();
                    $departamento = array();
                    foreach ($departamentos as $value) {
                        $departamento = $departamento + array($value->ID_DEPARTAMENTO=>$value->NOMBRE);
                    }
                    
                    $this->view = View::factory( 'controller/admin/reporte/loads/table_producto_container' );                    
                    $this->view->set('requisicion',$requisicion);
                    $this->view->set('producto',$producto);
                    $this->view->set('departamento',$departamento);
                    $this->view->set('dep',$dep);
                    echo $this->view;
                    $this->auto_render = FALSE;

                                
                }
	}
        
    public function action_load_departamento_table()
	{
		$this->auto_render=false;
		if ($this->request->is_ajax())
                {         
                    
                    $estado=arr::get($this->request->post(), 'sent_estado');
                    $anio=arr::get($this->request->post(), 'sent_anio');
                    $mes=arr::get($this->request->post(), 'sent_mes');
                    $departamento = arr::get($this->request->post(), 'sent_departamento'); 
                    
                    $productos = DB::query(Database::SELECT, "SELECT distinct(`ID_PRODUCTO`) FROM `producto` WHERE `ID_DEPARTAMENTO`=".$departamento."")->execute()->as_array();
                    $producto = array();    
                    foreach ($productos as $value) {
                        $producto = $producto + array($value['ID_PRODUCTO']=>$value['ID_PRODUCTO']);                        
                    }
                    $producto = implode(',', $producto);
                    $aux = $producto;
                    $ID_PEDIDO = DB::query(Database::SELECT, "SELECT distinct(`ID_PEDIDO`) FROM `pedido_despacho_x_producto` WHERE `ID_PRODUCTO` IN (".$producto.") ORDER BY `ID_PEDIDO`")->execute()->as_array();
                    $pedidos = array();
                    foreach ($ID_PEDIDO as $value) {
                        $pedidos = $pedidos + array($value['ID_PEDIDO']=>$value['ID_PEDIDO']);
                    }
                    $pedidos = implode(',', $pedidos); 
                    
                    
                    $ID_PEDIDOS = DB::query(Database::SELECT, "SELECT Distinct(p.ID_PEDIDO) FROM `pedido` as p, `pedido_despacho_x_producto` as px WHERE `ESTADO` like '".$estado."' AND p.ANIO = ".$anio." AND p.MES = ".$mes." AND p.ID_PEDIDO = px.ID_PEDIDO AND p.ID_PEDIDO IN (".$pedidos.") order by `ID_PEDIDO`")->execute()->as_array();
                                        
                    $ID_PEDIDO = array();
                    foreach ($ID_PEDIDOS as $value) 
                        {                            
                            $pedido = ORM::factory('pedido')->where('ID_PEDIDO', '=', (int)$value['ID_PEDIDO'])->find()->as_array();
                            $ID_PEDIDO = $ID_PEDIDO + array($pedido['ID_PEDIDO']);
                        }
                    $ID_PEDIDO = implode(',', $ID_PEDIDO);
                    $productos = ORM::factory('producto')->find_all();
                    $producto = array();
                    $dep = array();
                    foreach ($productos as $value) {     
                        $producto = $producto + array($value->ID_PRODUCTO=>$value->DESCRIPCION);
                        $dep = $dep + array($value->ID_PRODUCTO=>$value->ID_DEPARTAMENTO);
                    }
                    $requisicion = DB::query(Database::SELECT, "SELECT `ID_PRODUCTO` , SUM(`CANTIDAD`) AS CANTIDAD FROM `pedido_despacho_x_producto` WHERE `ID_PEDIDO` IN ( ".$ID_PEDIDO." ) AND `ID_PRODUCTO` IN (".$aux.") GROUP BY `ID_PRODUCTO` ORDER BY `ID_PRODUCTO`")->execute()->as_array();
                    
                    $departamentos = ORM::factory('departamento')->find_all();
                    $departamento = array();
                    foreach ($departamentos as $value) {
                        $departamento = $departamento + array($value->ID_DEPARTAMENTO=>$value->NOMBRE);
                    }
                    
                    $this->view = View::factory( 'controller/admin/reporte/loads/table_producto_container' );                    
                    $this->view->set('requisicion',$requisicion);
                    $this->view->set('producto',$producto);
                    $this->view->set('departamento',$departamento);
                    $this->view->set('dep',$dep);
                    echo $this->view;
                    $this->auto_render = FALSE;

                                
                }
	}

    public function action_get_content()
    {
        $content='';
		if($this->request->is_ajax())
		{
			$pedido_id =  arr::get($this->request->post(), 'pedido_id');
                        $pagina = arr::get($this->request->post(), 'sent_pagina');
			try
			{
                            if($pagina==1)
                            {
                                $closed = ORM::factory('pedidodespachoxproducto')
                                ->where('ID_PEDIDO','=',$pedido_id)
                                ->find_all()->as_array();
                            }
                            else
                            {
                                $closed = ORM::factory('pedidodespachoxproducto')
                                ->where('ID_DESPACHO','=',$pedido_id)
                                ->find_all()->as_array();
                            }
                            foreach ($closed as $value) {
                                $nombre_producto = ORM::factory('producto')->where('ID_PRODUCTO', '=', $value->ID_PRODUCTO)->find();
                                $content = $content.'<div class="span-17 line"><div class="span-8 label"> '.$nombre_producto->DESCRIPCION.'</div><div class="span-8 label"> Cantidad: '.$value->CANTIDAD.'</div> </div> ';
                            }
				echo json_encode($content);
			}
			catch(Exception $e)
			{
				echo json_encode($e->getMessage());
			}

			$this->auto_render = FALSE;
		}
		else
		{
			HTTP::redirect('admin/main');
		}
	} 
    
}
?>