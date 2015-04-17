<?php

Class Common_model extends CI_Model
{
    
    /** function that checks if a specified code exists in the table given
     * 
     * @param type $table
     * @param type $code
     * @return boolean
     */
    function check_if_code_exists($table,$code)
    {
        $this->db->where('code',$code);
        $this->db->from($table);
        if($this->db->count_all_results()) return TRUE;
        return FALSE;
    }
 
}
?>