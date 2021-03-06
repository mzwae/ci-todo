<?php

class Tasks extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('string');
        $this->load->helper('text');
        $this->load->model('Tasks_model');
        $this->load->model('List_model');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
    }

    public function index()

    {
      if(!$this->session->userdata('logged_in')){
        redirect('users/login');
      }
        $this->form_validation->set_rules('task_desc', 'Task description', 'required');
        $this->form_validation->set_rules('task_due_d', 'Task due day', 'required');
        $this->form_validation->set_rules('task_due_m', 'Task due month', 'required');
        $this->form_validation->set_rules('task_due_y', 'Task due year', 'required');

        $list_id = $this->uri->segment(3);
        $list_name = $this->List_model->get_list_name($list_id);
        $list_pr = $this->List_model->get_list_progress($list_id);



        if ($this->form_validation->run() == false) {
            $page_data['dir'] = 'DESC';
            $page_data['entity'] = '&darr;';
            $page_data['task_desc'] = array(
              'name' => 'task_desc',
              'class' => 'form-control',
              'id' => 'task_desc',
              'value' => set_value('task_desc', ''),
              'maxlength' => '255',
              'size' => '35'
            );
            $page_data['task_due_d'] = array(
              'name' => 'task_due_d',
              'class' => 'form-control',
              'id' => 'task_due_d',
              'value' => set_value('task_due_d', ''),
              'maxlength' => '100',
              'size' => '35'
            );
            $page_data['task_due_m'] = array(
              'name' => 'task_due_m',
              'class' => 'form-control',
              'id' => 'task_due_m',
              'value' => set_value('task_due_m', ''),
              'maxlength' => '100',
              'size' => '35'
            );
            $page_data['task_due_y'] = array(
              'name' => 'task_due_y',
              'class' => 'form-control',
              'id' => 'task_due_y',
              'value' => set_value('task_due_y', ''),
              'maxlength' => '100',
              'size' => '35'
            );



            $page_data['query'] = $this->Tasks_model->get_tasks('ASC', $list_id);
            $page_data['list_id'] = $list_id;
            $page_data['list_name'] = $list_name;

            $this->load->view('templates/header');
            $this->load->view('tasks/view', $page_data);
            $this->load->view('templates/footer');
        } else {
            if ($this->input->post('task_due_y') && $this->input->post('task_due_m') && $this->input->post('task_due_d')) {
              $task_due_date = $this->input->post('task_due_y').'-'.$this->input->post('task_due_m').'-'.$this->input->post('task_due_d');
            }

            $save_data = array(
              'task_desc' => $this->input->post('task_desc'),
              'task_due_date' => $task_due_date,
              'task_status' => 'todo',
              'user_id' => $this->session->userdata('user_id'),
              'list_id' => $list_id
            );

            if ($this->Tasks_model->save_task($save_data)) {
              $this->session->set_flashdata('task_created', 'Task Created Successfully');
            } else {
              $this->session->set_flashdata('task_error', 'Error Creating Task');

            }
            redirect('tasks/index/'.$list_id);


        }
    }

    public function status(){
      $page_data['task_status'] = $this->uri->segment(3);
      $task_id = $this->uri->segment(4);
      $list_id = $this->uri->segment(5);

      if ($this->Tasks_model->change_task_status($task_id, $page_data)) {
        $this->session->set_flashdata('task_status_change', 'Task Status Changed Successfully!');
      } else {
        $this->session->set_flashdata('task_status_error', 'Changing Task Status Failed');
      }

      redirect('tasks/index/'.$list_id);

    }

    public function delete(){
      $this->form_validation->set_rules('id', 'Task ID', 'required');

      if ($this->input->post()) {
        $id = $this->input->post('id');
      } else {
        $id = $this->uri->segment(3);
      }

      $data['page_heading'] = 'Confirm delete?';
      $list_id = $this->input->post('list_id');

      if ($this->form_validation->run() == false) {
        $data['query'] = $this->Tasks_model->get_task($id);
        $this->load->view('templates/header', $data);
        $this->load->view('tasks/delete', $data);
        $this->load->view('templates/footer');
      } else {
        if ($this->Tasks_model->delete($id)) {
            $this->session->set_flashdata('task_deleted', 'Task Deleted Successfully!');
          redirect('tasks/index/'.$list_id);
        }
      }


    }

    public function sort(){
      $direction = $this->uri->segment(4);
      $list_id = $this->uri->segment(3);
      $page_data['list_id'] = $list_id;
      $page_data['list_name'] = $this->List_model->get_list_name($list_id);
      $page_data['query'] = $this->Tasks_model->get_tasks($direction, $list_id);
      if ($direction == 'ASC') {
        $page_data['dir'] = 'DESC';
        $page_data['entity'] = '&darr;';
      } else if ($direction == 'DESC') {
        $page_data['dir'] = 'ASC';
        $page_data['entity'] = '&uarr;';
      }

      $this->load->view('templates/header');
      $this->load->view('tasks/view', $page_data);
      $this->load->view('templates/footer');
    }


}
