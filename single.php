<?php

/**
 * The template for displaying all single posts
 *
 * @package justg
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();
$container  = velocitytheme_option('justg_container_type', 'container');
$format     = get_post_format() ?: 'standard';
?>

<div class="wrapper" id="single-wrapper">

	<div class="<?php echo esc_attr($container); ?>" id="content" tabindex="-1">

        <div class="card rounded-1 shadow-sm bg-light pt-2 px-3 mb-3" style="font-size: 0.8rem;">
            <?php echo justg_breadcrumb(); ?>
        </div>

		<div class="row">

			<!-- Do the left sidebar check -->
			<?php do_action('justg_before_content'); ?>

			<main class="site-main" id="main">

				<?php

				while (have_posts()) {
					the_post();
                    ?>

                    <?php get_berita_iklan('iklan_content'); ?>

                    <?php the_title('<h1 class="entry-title h5 fw-bold">', '</h1>'); ?>

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
                                    Category :
                                    <?php foreach ($categories as $index => $tag) : ?>
                                        <?php echo $index === 0 ? '' : ','; ?>
                                        <a href="<?php echo get_tag_link($tag->term_id); ?>"> <?php echo $tag->name; ?> </a>
                                        <?php if ($index > 1) {
                                            break;
                                        } ?>
                                    <?php endforeach; ?>
                                </small>
                            <?php endif; ?>
                        </div>
                        <div class="position-absolute bottom-0 end-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-bookmark-fill color-theme" viewBox="0 0 16 16"> <path d="M2 2v13.5a.5.5 0 0 0 .74.439L8 13.069l5.26 2.87A.5.5 0 0 0 14 15.5V2a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2"/> </svg>
                        </div>
                    </div>

                    <div class="entry-content">

                        <?php get_berita_iklan('iklan_content_2'); ?>

                        <?php
                        if (has_post_thumbnail() && $format !== 'video' && $format !== 'gallery') {
                            echo '<div class="mb-3">';
                                echo get_the_post_thumbnail( get_the_ID(), 'full', array( 'class' => 'w-100' ) );
                                $featured_image_caption = get_the_post_thumbnail_caption(get_the_ID());
                                if($featured_image_caption){
                                    echo '<div class="text-muted fst-italic"><small>' . $featured_image_caption . '</small></div>';
                                }
                            echo '</div>';
                        }
                        ?>

                        <?php the_content(); ?>
                        
                        <?php $gettags = get_the_tags(get_the_ID()); ?>
                        <?php if ($gettags) : ?>
                            <div class="mt-2 mb-4">
                                <?php foreach ($gettags as $index => $tag) : ?>
                                    <?php echo $index === 0 ? '' : ' '; ?>
                                    <a class="btn btn-dark btn-sm bg-color-theme border-0 rounded-0" href="<?php echo get_tag_link($tag->term_id); ?>"> <?php echo $tag->name; ?> </a>
                                    <?php if ($index > 1) {
                                        break;
                                    } ?>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                        
                        <?php get_berita_iklan('iklan_content_3'); ?>

                        <?php
                        wp_link_pages(
                            array(
                                'before' => '<div class="page-links">' . __('Pages:', 'justg'),
                                'after'  => '</div>',
                            )
                        );
                        ?>

                    </div><!-- .entry-content -->

                    <div class="single-post-nav d-md-flex justify-content-between border-top border-bottom pt-1 my-3">
                        <div class="share-post">
                            <?php echo justg_share(); ?>
                        </div>
                        <div class="nav-post">
                            <div class="btn-group" role="group" aria-label="Navigation Post">
                                <?php
                                $prev_post = get_adjacent_post(false, '', true);
                                if (!empty($prev_post)) {
                                    echo '<a href="' . get_permalink($prev_post->ID) . '" class="btn btn-sm btn-light border" title="' . $prev_post->post_title . '">Prev</a>';
                                }
                                $next_post = get_adjacent_post(false, '', false);
                                if (!empty($next_post)) {
                                    echo '<a href="' . get_permalink($next_post->ID) . '" class="btn btn-sm btn-light border" title="' . $next_post->post_title . '">Next</a>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="mostview-post">
                        <h6 class="heading-theme mb-3"><span>RELATED POSTS</span></h6>
                        <div class="related-post-loop">
                            <?php                            
                            $categories = wp_get_post_categories(get_the_ID());
                            $category_ids = array();
                            foreach ($categories as $category) {
                                $category_ids[] = $category;
                            }
                            $post1_args = array(
                                'post_type'         => 'post',
                                'post__not_in'      => [get_the_ID()],
                                'posts_per_page'    => 4,
                                'category__in'      => $category_ids
                            );
                            // The Query
                            $the_query = new WP_Query($post1_args);
                            if ($the_query->have_posts()) {
                                echo '<div class="row g-3 align-items-stretch">';
                                while ($the_query->have_posts()) {
                                    $the_query->the_post();
                                    echo '<article class="col-md-6 col-xl-3">';
                                        echo '<div class="bg-light p-2 h-100">';
                                        echo module_cardposts(2);
                                        echo '</div>';
                                    echo '</article>';
                                }
                                echo '</div>';
                            }
                            ?>
                        </div>
                    </div>

                    <?php
					// If comments are open or we have at least one comment, load up the comment template.
					if (comments_open() || get_comments_number()) {

						do_action('justg_before_comments');
						comments_template();
						do_action('justg_after_comments');
					}
				}
				?>

			</main><!-- #main -->

			<!-- Do the right sidebar check. -->
			<?php do_action('justg_after_content'); ?>

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #single-wrapper -->

<?php
get_footer();