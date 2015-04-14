<?php

/**
 *Initialize the pagination rules 
 * @return Pagination
 */
class Paginationlib {
    function __construct() {
         $this->ci =& get_instance();
    }
 
    public function initPagination($per_page,$uri_segment,$url,$total_rows){
        $config['per_page']          = $per_page;
        $config['uri_segment']       = $uri_segment;
        $config['base_url']          = base_url().$url;
        $config['total_rows']        = $total_rows;
        $config['use_page_numbers']  = TRUE;
        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] ="</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tagl_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";
       
        
        $this->ci->pagination->initialize($config);
        return $config;    
    }
    
}
