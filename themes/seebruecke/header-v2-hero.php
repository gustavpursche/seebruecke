<?php

global $header_id;
global $post;

$label = rwmb_meta('header_label', null, $header_id);
$reference = rwmb_meta('header_reference', null, $header_id);

$secondary_label = rwmb_meta('header_secondary_label', null, $header_id);
$secondary_reference = rwmb_meta('header_secondary_reference', null, $header_id);
$image_caption = rwmb_meta('header_image-caption', null, $header_id);

$thumbnail_id = get_post_thumbnail_id($header_id);
$thumbnail_attrs = array(
  'class' => 'v2-header__image',
);

$template = 'v2-header--template-' . basename(get_page_template_slug());

$template = str_replace('.php', '', $template);

?>

<!doctype html>

<html <?php language_attributes(); ?>>

  <?php get_template_part('html', 'head'); ?>

  <body>
    <?php wp_admin_bar_render(); ?>

    <header class="v2-header v2-header--is-hero <?php echo $template; ?>">
      <?php
        if($thumbnail_id) {
          echo wp_get_attachment_image(
            $thumbnail_id,
            'hero-image',
            false,
            $thumbnail_attrs
          );
        }
      ?>

      <?php
        wp_nav_menu([
          'theme_location' => 'header-secondary',
          'menu_class' => 'v2-header-menu-list-secondary',
          'container' => false
        ]);
      ?>

      <div class="v2-header-menu-before"></div>

      <?php get_template_part('logo'); ?>

      <nav class="v2-header-menu">
        <?php
          wp_nav_menu(
            array(
              'theme_location' => 'header-menu',
              'menu_class' => 'v2-header-menu-list',
              'container' => false,
              'walker' => new Navigation_Walker()
            )
          );
        ?>

        <button type="button" class="v2-burger js-burger" aria-label="Menü">
          <span class="v2-burger__bars"></span>
        </button>

        <?php get_template_part('social-media-v2'); ?>
      </nav>

      <div class="v2-header-single">
        <h1 class="v2-header-single__title">
          <?php if ($header_id) {
            echo get_the_title($header_id);
          } else {
            the_title();
          } ?>
        </h1>

        <?php if ($header_id && get_the_content(null, false, $header_id)) : ?>
          <p class="v2-header-single__content">
            <?php echo get_the_content(null, false, $header_id); ?>
          </p>
        <?php endif; ?>

        <?php if ($reference && $label && $post->ID != $reference) : ?>
          <a href="<?php the_permalink($reference); ?>" class="v2-button">
            <?php echo $label; ?>
          </a>
        <?php endif; ?>

		  <?php if($secondary_label && $secondary_reference): ?>
		  <div>
			  <a href="<?php echo $secondary_reference; ?>"
				 class="v2-button" style="margin-top: 1rem;">
				  <?php echo $secondary_label; ?>
			  </a>
		  </div>
		  <?php endif; ?>

      </div>
    </header>
