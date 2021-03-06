<?php get_header() ?> <!-- appel du header-->

<!-- Creation taxonomy -->
<?php $sciences = get_terms(['taxonomy'=>'science']); ?>
<ul class="nav nav-pills my-4">
    <?php foreach($sciences as $science): ?>
        <li class="nav-item">
            <a href="<?= get_term_link($science) ?>" class="nav-link <?= is_tax('science',$science->term_id) ? 'active' : '' ?>"><?= $science->name ?></a>
  
        </li>
        <?php endforeach ?>
</ul>

<?php if (have_posts()) : ?>
    <div class="row">
        <?php while (have_posts()) : the_post() ?>
            <div class="col sm-2 my-2">
                <?php get_template_part('parts/post') ?>
            </div>
        <?php endwhile ?>
    </div>
    
    <?php App\montheme_pagination() ?>


<?php else : ?>
    <h1>Pas d'articles</h1>
<?php endif; ?>

<?php get_footer() ?><!--appel du footer-->  