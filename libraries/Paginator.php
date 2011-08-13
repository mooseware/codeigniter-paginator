<?php if (defined('BASEPATH')) or ('No direct script access allowed');

/**
* Name:		Paginator
*
* Author: Bastian Martin
*					ceo@mooseware.org
*
* Description: Library that creates a pagination
*
*/

class Paginator {
	/**
	 * CodeIgniter global
	 *
	 * @var string
	 **/
	protected $ci;
	
	/**
	 * Objects per page that are gonna be displayed
	 *
	 * @var int
	 */
	public $objects_per_page;
	
	/**
	 * All objects (query result)
	 *
	 * @var int
	 */
	public $all_objetcs;
	
	/**
	 * Search string that is added to the navigation uri
	 *
	 * @var string
	 */
	public $search_string;
	
	/**
	 * Start offset
	 *
	 * @var int
	 */
	public $start;
	
	/**
	 * Number of elements that are displayed between the three dots (in both directions)
	 *
	 * @var int
	 */
	public $elements_between_dots;
	
	/**
	 * The uri for the pagination elements
	 *
	 * @var string
	 */
	public $pagination_url;
	
	/**
	 * __construct
	 *
	 * @return void
	 * @author Bastian
	 **/
	public function __construct() {
		$this->ci =& get_instance();
		$this->ci->lang->load('paginator');
	}

	/**
	 * Create a pagination
	 * 
	 * @return string
	 */
	public function get_navigation() {
		// check if we have a valid value
		if (!is_numeric($this->objects_per_page)){
			$this->objects_per_page = 50;
		}

		// initialize the start information
		if ('' == $this->start) {
			$this->start = 0;
		}

		// initialize the number of pages that are displayed between the three dots (in both directions)
		if ('' == $this->elements_between_dots) {
			$this->elements_between_dots = 5;
		}

		// initialize return string
		$this->navigation = "";

		// get the number of pages
		$this->all_pages = ceil(($this->all_objects / $this->objects_per_page)); 

		// get the current object count (objects up until this number are displayed)
		$this->current_object_count = ($this->start + $this->objects_per_page);

		if ($this->all_objects < $this->current_object_count) {
			$this->object_number_to_display = $this->all_objects;
		} else {
			$this->object_number_to_display = $this->current_object_count;
		}

		// start navigation
		$this->navigation.= sprintf($this->ci->lang->line('paginator_pagination_summary'),$this->all_objects, ($this->start + 1), $this->object_number_to_display);

		$this->navigation.= '<div id="pagination" class="pagination">';

		// get current page
		$this->current_page = ceil((($this->start + 1) / $this->objects_per_page));

		// show back link if not on first page
		if ($this->current_page != 1){
			$this->navigation.= "<a href=\"".base_url().$this->pagination_url."/start/".($this->start - $this->objects_per_page).$this->search_string."\">&#9668;</a> ";
		} else {
			$this->navigation.= '<span class="disabled">&#9668;</span>';
		}

		// modify start and end page
		$this->starting_page = (0 >= $this->current_page - $this->elements_between_dots)?1:$this->current_page - $this->elements_between_dots;
		$this->end_page = ($this->all_pages < $this->current_page + $this->elements_between_dots)?$this->current_page + ($this->all_pages - $this->current_page):$this->current_page + $this->elements_between_dots;

		// modify navigation
		if ($this->current_page > $this->elements_between_dots + 1) {
			// display page 1 and ...
			$this->navigation.= "<a href=\"".base_url().$this->pagination_url."/start/0".$this->search_string."\">1</a>";	
			$this->navigation.= " . . . ";
		}

		// write all pages between starting and end page
		for ($i = $this->starting_page; $i <= $this->end_page; $i++){
			if ($this->all_pages != 1){
				if ($this->current_page != $i){
					$this->navigation.= "<a href=\"".base_url().$this->pagination_url."/start/".(($i - 1)*$this->objects_per_page).$this->search_string."\">$i</a> ";
				} else {
					$this->navigation.= "<span class=\"current\">$i </span>";
				}
			}
		}

		// modify navigation
		if ($this->end_page < $this->all_pages) {
			$this->navigation.= " . . . ";
		}

		if (($this->current_page + $this->elements_between_dots) < $this->all_pages) {
			$this->navigation.= "<a href=\"".base_url().$this->pagination_url."/start/".(($this->all_pages - 1)*$this->objects_per_page).$this->search_string."\">$this->all_pages</a>";	
		}


		// show next link if not on last page
		if ($this->current_page != $this->all_pages && $this->all_pages != 0){
			$this->navigation.= "<a href=\"".base_url().$this->pagination_url."/start/".($this->start + $this->objects_per_page).$this->search_string."\">&#9658;</a> ";
		} else {
			$this->navigation.= '<span class="disabled">&#9658;</span>';
		}

		$this->navigation.= "</div>";

		// return navigation string
		return $this->navigation;
	}
}