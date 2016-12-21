<?php defined('SYSPATH') or die('No direct script access.');

class Controller_User_Containers_User extends Controller_Template {
    
    public $template = 'controller/user/containers/user';
	
	/**
	 * El atributo que va a ser utilizado en cada acción
	 * NULL por defecto
	 * @var View
	 */
	public $view;
	
	/**
	 * @see system/classes/kohana/controller/Kohana_Controller_Template::before()
	 */
	public function before()
	{
		Session::instance();
		//Required because we are extending Controller_Template
		parent::before();
                $user = ORM::factory('user')->where('ID_USUARIO', '=', Session::instance()->get('treasure_usuario', FALSE))->find();
                
            if(!Session::instance()->get('treasure_usuario', FALSE) OR Session::instance()->get('treasure_usuario', FALSE)=="" OR $user->ID_PERFIL!=2)
            {
                HTTP::redirect('login');
            }
		//$this->_check_permissions();
		
		if ( $this->auto_render )
  	    {
			//Sets the "Default" title set on the container
			$this->template->title = 'Treasure';
			$this->template->content = '';
			  
			$this->template->styles = array();
			$this->template->scripts = array();
		}
		
		//Cleans the view so that every action can set it 
		//by itself without problems
		$this->view = NULL;
	}
	
	/**
	 * @see system/classes/kohana/controller/Kohana_Controller_Template::after()
	 */
	public function after()
	{		
		if ( $this->auto_render )
		{
			$action = $this->request->action();
			$controller =  $this->request->controller();
			$directory = $this->request->directory();

			//Build the styles array
			$css_file = 'media/css/controller/'.$directory.'/'.$controller.'/'.$action.'.css';
			$styles = array(
				'media/css/screen.css' => 'screen, projection',
				'media/css/src/print.css' => 'print',
				'media/css/jquery-ui/smoothness/jquery-ui-1.8.16.custom.css' => 'all',
				'media/css/dataTables/TableTools.css' => 'screen',
				'media/css/dataTables/TableTools_JUI.css' => 'screen',
				'media/css/dataTables/demo_table_jui.css' => 'screen',
				'media/css/src/ie.css' => 'screen, projection',
				'media/css/styles.css' => 'screen',
				'media/css/menu.css' => 'screen',
                                'media/css/menu-style.css' => 'screen',
				'media/css/jquery-ui/jquery.autocomplete.css' => 'all',
			);

			//VALIDATING FILE
			if(file_exists($css_file) )
			{
				$styles = array_merge( $styles, array($css_file=>'screen') );
			}
		  
			//Build the scripts array
			$js_file = 'media/js/controller/'.$directory.'/'.$controller.'/'.$action.'.js';
			$scripts = array(
				'media/js/jqueryLibrary/jquery-1.6.2.min.js',
				'media/js/jqueryLibrary/jquery-ui-1.8.16.custom.min.js',
				'media/js/jqueryLibrary/jquery-validation.js',
                                'media/js/jqueryLibrary/jquery.autocomplete.js',
                                'media/js/dataTables/jquery.dataTables.js',
				'media/js/dataTables/TableTools.js',
				'media/js/dataTables/ZeroClipboard.js',
                                'media/js/dataTables/dataTables.editor.js',                            
				'media/js/globalfunctions.js',
				'media/js/ajaxupload.js',
				'media/js/system.js',
				'media/js/mbMenu.js',
			);

			//VALIDATING FILE
			if(file_exists($js_file) )
			{
				$scripts = array_merge( $scripts, array($js_file) );
			}
			
			//Set styles and scripts on the template (container). This can also be
			//done from any action method
			$this->template->styles = array_merge( $styles, $this->template->styles );
			$this->template->scripts = array_merge( $scripts, $this->template->scripts );

			//Get Menu
			//Uncomment once we have all the menu logic created
            $menu=FALSE;//$this->_get_menu( Model_Globalfunctions::get_menu( Session::instance()->get('discotecas_serial_prf', FALSE) ) );
            if($menu){
                $this->template->menu = $menu;
            }else{
                $this->template->menu = false;
            }
			
            
			
			//If $this->view is set display it on the 
			//containers $content
			$this->template->content = $this->view;
		}		
		
		//Required because we are extending Controller_Template
		parent::after();		
	}

}