<?php

class Tasks_model extends CI_Model
{
  public function getData($id = null)
  {
    if($id === null){
      return $this->db->get('tasks')->result_array();
    } else {
      return $this->db->get_where('tasks',["id"=>$id])->result_array();
    }
  }
  public function createData($data){
      $this->db->insert('tasks',$data);
      return $this->db->affected_rows();
  }

  public function deleteData($id){
    $this->db->delete('tasks',['id'=>$id]);
      return $this->db->affected_rows();
  }
  public function updateData($id,$data){
    $this->db->update('tasks',$data,['id'=>$id]);
      return $this->db->affected_rows();
  }
}
