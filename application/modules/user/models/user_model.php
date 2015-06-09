<?php

Class User_model extends CI_Model
{
 function verify($username, $password)
 {
   $this -> db -> select('id, username, password, role');
   $this -> db -> from('users');
   $this -> db -> where('username', $username);
   $this -> db -> limit(1);
 
   $query = $this -> db -> get();
 
   $user=$query->row();
   if($query -> num_rows() == 1 && $this->bcrypt->check_password($password, $user->password))
   {
     //update the last login flag to display the time of login  
     $this->db->where('id',$user->id);
     $this->db->set('last_login', 'NOW()', FALSE);  
     $this->db->update('users');   
     
     return $user;
   }
   else
   {
     return false;
   }
 }
 
 function change_password($username,$new_password)
 {
     $this->db->where('username', $username);
     return $this->db->update("users",array('password'=>$this->bcrypt->hash_password($new_password)));
 }
 
 function check_if_username_exists($username)
 {
     $this->db->where('username',$username);
     $this->db->from('users');
     return $this->db->count_all_results()? TRUE:FALSE;
 }
 
 function add($username,$password,$role)
 {
     return $this->db->insert('users',array('username'=>$username,'password'=>$this->bcrypt->hash_password($password),'role'=>$role))? TRUE:FALSE;
 }
 
 /** function that removes user from the database when uer_id is passed
  * 
  * @param type $id
  */
 function delete($id)
 {
     if($this->db->delete('users',array('id'=>$id))) return TRUE;
     return FALSE;
 }
 
 function get_users_except($user_id)
 {
     $this->db->where('id !=',$user_id);
     $this->db->where('role >',1);
     $query = $this -> db -> get('users');
     $result=$query->result();
     return $result;
 }
 
 /** function that retrieves all users in the system
  * 
  * @return array() $result
  */
 function retrieveAccountants()
 {
     $this->db->select('id,username');
     $this->db->where('role',2);
     $query = $this -> db -> get('users');
     $result=$query->result();
     return $result;
 }
}
?>