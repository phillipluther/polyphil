<?php
/**
 * This is a specialized template for our fancy-pants home page.
 *
 * @package WordPress
 * @subpackage Polyphil
 * @since Polyphil 1.1
 */

    // load our header
    get_header(); 
?>

    <div class="content-wrapper container">
        <main class="content row">

            <div class="feature-wrapper">
                <div class="feature podcast col-xs-6 col-sm-3 col-lg-2 col-lg-offset-1">
                    <a href="/category/podcast" class="feature-link">

                        <h2 class="feature-title">Podcast</h2>
                        <p class="feature-text">I have a podcast called Polygoing Off. It's a chill, no-ego show that puts a casual spin on hardcore video gaming.</p>

                        <span class="feature-icon fa fa-microphone"></span>
                    </a>
                </div>

                <div class="feature blog col-xs-6 col-sm-3 col-lg-2">
                    <a href="/category/blog" class="feature-link">

                        <h2 class="feature-title">Blog</h2>
                        <p class="feature-text">I write about various topics. Mostly, I blog about games and game culture when I don't have a mic handy.</p>

                        <span class="feature-icon fa fa-pencil"></span>
                    </a>
                </div>

                <div class="feature youtube col-xs-6 col-sm-3 col-lg-2 col-lg-offset-1">
                    <a href="#" class="feature-link">

                        <h2 class="feature-title">YouTube</h2>
                        <p class="feature-text">I make game commentary videos. They're almost exclusively about Demons/Dark Souls'esque games.</p>

                        <span class="feature-icon fa fa-youtube-play"></span>
                    </a>
                </div>

                <div class="feature youtube col-xs-6 col-sm-3 col-lg-2">
                    <a href="#" class="feature-link">

                        <h2 class="feature-title">Twitter</h2>
                        <p class="feature-text">I infrequently tweet about games and not about games. Random quips can be fun and funny in moderation.</p>

                        <span class="feature-icon fa fa-twitter"></span>
                    </a>
                </div>
            </div>
        </main>
    </div>

<?php
    get_footer();

    // eof