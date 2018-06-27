<div class="page-heder">
  <?php echo form_open('tasks/index/'.$list_id); ?>
  <h1>This is your <b><?=$list_name?></b> list contents...</h1>
  <div class="progress">
    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?=$this->List_model->get_list_progress($list_id)?>%" aria-valuemin="0"   aria-valuemax="100" style="width:<?=$this->List_model->get_list_progress($list_id)?>%">
        <?=$this->List_model->get_list_progress($list_id)?>%
      </div>
    </div>
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
          <select class="form-control" name="task_due_d">
            <option disabled selected>Select Day</option>
            <?php for ($i = 1; $i <= 30; $i++): ?>
              <option value="<?=$i?>"><?=date('jS', mktime($i, 0, 0, 0, $i, date('Y')))?></option>
            <?php endfor; ?>
          </select>
        </div>
        <div class="col-md-2">
          <select class="form-control" name="task_due_m">
            <option disabled selected>Select Month</option>
            <?php for ($i = 1; $i <= 12; $i++): ?>
              <option value="<?=$i?>"><?=date('F', mktime(0, 0, 0, $i, 1, date('Y')))?></option>
            <?php endfor; ?>
          </select>
        </div>
        <div class="col-md-2">
          <select class="form-control" name="task_due_y">
            <option disabled selected>Select Year</option>
            <?php for ($i = date("Y", strtotime(date("Y"))); $i<=date("Y", strtotime(date("Y").' +5 year')); $i++):?>
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
  <tr>
    <td><b>Task</b></td>
    <td>
      <b>Due Date</b> | <a href="<?=base_url()?>tasks/sort/<?=$list_id?>/<?=$dir?>"><?=$dir?> <?=$entity?></a>
    </td>
    <td>
      <b>Status</b>
    </td>
  </tr>
  <?php foreach ($query->result() as $row): ?>
    <?php
    if (date("Y-m-d", mktime(0, 0, 0, date('m'), date('d'), date('y'))) > $row->task_due_date) {
        echo '<tr class="list-group-item-danger">';
    }
    ?>
    <?php
    if ($row->task_due_date == null) {
        echo ' <tr>';
    }
    ?>
    <td width="60%">
      <?php
          if ($row->task_status == 'done') {
              echo '<strike>' . $row->task_desc . '</strike>';
          } else {
              echo $row->task_desc;
          }
       ?>
    </td>
    <td width="20%"><?php echo date_format(date_create($row->task_due_date), 'd/M/Y');?></td>
    <td width="10%">
      <?php if($row->task_status == 'todo'){echo anchor('tasks/status/done/'.$row->task_id.'/'.$list_id, 'Todo');} ?>
      <?php if($row->task_status == 'done'){echo anchor('tasks/status/todo/'.$row->task_id.'/'.$list_id, 'Done');} ?>
    </td>
    <td width="10%">
      <a href="<?=base_url()?>tasks/delete/<?=$row->task_id?>">Delete</a>
    </td>
</tr>
  <?php endforeach; ?>
</table>
