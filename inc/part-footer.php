<footer class="site-footer container pb-3" id="colophon">

    <div class="py-1 d-block mb-2" style="background-color:var(--color-theme);"></div>

    <div class="row">
        <?php 
        for ($x = 1; $x <= 3; $x++) : 
            if (is_active_sidebar('footer-widget-' . $x)) {
                echo '<div class="col-md py-md-3">';
                dynamic_sidebar('footer-widget-' . $x);
                echo '</div>';
            } 
        endfor;
        ?>
    </div>

    <div class="site-info text-center text-bg-dark p-2" style="background-color:var(--color-theme) !important;">
        <small>
            © <?php echo date("Y"); ?> <?php echo get_bloginfo('name'); ?>. All Rights Reserved.
            <br>
            Design by <a class="text-white opacity-50" href="https://velocitydeveloper.com" target="_blank" rel="noopener noreferrer"> Velocity Developer </a>
        </small>
    </div>
    <!-- .site-info -->

</footer>