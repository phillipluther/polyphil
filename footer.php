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
            <div class="footer container">
                <div class="row">
                    <div class="col-xs-6">
                        <div class="license-wrapper">
                            <a rel="license" class="license-badge" href="http://creativecommons.org/licenses/by-nc-nd/4.0/">
                                <img alt="Creative Commons License" style="border-width:0" src="https://i.creativecommons.org/l/by-nc-nd/4.0/80x15.png" />
                            </a>

                            <p class="license-text">
                                All podcast and blog content is licensed under a 

                                <a rel="license" href="http://creativecommons.org/licenses/by-nc-nd/4.0/">Creative Commons Attribution-NonCommercial-NoDerivatives 4.0 International License</a>

                                unless otherwise specified. All copyrighted material is included under Fair Use.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

    </div> <!-- .page-wrapper -->

    <?php wp_footer(); ?>

</body>
</html>

<?php
    // eof