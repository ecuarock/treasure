<?php defined('SYSPATH') OR die('No direct access allowed.');

class FlashMessenger {
	
	protected static $_instance;
	
	// Tipes of message
	private $_statuses = array(
		'success' => 'success',
		'error' => 'error',
		'notice' => 'notice'
	);
  
	public static function factory()
	{
		if ( ! isset(FlashMessenger::$_instance))
		{
			// Create a new session instance
			FlashMessenger::$_instance = new FlashMessenger;
		}
		return FlashMessenger::$_instance;
	}
    
	public function set_message($status, $message)
	{
		if(in_array($status, $this->_statuses))
		{
			$_SESSION['flash'][$status][] = $message;
		}
	}
  
	private function _render($class)
	{
		$html = '';
		if( isset($_SESSION['flash']) && is_array($_SESSION['flash']) )
		{
			$html .= '<div id="flash-messages" class="'.$class.' last">';
			foreach ($_SESSION['flash'] as $k => $v)
			{
				$html .= "<div class='{$k}'>";
				$html .= "<span class='close'>x</span>";
				$html .= '<ul>';
				foreach($v as $message)
				{
					$html .= '<li>'.$message.'</li>';
				}
				$html .= '<ul>';
				$html .= '</div>';
			}
			$html .= '</div>';
		}
		echo $html;

		return $this;
	}
	
	private function _add_css()
	{
		echo HTML::style('media/css/flash-messenger.css');
		return $this;
	}
	
	private function _add_js()
	{
		echo HTML::script('media/js/flash-messenger.js');
		return $this;
	}
  
	private function _clear()
	{
		$_SESSION['flash'] = array();
	}
  
	public function get_messages($class = 'prepend-5 span-10 append-5')
	{
		$this->_render($class)->_add_css()->_add_js()->_clear();
	}
}
