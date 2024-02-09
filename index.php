<?php

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package justg
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();

$container  = velocitytheme_option('justg_container_type', 'container');
$paged      = (get_query_var('paged')) ? get_query_var('paged') : '';
?>

<div class="wrapper pt-2" id="index-wrapper">

    <div class="p-0 <?php echo esc_attr($container); ?>" id="content" tabindex="-1">

        <div class="row">

            <!-- Do the left sidebar check -->
            <?php do_action('justg_before_content'); ?>

                <main class="site-main" id="main">

                    <div class="carouselHome mb-4">                        
                        <?php
                        // The Query
                        $posts_query = new WP_Query(
                            array(
                                'post_type'         => 'post',
                                'posts_per_page'    => 5,
                            )
                        );
                        // The Loop
                        $nm = 1;
                        if ($posts_query->have_posts()) {
                            echo '<div id="carouselHome" class="carousel slide carousel-fade" data-bs-ride="carousel">';
                                echo '<div class="carousel-inner">';
                                while ($posts_query->have_posts()) {
                                    $posts_query->the_post();
                                    ?>
                                    <div class="slideshow-post-item carousel-item  <?php echo ($nm == 1 ? 'active' : ''); ?>">
                                        <a class="d-block position-relative" href="<?php echo get_the_permalink(); ?>">

                                            <div class="ratio ratio-16x9 bg-light overflow-hidden">
                                                <?php
                                                if (has_post_thumbnail()) {
                                                    $img_atr = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
                                                    echo '<img class="w-100" src="' . $img_atr[0] . '" alt="' . get_the_title() . '" loading="lazy">';
                                                } ?>
                                            </div>

                                            <div class="carousel-caption text-md-start text-center start-0 end-0 bottom-0 p-2 pb-3">
                                                <span class="bg-color-theme d-inline-block p-2 px-md-3" style="--bs-bg-opacity: 0.90;">
                                                    <?php echo get_the_title(); ?>
                                                </span>
                                            </div>

                                        </a>
                                    </div>
                                    <?php
                                    $nm++;
                                }
                                $nm = 0;
                                echo '</div>';
                                echo '<div class="carousel-indicators m-0 p-0">';
                                while ($posts_query->have_posts()) {
                                    $posts_query->the_post();
                                    echo '<button type="button" data-bs-target="#carouselHome" data-bs-slide-to="' . $nm . '" ' . ($nm == 0 ? 'class="active"' : '') . ' aria-current="true" aria-label="Slide ' . $nm . '"></button>';
                                    $nm++;
                                }
                                echo '</div>';
                            echo '</div>';
                        }
                        /* Restore original Post Data */
                        wp_reset_postdata();
                        ?>
                    </div>

                    <?php if(empty($paged)): ?>

                        <?php
                        $post1_title    = velocitytheme_option('title_posts_home_1', 'Recent Posts');
                        $post1_cat      = velocitytheme_option('cat_posts_home_1');
                        ?>
                        <div class="widget part_posts_home_1">

                            <h3 class="heading-theme position-relative">
                                <span>
                                    <?php if ($post1_cat && $post1_cat !== 'disable') : ?>
                                        <a style="color: inherit;" href="<?php echo get_tag_link($post1_cat); ?>">
                                            <?php echo $post1_title; ?>
                                        </a>
                                    <?php else: ?>
                                        <?php echo $post1_title; ?>
                                    <?php endif; ?>
                                </span>
                                <div class="position-absolute bottom-0 end-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-bookmark-fill color-theme" viewBox="0 0 16 16"> <path d="M2 2v13.5a.5.5 0 0 0 .74.439L8 13.069l5.26 2.87A.5.5 0 0 0 14 15.5V2a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2"></path> </svg>
                                </div>
                            </h3>
                            <div class="part-post-home-1">
                                <?php
                                $post1_args = array(
                                    'post_type'     => 'post',
                                    'cat'           => $post1_cat,
                                    'posts_per_page' => 4,
                                );
                                // The Query
                                $post1query = new WP_Query($post1_args);
                                if ($post1query->have_posts()) {
                                    echo '<div class="carousel-posthome">';
                                    while ($post1query->have_posts()) {
                                        $post1query->the_post();
                                        echo '<div class="item-posthome p-2">';
                                        echo module_cardposts(6);
                                        echo '</div>';
                                    }
                                    echo '</div>';
                                }
                                /* Restore original Post Data */
                                wp_reset_postdata();
                                ?>
                            </div>
                        </div>

                        <?php
                        $post2_title    = velocitytheme_option('title_posts_home_2', 'Recent Posts');
                        $post2_cat      = velocitytheme_option('cat_posts_home_2');
                        ?>
                        <div class="widget part_posts_home_2">
                            <h3 class="heading-theme position-relative">
                                <span>
                                    <?php if ($post2_title && $post2_title !== 'disable') : ?>
                                        <a style="color: inherit;" href="<?php echo get_tag_link($post2_cat); ?>">
                                            <?php echo $post2_title; ?>
                                        </a>
                                    <?php else: ?>
                                        <?php echo $post2_title; ?>
                                    <?php endif; ?>
                                </span>
                                <div class="position-absolute bottom-0 end-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-bookmark-fill color-theme" viewBox="0 0 16 16"> <path d="M2 2v13.5a.5.5 0 0 0 .74.439L8 13.069l5.26 2.87A.5.5 0 0 0 14 15.5V2a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2"></path> </svg>
                                </div>
                            </h3>
                            <div class="part-post-home-2">                            
                                <?php
                                $post2_args = array(
                                    'post_type' => 'post',
                                    'cat'       => $post2_cat,
                                    'posts_per_page' => 5,
                                );                            
                                // The Query
                                $post2query = new WP_Query($post2_args);
                                $n2 = 1;
                                if ($post2query->have_posts()) {
                                    echo '<div class="row">';
                                    while ($post2query->have_posts()) {
                                        $post2query->the_post();

                                        if($n2==1){
                                            echo '<div class="col-12 pb-3">';
                                                echo module_cardposts(5);
                                            echo '</div>';
                                        } else {
                                            echo '<div class="col-6 col-xl-3 pb-3">';
                                                echo module_cardposts(3);
                                            echo '</div>';
                                        }

                                        $n2++;
                                    }
                                    echo '</div>';
                                }
                                ?>
                            </div>
                        </div>
                    
                    <?php endif; ?>

                    <?php get_berita_iklan('iklan_home_1'); ?>

                    <div>
                        <h3 class="heading-theme position-relative">
                            <span>
                               Berita Terbaru
                            </span>
                            <div class="position-absolute bottom-0 end-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-bookmark-fill color-theme" viewBox="0 0 16 16"> <path d="M2 2v13.5a.5.5 0 0 0 .74.439L8 13.069l5.26 2.87A.5.5 0 0 0 14 15.5V2a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2"></path> </svg>
                            </div>
                        </h3>
                        <div>
                            <?php if (have_posts()) { 
                                $postcount=1;
                                while (have_posts()) {
                                    the_post();
                                    ?>
                                    <article class="mb-4">
                                        <div class="row">
                                            <div class="col-5 col-md-4">
                                                <a href="<?php echo get_the_permalink(); ?>" class="ratio ratio-4x3 bg-light overflow-hidden">
                                                    <?php echo get_the_post_thumbnail( get_the_ID(), 'medium', array( 'class' => 'w-100' ) ); ?>
                                                </a>
                                            </div>
                                            <div class="col-7 col-md-8">
                                                <?php
                                                the_title(
                                                    sprintf('<h2 class="h6 fw-bold"><a href="%s" rel="bookmark">', esc_url(get_permalink())),
                                                    '</a></h2>'
                                                );
                                                ?>
                                                <div class="d-none d-md-block mb-md-2">
                                                    <?php echo vdberita_limit_text(strip_tags(get_the_excerpt()), 15); ?>
                                                    <br>
                                                    <a class="btn btn-sm btn-secondary mt-2 border-0" style="font-size: 0.75rem;--bs-btn-bg:var(--color-theme);" href="<?php echo get_the_permalink(); ?>">Read More</a>
                                                </div>
                                                <div class="opacity-75">                                                    
                                                    <small>
                                                        Posted by : <?php echo get_the_author(); ?>
                                                    </small>
                                                    <small class="ms-1">
                                                        on <?php echo get_the_date(); ?>
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                    
                                    <?php 
                                        if ($postcount == 3) :
                                            get_berita_iklan('iklan_home_2');
                                        endif;
                                        $postcount++;
                                    ?>
                            <?php } } ?>
                            <!-- Display the pagination component. -->
                            <?php justg_pagination(); ?>
                        </div>
                    </div>

                </main><!-- #main -->

            <!-- Do the right sidebar check. -->
            <?php do_action('justg_after_content'); ?>
        </div><!-- .row -->

        <div class="row">
            <div class="col-md-6">
                <?php get_berita_iklan('iklan_home_bawah_1'); ?>
            </div>
            <div class="col-md-6">
                <?php get_berita_iklan('iklan_home_bawah_2'); ?>
            </div>
        </div>

    </div><!-- #content -->

</div><!-- #index-wrapper -->

<?php
get_footer();
