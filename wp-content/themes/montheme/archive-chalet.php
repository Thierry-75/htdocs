<?php get_header() ?> <!-- appel du header-->

<h1>Voir tous nos chalets </h1>

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