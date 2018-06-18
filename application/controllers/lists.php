<?php

class Lists extends CI_Controller{
  public function __construct(){
    parent::__construct();
    $this->load->model('List_model');
  }

  public function index(){
    $user_id = $this->session->userdata('user_id');
    $data['title'] = 'Your Task Lists';
    $data['lists'] = $this->List_model->get_lists($user_id);

    $this->load->view('templates/header');
    $this->load->view('lists/index', $data);
    $this->load->view('templates/footer');


  }

  public function display(){}

  public function create(){}

  public function edit(){}

  public function delete(){}


}

 ?>
