<?php
get_header(); ?>

	<div id="content" class="site-content">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<?php
					while ( have_posts() ) : the_post();
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
							<h1 class="page-title text-left m-0"><?php the_title();?></h1>
							<hr class="sous-titre my-0">
							<div class="mt-5 mb-4">
								<?php the_content();?>
							</div>
						</div>
						
					</div>
					<?php
					endwhile;
					?>
				</div>
			</div>
		</div>
	</div>

<?php
get_footer();