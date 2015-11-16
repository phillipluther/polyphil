<?php
/**
 * Our footer partial, which contains the global page footer and script
 * inclusions. This file also closes any dangling tags opened by ./header.php.
 *
 * @future
 * I freakin' hate opening tags in one file and closing them in another.
 * Explore refactoring these templates to make things a little less ambiguous.
 *
 * @package WordPress
 * @subpackage Polyphil
 * @since Polyphil 1.0
 */
?>

        <footer class="footer-wrapper">
            <div class="footer">
            </div>
        </footer>

    </div> <!-- .page-wrapper -->

    <?php wp_footer(); ?>

</body>
</html>

<?php
    // eof