<?php

class Layouts
{
	private $CI;
	
	private $title_for_layout = NULL;
	
	private $title_separator = ' | ';
	
	private $includes = array();
	
	public function __construct()
	{
		$this->CI =& get_instance();
	}
	
	public function set_title($title)
	{
		$this->title_for_layout = $title;
	}

	public function encuestas($view_name, $params = array(), $layout = 'encuestas')
	{
		$rendered_view = $this->CI->load->view($view_name, $params, TRUE);
		
		if ($this->title_for_layout !== NULL)
		{
			$this->title_for_layout = $this->title_separator . $this->title_for_layout;
		}
		
		$this->CI->load->view('layouts/' . $layout, array(
			'content' => $rendered_view,
			'title_for_layout' => $this->title_for_layout
		));
	}
	
	public function encuestasBazar($view_name, $params = array(), $layout = 'encuestasBazar')
	{
		$rendered_view = $this->CI->load->view($view_name, $params, TRUE);
		
		if ($this->title_for_layout !== NULL)
		{
			$this->title_for_layout = $this->title_separator . $this->title_for_layout;
		}
		
		$this->CI->load->view('layouts/' . $layout, array(
			'content' => $rendered_view,
			'title_for_layout' => $this->title_for_layout
		));
	}
	
	public function encuestasApe($view_name, $params = array(), $layout = 'encuestasApe')
	{
		$rendered_view = $this->CI->load->view($view_name, $params, TRUE);
		
		if ($this->title_for_layout !== NULL)
		{
			$this->title_for_layout = $this->title_separator . $this->title_for_layout;
		}
		
		$this->CI->load->view('layouts/' . $layout, array(
			'content' => $rendered_view,
			'title_for_layout' => $this->title_for_layout
		));
	}
		
	public function index($view_name, $params = array(), $layout = 'default')
	{
		$rendered_view = $this->CI->load->view($view_name, $params, TRUE);
		
		if ($this->title_for_layout !== NULL)
		{
			$this->title_for_layout = $this->title_separator . $this->title_for_layout;
		}
		
		$this->CI->load->view('layouts/' . $layout, array(
			'content' => $rendered_view,
			'title_for_layout' => $this->title_for_layout
		));
	}
	
	public function categorias($view_name, $params = array(), $layout = 'optCategorias')
	{
		$rendered_view = $this->CI->load->view($view_name, $params, TRUE);
		
		if ($this->title_for_layout !== NULL)
		{
			$this->title_for_layout = $this->title_separator . $this->title_for_layout;
		}
		
		$this->CI->load->view('layouts/' . $layout, array(
			'content' => $rendered_view,
			'title_for_layout' => $this->title_for_layout
		));
	}
	
	public function blog($view_name, $params = array(), $layout = 'blog')
	{
		$rendered_view = $this->CI->load->view($view_name, $params, TRUE);
		
		if ($this->title_for_layout !== NULL)
		{
			$this->title_for_layout = $this->title_separator . $this->title_for_layout;
		}
		
		$this->CI->load->view('layouts/' . $layout, array(
			'content' => $rendered_view,
			'title_for_layout' => $this->title_for_layout
		));
	}
	
	public function mobile($view_name, $params = array(), $layout = 'mobile')
	{
		$rendered_view = $this->CI->load->view($view_name, $params, TRUE);
		
		if ($this->title_for_layout !== NULL)
		{
			$this->title_for_layout = $this->title_separator . $this->title_for_layout;
		}
		
		$this->CI->load->view('layouts/' . $layout, array(
			'content' => $rendered_view,
			'title_for_layout' => $this->title_for_layout
		));
	}
	
	public function simpleLayout($view_name, $params = array(), $layout = 'simpleLayout')
	{
		$rendered_view = $this->CI->load->view($view_name, $params, TRUE);
		
		if ($this->title_for_layout !== NULL)
		{
			$this->title_for_layout = $this->title_separator . $this->title_for_layout;
		}
		
		$this->CI->load->view('layouts/' . $layout, array(
			'content' => $rendered_view,
			'title_for_layout' => $this->title_for_layout
		));
	}
	
	public function milocal($view_name, $params = array(), $layout = 'milocal')
	{
		$rendered_view = $this->CI->load->view($view_name, $params, TRUE);
		
		if ($this->title_for_layout !== NULL)
		{
			$this->title_for_layout = $this->title_separator . $this->title_for_layout;
		}
		
		$this->CI->load->view('layouts/' . $layout, array(
			'content' => $rendered_view,
			'title_for_layout' => $this->title_for_layout
		));
	}
	
	public function admin($view_name, $params = array(), $layout = 'admin')
	{
		$rendered_view = $this->CI->load->view($view_name, $params, TRUE);
		
		if ($this->title_for_layout !== NULL)
		{
			$this->title_for_layout = $this->title_separator . $this->title_for_layout;
		}
		
		$this->CI->load->view('layouts/' . $layout, array(
			'content' => $rendered_view,
			'title_for_layout' => $this->title_for_layout
		));
	}
	
	public function usuario($view_name, $params = array(), $layout = 'usuario')
	{
		$rendered_view = $this->CI->load->view($view_name, $params, TRUE);
		
		if ($this->title_for_layout !== NULL)
		{
			$this->title_for_layout = $this->title_separator . $this->title_for_layout;
		}
		
		$this->CI->load->view('layouts/' . $layout, array(
			'content' => $rendered_view,
			'title_for_layout' => $this->title_for_layout
		));
	}
	
	public function tienda($view_name, $params = array(), $layout = 'tienda')
	{
		$rendered_view = $this->CI->load->view($view_name, $params, TRUE);
		
		if ($this->title_for_layout !== NULL)
		{
			$this->title_for_layout = $this->title_separator . $this->title_for_layout;
		}
		
		$this->CI->load->view('layouts/' . $layout, array(
			'content' => $rendered_view,
			'title_for_layout' => $this->title_for_layout
		));
	}
	
	public function light($view_name, $params = array(), $layout = 'light')
	{
		$rendered_view = $this->CI->load->view($view_name, $params, TRUE);
		
		if ($this->title_for_layout !== NULL)
		{
			$this->title_for_layout = $this->title_separator . $this->title_for_layout;
		}
		
		$this->CI->load->view('layouts/' . $layout, array(
			'content' => $rendered_view,
			'title_for_layout' => $this->title_for_layout
		));
	}
				
	public function add_include($path, $prepend_base_url = TRUE)
	{
		if ($prepend_base_url)
		{
			$this->CI->load->helper('url'); // Just in case!
			$this->includes[] = base_url() . $path;
		}
		else
		{
			$this->includes[] = $path;
		}
		
		return $this; // $this->layouts->add_include('blabla')->add_include('blablabla');
	}
	
	public function print_includes()
	{
		$final_includes = '';
		
		foreach ($this->includes as $include)
		{
			if (preg_match('/js$/', $include))
			{
				$final_includes .= '<script language="javascript" src="' . $include . '" type="text/javascript"></script>
';
			}
			elseif (preg_match('/css$/', $include))
			{
				$final_includes .= '<link rel="stylesheet" href="' . $include . '" type="text/css"/>
';
			}
		}
		
		return $final_includes;
	}
		
}