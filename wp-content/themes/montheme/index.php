<?php get_header() ?> <!--appel du header-->

<?php if (have_posts()) : ?>
    <div class="row">
        <?php while (have_posts()) : the_post() ?>
            <div class="col sm-2">
                <div class="card" style="width: 18rem; height: 450px">
                    <?php the_post_thumbnail('medium', ['class' => 'card-img-top', 'alt' => '', 'style' => 'height:auto']) ?>
                    
                    <div class="card-body">
                        <h4 class="card-title"><?php the_title() ?></h4>
                        <h6 class="card-subtitle mb-2 text-muted"><?php the_category() ?></h6>
                        <p class="card-text"><?php the_excerpt() ?></p>
                        <a href="<?php the_permalink() ?>" class="btn btn-primary">Voir plus</a>
                      
                    </div>
                </div>
            </div>
        <?php endwhile ?>

    </div>
    
    <?php App\montheme_pagination() ?>


<?php else : ?>
    <h1>Pas d'articles</h1>
<?php endif; ?>

<?php get_footer() ?><!--appel du footer-->  