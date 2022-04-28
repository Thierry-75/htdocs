<div class="card" style="width: 18rem; height: 460px">
    <?php the_post_thumbnail('card-header', ['class' => 'card-img-top', 'alt' => '', 'style' => 'height:auto']) ?>

    <div class="card-body">
        <h4 class="card-title"><?php the_title() ?></h4>
        <h6 class="card-subtitle mb-2 text-muted"><?php the_category() ?> </h6>
        <p class="card-text"><?php the_excerpt() ?></p>
        <a href="<?php the_permalink() ?>" class="btn btn-primary btn-lg">Voir plus</a>

    </div>
</div>