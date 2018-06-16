<html>
  <head>
    <title>Todo application</title>
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/styles.css">
  </head>
  <body>

    <nav class="navbar navbar-inverse">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="container">
      <div class="navbar-header">
          <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?=base_url()?>">Todo application</a>
      </div>
      <!-- Collection of nav links and other content for toggling -->
      <div id="navbarCollapse" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
              <li class="nav-item"><a href="<?=base_url()?>home">Home</a></li>
              <li class="nav-item"><a href="<?=base_url()?>about">About</a></li>

          </ul>

          <ul class="nav navbar-nav navbar-right">
          <?php if (!$this->session->userdata('logged_in')) : ?>
            <li><a href="<?=base_url();?>/users/login">Login</a></li>
            <li><a href="<?=base_url();?>/users/register">Register</a></li>
          <?php endif; ?>
          <?php if ($this->session->userdata('logged_in')) : ?>
            <li><a href="<?=base_url();?>/tasks">Creat List</a></li>
            <li><a href="<?=base_url();?>/users/logout">Logout</a></li>
          <?php endif; ?>
        </ul>

      </div>
    </div>
</nav>

<div class="container">
  <?php

  if ($this->session->flashdata('task_created')) {
      echo '<p class="alert alert-success">' . $this->session->flashdata('task_created') . '</p>';
  }
  if ($this->session->flashdata('task_error')) {
      echo '<p class="alert alert-danger">' . $this->session->flashdata('task_error') . '</p>';
  }
  if ($this->session->flashdata('task_deleted')) {
      echo '<p class="alert alert-danger">' . $this->session->flashdata('task_deleted') . '</p>';
  }
  if ($this->session->flashdata('task_status_change')) {
      echo '<p class="alert alert-danger">' . $this->session->flashdata('task_status_change') . '</p>';
  }
  if ($this->session->flashdata('task_status_error')) {
      echo '<p class="alert alert-danger">' . $this->session->flashdata('task_status_error') . '</p>';
  }
  ?>
