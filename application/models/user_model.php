<?php

class User_model extends CI_Model{

  public function  register($enc_password){
    //User data array
    $data = array(
      'first_name' => $this->input->post('first_name'),
      'last_name' => $this->input->post('last_name'),
      'email' => $this->input->post('email'),
      'password' => $enc_password
    );

    // Insert user
    return $this->db->insert('users', $data);
  }

  // Check username exists
  public function check_username_exists($username){
    $query = $this->db->get_where('users', array('username' => $username));

    if (empty($query->row_array())) {
      return true;
    } else {
      return false;
    }

  }

  // Check email exists
  public function check_email_exists($email){
    $query = $this->db->get_where('users', array('email' => $email));

    if (empty($query->row_array())) {
      return true;
    } else {
      return false;
    }

  }

  // Log user in
  public function login($email, $password){
    // Validate user Input
    $this->db->where('email', $email);
    $this->db->where('password', $password);

    $result = $this->db->get('users');
    if ($result->num_rows() == 1) {
      return $result->row(0)->user_id;
    } else {
      return false;
    }

  }
}

 ?>
