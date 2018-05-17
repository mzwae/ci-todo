<h2><?php echo $page_heading; ?></h2>
<p class="lead">Are you sure you want to delete this task?</p>


<?php echo form_open('tasks/delete'); ?>

  <?php if (validation_errors()): ?>
    <h3>Whoops! There was an error:</h3>
    <p><?php echo validation_errors(); ?></p>
  <?php endif; ?>

  <?php foreach ($query->result() as $row): ?>
    <?php echo $row->task_desc; ?>
    <br>
    <br>
    <?php echo form_submit('submit', 'Delete'); ?> or <a href="tasks">Cancel</a>

    <?php echo form_hidden('id', $row->task_id); ?>
  <?php endforeach; ?>

<?php echo form_close(); ?>
