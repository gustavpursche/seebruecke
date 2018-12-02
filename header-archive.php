<!doctype html>

<html <?php language_attributes(); ?>>

  <?php get_template_part('html', 'head'); ?>

  <body>
    <?php
      wp_admin_bar_render();
      $archive = get_queried_object();
      $title = get_queried_object()->label;
    ?>

    <header class="header header--without-image">
      <?php get_template_part('navigation'); ?>

      <a href="<?php echo pll_home_url(); ?>"
         class="header__logo-container">
        <?php get_template_part('logo'); ?>

        <span class="visually-hidden">
          <?php echo pll__('Zurück zur Seebrücke Startseite') ?>
        </span>
      </a>

      <div class="header__content">
        <div class="constraint">
          <h1 class="header__title">
            <?php pll_e('Alle ' . $title); ?>
          </h1>
        </div>
      </div>
    </header>

    <?php get_template_part('support'); ?>
