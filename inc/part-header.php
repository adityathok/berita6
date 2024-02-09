<div class="header-top border-top border-bottom py-1 d-none d-md-block">
    <div class="row align-items-center">
        <div class="col-md-7 col-xl-9 overflow-hidden">
            <div class="d-flex align-items-center">
                <div class="dropend">
                    <div class="ps-0 dropdown-toggle dropdown-toggle-split">
                        <span class="btn-sm btn rounded-0 bg-color-theme border-0 btn-dark py-1">DON'T MISS:</span>
                    </div>
                </div>
                <div class="ticker-news w-100">
                    <?php
                    // The Query
                    $args = array(
                        'post_type'         => 'post',
                        'posts_per_page'    => 5,
                        'post_status'       => 'publish',
                    );
                    $the_query = new WP_Query($args);

                    // The Loop
                    $nm = 1;
                    if ($the_query->have_posts()) {
                        echo '<div id="carouselTickerNews" class="carousel slide carousel-fade" data-bs-ride="carousel">';
                        echo '<div class="carousel-inner">';
                        while ($the_query->have_posts()) {
                            $the_query->the_post();
                            if (get_the_title()) {
                                echo '<div class="carousel-item' . ($nm == 1 ? ' active' : '') . '">';
                                echo '<a class="d-block text-truncate w-50" href="' . get_the_permalink() . '" title="' . get_the_title() . '">' . get_the_title() . '</a>';
                                echo '</div>';
                            }
                            $nm++;
                        }
                        echo '</div>';
                        echo '</div>';
                    }
                    /* Restore original Post Data */
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
        </div>
        <div class="col-md-5 col-xl-3 text-end">
            <?php echo justg_get_sosmed(); ?>
            <button type="button" class="btn btn-sm bg-color-theme btn-dark border-0 rounded-0" data-bs-toggle="modal" data-bs-target="#searchHeaderModal">
                <i class="fa fa-search"></i>
            </button>
        </div>
    </div>
</div>


<!-- searchHeaderModal -->
<div class="modal fade" id="searchHeaderModal" tabindex="-1" aria-labelledby="searchHeaderModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content rounded-0">
      <div class="modal-body p-2">
        <form action="<?php echo get_site_url();?>" method="get" class="d-flex overflow-hidden border border-dark my-1 bg-light">
            <input type="text" name="s" placeholder="Search" class="form-control bg-light border-0 rounded-0">
            <button type="submit" class="btn btn-link text-secondary py-1 px-2">
                <i class="fa fa-search"></i>
            </button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="header-middle py-2">
    <div class="row align-items-center">
        <div class="col-md-4 col-xl-3 text-center text-md-start">            
            <?php echo the_custom_logo(); ?>
        </div>
        <div class="col-md-8 col-xl-9">            
            <?php get_berita_iklan('iklan_header'); ?>
        </div>
    </div>
</div>

<nav id="main-nav" class="navbar navbar-expand-md d-block navbar-light border-top bg-light p-0" aria-labelledby="main-nav-label">
    
    <h2 id="main-nav-label" class="screen-reader-text">
        <?php esc_html_e('Main Navigation', 'justg'); ?>
    </h2>

    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbarNavOffcanvas" aria-controls="navbarNavOffcanvas" aria-expanded="false" aria-label="<?php esc_attr_e('Toggle navigation', 'justg'); ?>">
        <span class="navbar-toggler-icon"></span>
        <small>Menu</small>
    </button>

    <div class="offcanvas offcanvas-start" tabindex="-1" id="navbarNavOffcanvas">

        <div class="offcanvas-header justify-content-end">
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>

        <!-- The WordPress Menu goes here -->
        <?php
        wp_nav_menu(
            array(
                'theme_location'  => 'primary',
                'container_class' => 'offcanvas-body',
                'container_id'    => '',
                'menu_class'      => 'navbar-nav justify-content-start flex-grow-1 pe-3',
                'fallback_cb'     => '',
                'menu_id'         => 'main-menu',
                'depth'           => 4,
                'walker'          => new justg_WP_Bootstrap_Navwalker(),
            )
        );
        ?>
    </div><!-- .offcanvas -->

</nav>
<div class="bg-color-theme d-block w-100 pb-1"></div>

