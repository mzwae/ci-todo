<?php

class Tasks_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    // display all tasks
    public function get_tasks()
    {
        $query = "SELECT * FROM tasks ORDER BY task_due_date ASC";
        $result = $this->db->query($query);
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    // Change tasks status from either todo or done
    public function change_task_status($task_id, $save_data)
    {
        $this->db->where('task_id', $task_id);
        if ($this->db->update('tasks', $save_data)) {
            return true;
        } else {
            return false;
        }
    }
    // Save a task when a user submits the form
    public function save_task($save_data)
    {
        if ($this->db->insert('tasks', $save_data)) {
            return true;
        } else {
            return false;
        }
    }
    // Fetches an individual taks from tasks table
    public function get_task($id)
    {
        $this->db->where('task_id', $id);
        $result = $this->db->get('tasks');
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }
    // Deletes a task from the tasks table
    public function delete($id)
    {
        $this->db->where('task_id', $id);
        $result = $this->db->delete('tasks');
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}
