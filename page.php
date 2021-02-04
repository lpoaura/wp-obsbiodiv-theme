<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WP_OBSBIODIV
 */

get_header(); ?>

	<div id="content" class="site-content">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<?php
					while ( have_posts() ) : the_post();
					?>
					<h1 class="page-title text-left m-0"><?php the_title();?></h1>
					<hr class="sous-titre my-0">
					<div class="entry-content pt-3">
						<?php the_content();?>
					</div><!-- .entry-content -->	
					<?php
					endwhile; // End of the loop.
					?>
				</div>
			</div>
		</div>
	</div>

<?php
get_footer();