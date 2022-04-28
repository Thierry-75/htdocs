<?php get_header() ?> <!-- appel du header-->
<form class="form-inline">
  
  <input type="search" name="s" class="form-control mb-2 mr-sm-2" value="<?php get_search_query() ?>" placeholder="Votre recherche">


  <div class="form-check mb-2 mr-sm-2">
    <input class="form-check-input" type="checkbox" value="1" name="sponso" id="inlineFormCheck" <?= checked('1',get_query_var('sponso')) ?>>
    <label class="form-check-label" for="inlineFormCheck">
      Article sponsorisé seulement
    </label>
  </div>

  <button type="submit" class="btn btn-primary mb-2">Rechercher</button>
</form>

<h1 class="mb-4">Résultat de votre recherche : <span class="text-danger"><?= get_search_query() ?></span>  </h1>

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