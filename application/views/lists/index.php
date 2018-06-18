<h2><?=$title?></h2>

<ul class="list-group">
  <?php foreach($lists as $list): ?>
    <li class="list-group-item">
      <a href="<?=base_url('lists/'.$list['list_id'])?>">
        <?=$list['list_name']?>
      </a>

    </li>
  <?php endforeach; ?>
</ul>
