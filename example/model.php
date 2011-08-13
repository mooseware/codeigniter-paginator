<?php if (defined('BASEPATH')) or ('No direct script access allowed');

class Sample_model extends CI_Model {
	
	public function __construct() {
		parent::__construct();
	}

	public function get_records($search_string) {
		// enable caching to store search params because after 
		// calling count_all_results for pagination, db class deletes all params for some reason
		$this->db->start_cache();
		if ('' != $search_string) {
			$this->db->like('field1', $search_string);
			$this->db->or_like('field2', $search_string);
		}
		$this->db->stop_cache();

		$result['number'] = $this->db->count_all_results('sample_table');
		$this->db->limit($this->paginator->objects_per_page, $this->paginator->start);
		$this->db->order_by('row ASC');

		$this->data['records'] = $this->db->get('sample_table');
		$result['records'] = $this->data['records']->result();
		$this->db->flush_cache();
		
		return $result;
	}

}