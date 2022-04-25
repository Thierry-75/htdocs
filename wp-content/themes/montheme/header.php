<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- activation barre wordpress -->
  <?php wp_head() ?>
</head>

<body>
  <div class="container-fluid">
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">

      <a class="navbar-brand" href="#"><?php bloginfo('name', $filter = 'raw') ?></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <?php wp_nav_menu([
        'theme_location' => 'header',
        'container' => false,
        'menu_class' => 'navbar-nav me-auto mb-2 mb-lg-0'
      ])  ?>
    <?= get_search_form() ?>
    </nav>
  </div>
  <div class="container">