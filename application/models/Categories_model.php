<?php

class Categories_model extends CI_Model
{
  public function getData($id = null)
  {
    if($id === null){
      return $this->db->get('task_categories')->result_array();
    } else {
      return $this->db->get_where('task_categories',["id"=>$id])->result_array();
    }
  }
  public function createData($data){
      $this->db->insert('task_categories',$data);
      return $this->db->affected_rows();
  }

  public function deleteData($id){
    $this->db->delete('task_categories',['id'=>$id]);
      return $this->db->affected_rows();
  }
  public function updateData($id,$data){
    $this->db->update('task_categories',$data,['id'=>$id]);
      return $this->db->affected_rows();
  }
}
