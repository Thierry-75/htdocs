<ul class="nav nav-pills my-4">
    <?php foreach($sciences as $science): ?>
        <li class="nav-item">
            <a href="<?= get_term_link($science) ?>" class="nav-link <?= is_tax('science',$science->term_id) ? 'active' : '' ?>"><?= $science->name ?></a>
  
        </li>
        <?php endforeach ?>
</ul>