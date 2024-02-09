<?php

/**
 * The template for displaying archive pages
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package justg
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();

$container = velocitytheme_option('justg_container_type', 'container');
?>

<div class="wrapper" id="archive-wrapper">

    <div class="<?php echo esc_attr($container); ?>" id="content" tabindex="-1">

        <div class="card rounded-1 shadow-sm bg-light pt-2 px-3 mb-3" style="font-size: 0.8rem;">
            <?php echo justg_breadcrumb(); ?>
        </div>

        <div class="row">

            <!-- Do the left sidebar check -->
            <?php do_action('justg_before_content'); ?>

            <main class="site-main col order-2" id="main">

                <?php

                if (have_posts()) {
                ?>
                    <header class="page-header block-primary">
                        <?php
                        the_archive_title('<h1 class="page-title text-uppercase">', '</h1>');
                        the_archive_description('<div class="taxonomy-description border fw-light fst-italic bg-light d-block p-3 pb-1 mb-3"><small>', '</small></div>');
                        ?>
                    </header><!-- .page-header -->
                    <?php
                    // Start the loop.
                    $postcount = 1;
                    while (have_posts()) {
                        the_post();
                        ?>
                        <article class="block-primary mb-4">

                            <?php
                            the_title(
                                sprintf('<h2 class="h5 mb-md-3 fw-bold"><a href="%s" rel="bookmark">', esc_url(get_permalink())),
                                '</a></h2>'
                            );
                            ?>
                            <div class="position-relative d-flex mt-2 justify-content-between align-items-center py-1 ps-2 pe-4 bg-pattern border text-muted bg-light mb-3">
                                <div>
                                    <small>
                                        Posted by : <?php echo get_the_author(); ?>
                                    </small>
                                    <small class="ms-2">
                                        <?php echo get_the_date(); ?>
                                    </small>
                                    
                                    <?php 
                                    $categories = get_the_terms( get_the_ID(), 'category' );
                                    if ($categories) : ?>
                                        <small class="ms-2">
                                            Category : <?php echo $categories[0]->name; ?>
                                        </small>
                                    <?php endif; ?>
                                </div>
                                <div class="position-absolute bottom-0 end-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-bookmark-fill color-theme" viewBox="0 0 16 16"> <path d="M2 2v13.5a.5.5 0 0 0 .74.439L8 13.069l5.26 2.87A.5.5 0 0 0 14 15.5V2a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2"/> </svg>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-5">
                                    <a href="<?php echo get_the_permalink(); ?>">
                                        <div class="ratio ratio-16x9 bg-light overflow-hidden">
                                            <?php echo get_the_post_thumbnail( get_the_ID(), 'medium', array( 'class' => 'w-100' ) ); ?>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-7">
                                    <?php echo vdberita_limit_text(strip_tags(get_the_content()), 25); ?>
                                </div>
                            </div>

                        </article>

                        <?php

                        if ($postcount == 1) :
                            get_berita_iklan('iklan_archive');
                        endif;
                        if ($postcount == 4) :
                            get_berita_iklan('iklan_archive_2');
                        endif;

                        $postcount++;
                    }
                } else {
                    get_template_part('loop-templates/content', 'none');
                }
                ?>
                <!-- Display the pagination component. -->
                <?php justg_pagination(); ?>

            </main><!-- #main -->

            <!-- Do the right sidebar check. -->
            <?php do_action('justg_after_content'); ?>

        </div><!-- .row -->

    </div><!-- #content -->

</div><!-- #archive-wrapper -->

<?php
get_footer();
