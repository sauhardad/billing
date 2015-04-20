<?php

Class Common_model extends CI_Model
{
    
    /** function that checks if a specified code exists in the table given
     * depending on the condition specified
     * 
     * @param type $table
     * @param array $condition_array
     * @param type $code
     * @return boolean
     */
    function check_if_code_exists($table,$condition_array,$code)
    {
        $this->db->where('code',$code);
        if(!empty($condition_array))
            $this->db->where($condition_array);
        $this->db->from($table);
        if($this->db->count_all_results()) return TRUE;
        return FALSE;
    }
 
}
?>