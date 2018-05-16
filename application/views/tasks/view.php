<div class="page-heder">
  <?php echo form_open('tasks/index'); ?>
    <div class="row">
      <div class="col-lg-12">
        <?php echo validation_errors(); ?>
        <div class="input-group">
          <input type="text" class="form-control" name="task_desc" placeholder="Type new task here...">
          <span class="input-group-btn">
            <button class="btn btn-success" type="submit">Add</button>
          </span>
        </div>
      </div>

    </div>

    <div class="row">
      <div class="form-group">
        <div class="col-md-2">
          <?php echo form_error('task_due_d'); ?>
          <select class="form-control" name="task_due_d">
            <option></option>
            <?php for ($i = 1; $i <= 30; $i++): ?>
              <option value="<?=$i?>"><?=date('jS', mktime($i, 0, 0, 0, $i, date('Y')))?></option>
            <?php endfor; ?>
          </select>
        </div>
        <div class="col-md-2">
          <?php echo form_error('task_due_m'); ?>
          <select class="form-control" name="task_due_m">
            <option></option>
            <?php for ($i = 1; $i <= 12; $i++): ?>
              <option value="<?=$i?>"><?=date('F', mktime(0, 0, 0, $i, 1, date('Y')))?></option>
            <?php endfor; ?>
          </select>
        </div>
        <div class="col-md-2">
          <?php echo form_error('task_due_y'); ?>
          <select class="form-control" name="task_due_y">
            <option></option>
            <?php for ($i = date("Y",strtotime(date("Y"))); $i<=date("Y",strtotime(date("Y").' +5 year')); $i++):?>
              <option value="<?=$i?>"><?=$i?></option>
            <?php endfor; ?>
          </select>
        </div>
      </div>
    </div>
  <?php echo form_close(); ?>
</div>

<!-- Display Existing Tasks -->
<table class="table table-hover">
  <?php foreach ($query->result() as $row): ?>

  <?php endforeach; ?>
</table>
