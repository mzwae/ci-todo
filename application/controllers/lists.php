<?php

class Lists extends CI_Controller{
  public function __construct(){
    parent::__construct();
    $this->load->model('List_model');
  }

  public function index(){
    if (!$this->session->userdata('logged_in')) {
      redirect('users/login');
    }
    $user_id = $this->session->userdata('user_id');
    $data['title'] = 'Your Task Lists';
    $data['lists'] = $this->List_model->get_lists($user_id);

    $this->load->view('templates/header');
    $this->load->view('lists/index', $data);
    $this->load->view('templates/footer');


  }


  public function create(){
    if (!$this->session->userdata('logged_in')) {
      redirect('users/login');
    }

    $this->form_validation->set_rules('list_name', 'List Name', 'required');
    $data['title'] = 'Your Task Lists';

    if ($this->form_validation->run() == false) {
      $this->load->view('templates/header');
      $this->load->view('lists/index', $data);
      $this->load->view('templates/footer');
    } else {
      $this->List_model->create_list();
      $this->session->set_flashdata('list_created', 'Your new list has been created successfully!');
      redirect('lists');
    }

  }

  public function edit(){}

  public function delete(){}


}

 ?>
