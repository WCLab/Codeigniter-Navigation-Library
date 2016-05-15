<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Navigation {
	
	private $nav = array();
	var $tag_open = '<nav>';
	var $tag_close = '</nav>';
	// var $list_open = '<ul>';
	// var $list_close = '</ul>';
	var $item_tag_open = '<li>';
	var $item_tag_close = '</li>';
	var $cur_tag_open = '<li class="current">';
	var $cur_tag_close = '</li>';
	var $anchor_class = '';
	var $uri_segment = 1;
	// var $cur_class = "current";
	protected $ci;

	/**
     * Construct Method
     *
     * @param   array      $params               Receives an array with the lib's settings. It's indexes must be the same property name
     * @return   void                              	 Not returns value
     *
     */
	public function __construct($params=array()){
		$this->ci =& get_instance();
		// $ci->load->helper("url");
		if (count($params)>0){
			$this->initialize($params);
		}

		log_message('debug', "Nav Class Initialized");
	}

	/** 
	* Used in construct method
     * Init properties
     *
     * @param   array      $params                   Receives an array with the lib's settings. It's indexes must be the same property name
     * @return   void                              		Not returns value
     *
     */
	function initialize($params = array()){
		if (count($params) > 0){
			foreach ($params as $key => $val){
				if (isset($this->$key)){
					$this->$key = $val;
				}
			}
		}
	}
	
	/**
     * Append item to list
     * @link 									http://php.net/manual/es/function.array-push.php
     *
     * @param   string      $page                 The inner item's name
     * @param   string      $href                   Anchor's reference
     * @return   void                              	 Not returns value
     *
     */
	function push($page, $href){
		if (!$page OR !$href) return;
		
		$href = site_url($href);		
		$this->nav[$href] = array('page' => $page, 'href' => $href);

	}
			
	/**
     * Prepend item to list
     * @link 									http://php.net/manual/es/function.array-unshift.php
     *
     * @param   string      $page                 The inner item's name
     * @param   string      $href                   Anchor's reference
     * @return   void                              	 Not returns value
     *
     */
	function unshift($page, $href){
		if (!$page OR !$href) return;
		
		$href = site_url($href);
		array_unshift($this->nav, array('page' => $page, 'href' => $href));

	}
	
	/**
     * Shows html generated
     * @link 									http://php.net/manual/es/function.array-keys.php
     *
     * @return   string                              	 Returns html generated
     *
     */	
	function show(){
		if ($this->nav){
			$output = $this->tag_open;
			foreach ($this->nav as $key => $crumb) {
				$keys = array_keys($this->nav);
				// die($this->ci->uri->segment($this->uri_segment));
				// die($crumb["page"]);
				if ($this->ci->uri->segment($this->uri_segment) == strtolower($crumb['page'])){
					$output .= $this->cur_tag_open.'<a href="'.$crumb['href'].'" class="'.$this->anchor_class.'">'.$crumb['page'] . '</a>'.$this->cur_tag_close;
				}else{
					$output .= $this->item_tag_open.'<a href="'.$crumb['href'].'" class="'.$this->anchor_class.'">'.$crumb['page'] . '</a>'.$this->item_tag_close;
				}
			}
			
			return $output . $this->tag_close;
		}
		
		return '';
	}
}

// END Navigation Class
/* End of file navigation.php */
/* Location: ./application/libraries/navigation.php */
