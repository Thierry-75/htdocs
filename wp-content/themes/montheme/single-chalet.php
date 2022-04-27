<?php get_header() ?>

<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post() ?>
        <h1><?php the_title() ?></h1>
        <?php if(get_post_meta(get_the_ID(),SponsoMetaBox::META_KEY,true)) ?>
        <p>
        <img src="<?php the_post_thumbnail_url() ?>" style="width:100%; height:auto;" />
        </p>
        <?php the_content() ?>
    <?php endwhile ?>

<?php else : ?>

<?php endif; ?>

<?php get_footer() ?>