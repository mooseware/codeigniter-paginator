<?php if (defined('BASEPATH')) or ('No direct script access allowed');

class Sample_controller extends Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model('sample_controller_model', 'model');
		$this->load->library('paginator');
	}
	
	function index() {
		$this->data = array();
		
		// extract uri params
		$uri_params = $this->uri->uri_to_assoc(3);
		$this->paginator->pagination_url = "controller/index"; // we have to use method 'index' here, otherwise 'start' would be used as method by default and this would cause an error
		$this->paginator->objects_per_page = 20;
		$this->paginator->start = $uri_params['start']; // extracted from uri
		
		// example to use a search string
		// either use strings that come from view form or (if navigated via pagination links) use string extracted from uri
		if ('' != $this->input->post('search_string')) {
			$search_string = $this->input->post('search_string');
		} else {
			$search_string = $uri_params['search_string'];
		}
		
		// hand over search string to paginator which will be part of the uri built in paginator
		$this->paginator->search_string = "/search_string/".$search_string;

		// get records considering search string
		if ($result = $this->model->get_records($search_string)) {
			$this->data['records'] = $result['records'];
		}
		
		// all objects are displayed in the pagination summary above pagination links
		$this->paginator->all_objects = $result['number'];
		
		$this->data['search_string'] = $search_string;
		$this->data['pagination'] = $this->paginator->get_navigation();
		$this->load->view('view/sample', $this->data);
	}
	
}