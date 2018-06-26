<h2><?=$title?></h2>
<?php echo form_open('lists/create'); ?>
<div class="row">
  <div class="col-lg-12">
    <?php echo validation_errors(); ?>
    <div class="input-group">
      <input type="text" class="form-control" name="list_name" placeholder="Type new list here...">
      <span class="input-group-btn">
        <button class="btn btn-success" type="submit">Create</button>
      </span>
    </div>
  </div>
</div>
<?php echo form_close(); ?>

<ul class="list-group">
  <?php foreach ($lists as $list): ?>
    <li class="list-group-item">
      <a href="<?=base_url('tasks/index/'.$list['list_id'])?>">
        <?=$list['list_name']?>
      </a>

      <form class="list-delete" action="lists/delete/<?=$list['list_id']?>" method="post">
          <input type="submit" value="[X]" class="btn-link text-danger">
      </form>

      <div class="progress">
        <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="<?=$tasks_progress?>" aria-valuemin="0"   aria-valuemax="100" style="width:<?=$tasks_progress?>">
            <?=$tasks_progress?>
          </div>
        </div>

    </li>
  <?php endforeach; ?>
</ul>
