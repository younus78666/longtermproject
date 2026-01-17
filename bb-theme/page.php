<?php
/**
 * Default Page Template
 */

get_header();
?>

<main id="main-content" class="site-main">
    <?php while ( have_posts() ) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="container" style="padding: 4rem 1rem; max-width: 1280px; margin: 0 auto;">
                <header class="entry-header">
                    <h1 class="entry-title"><?php the_title(); ?></h1>
                </header>

                <div class="entry-content">
                    <?php the_content(); ?>
                </div>
            </div>
         </article>
    <?php endwhile; ?>
</main>

<?php get_footer(); ?>
