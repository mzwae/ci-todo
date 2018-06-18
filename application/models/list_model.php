<?php

class List_model extends CI_Model{

  public function create_list(){
    $data = array(
      'list_name' => $this->input->post('list_name'),
      'user_id' => $this->session->userdata('user_id')
    );

    return $this->db->insert('lists', $data);
  }

  public function delete_list($list_id){
    $this->db->where('list_id', $list_id);
    $this->db->delete('lists');
    $this->db->delete('tasks');
    return true;

  }

  public function edit_list(){
    $data = array(
      'list_name' => $this->input->post('list_name')
    );

    $this->db->where('list_id', $this->input->post('list_id'));
    return $this->db->update('lists', $data);
  }

  public function get_lists(){
    $this->db->order_by('name');
    $query = $this->db->get('lists');
    return $query->result_array();
  }

  public function display_list(){}
}

 ?>
