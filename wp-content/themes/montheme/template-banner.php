<?php
/**
 * Template Name: Page avec bannière
 * Template Post Type: page, post
 */
?>
<?php get_header() ?>

<?php if (have_posts()) : ?>
    <p>Ici on pourra mettre une bannière</p>
    <?php while (have_posts()) : the_post() ?>
        <h1 class="text-center"><?php the_title() ?></h1>
        <img src="<?php the_post_thumbnail_url() ?>" style="width:100%; height:auto;" />
        <?php the_content() ?>
    <?php endwhile ?>

<?php else : ?>

<?php endif; ?>

<?php get_footer() ?>