<?php
/**
 * Template Name: Page des actualités
 */

get_header();
?>
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
			
			<?php
			if ( get_query_var('paged') ) {
			    $paged = get_query_var('paged');
			} elseif ( get_query_var('page') ) {
			    $paged = get_query_var('page');
			} else {
			    $paged = 1;
			}
			
			$args = array(
				'posts_per_page' => 10,
				'paged' => $paged,
				'post_type' => 'post'
			);
			$postslist = new WP_Query( $args );
			
			if ( $postslist->have_posts() ) {
			?>
			<div class="row mt-5">
				<div class="col-sm-12">
					<?php
					while ( $postslist->have_posts() ) : $postslist->the_post();
						$post_date_month = get_the_date( 'M' );
						$post_date_day = get_the_date( 'j' );
						$thumbnail = get_the_post_thumbnail_url();
					?>
					<div class="actu">
						<div class="actu-date">
							<span class="numero"><?php echo $post_date_day;?></span>
							<span class="mois"><?php echo $post_date_month;?></span>
						</div>
						<?php if ($thumbnail) {?>
						<div class="actu-img" style="background-image: url('<?php echo $thumbnail;?>');">
							
						</div>
						<?php }?>
						<div class="actu-content">
							<h2><a href="<?php the_permalink();?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
							<?php the_excerpt();?>
							<a href="<?php the_permalink();?>">Lire la suite</a>
						</div>
						
					</div>
					<?php
					endwhile;
					
					if( get_previous_posts_link() || get_next_posts_link() ) {
						echo '<hr>';
					}
					
					if( get_previous_posts_link() ) {
						previous_posts_link( '&laquo; Page précédente' );
						echo '<span class="px-3">/</span> ';
					}
					
					next_posts_link( 'Page suivante &raquo;', $postslist->max_num_pages );
					wp_reset_postdata();
					?>
				</div>
			</div>
			<?php
			}
			?>
		</div>
	</div>

<?php
get_footer();
