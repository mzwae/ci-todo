<?php

class Tasks extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('string');
        $this->load->helper('text');
        $this->load->model('Tasks_model');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger"', '</div>');
    }

    public function index()
    {
        $this->form_validation->set_rules('task_desc', 'Task description', 'required');
        $this->form_validation->set_rules('task_due_d', 'Task due day', 'required');
        $this->form_validation->set_rules('task_due_m', 'Task due month', 'required');
        $this->form_validation->set_rules('task_due_y', 'Task due year', 'required');


        if ($this->form_validation->run() == false) {
            $page_data['job_title'] = array(
              'name' => 'job_title',
              'class' => 'form-control',
              'id' => 'job_title',
              'value' => set_value('job_title', ''),
              'maxlength' => '100',
              'size' => '35'
            );
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

            $page_data['query'] = $this->Tasks_model->get_tasks();

            $this->load->view('templates/header');
            $this->load->view('tasks/view', $page_data);
            $this->load->view('templates/footer');
        } else {
            if ($this->input->post('task_due_y') && $this->input->post('task_due_m') && $this->input->post('task_due_d')) {
              $task_due_date = $this->input->post('task_due_y').'-'.$this->input->post('task_due_m').'-'.$this->input->post('task_due_d');
            } else {
              $task_due_date = null;
            }

        }
    }
}
