<?php get_header() ?>

<?php if (have_posts()) : ?>
    
    <?php while (have_posts()) : the_post() ?> 
        <h1><?php the_title() ?></h1>
        <?php if (get_post_meta(get_the_ID(), SponsoMetaBox::META_KEY, true)) ?>
        <p>
            <img src="<?php the_post_thumbnail_url() ?>" style="width:100%; height:auto;" />
        </p>
        <?php the_content() ?>

        <h2>Article relatif</h2>
        <div class="row">
            <?php
            $critere = array_map(function ($term){
                return $term->term_id;
            },get_the_terms(get_posts(),'science'));
            $query = new WP_Query([
                'post_not_post' => [ get_the_ID() ],
                'post_type' => 'post',
                'post_per_page' => 3,
                'orderby' => 'rand',
                'tax_query' => [
                    [
                        'taxonomy' => 'science',
                        'terms' => $critere
                    

                    ]
                    ],
                    'meta_query'=>[
                        [
                            'key' => SponsoMetaBox::META_KEY,
                            'compare' => 'EXISTS'
                        ]
                    ]
            ]);
            while ($query->have_posts()) : $query->the_post();
                            ?>
                <div class="col sm-2 my-2">
                    <?php get_template_part('parts/post', 'post') ?>
                </div>

            <?php endwhile;
            wp_reset_postdata() ?>
        </div>
    <?php endwhile ?>

<?php else : ?>

<?php endif; ?>

<?php get_footer() ?>