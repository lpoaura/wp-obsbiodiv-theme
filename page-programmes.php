<?php
/**
 * Template Name: Page des programmes
 */

get_header();

global $apiurl_programs;
$api_programs = api_geocitizen('programs');
$api_programs = $api_programs['programs'];
$count = $api_programs['count'];
$items = $api_programs['items'];
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
					<div class="entry-content">
						<?php the_content();?>
					</div><!-- .entry-content -->	
					<?php
					endwhile; // End of the loop.
					?>
				</div>
			</div>
			
			
			<?php
			if ( $count > 0) {
			?>
			<div class="row list-programs">
			<?php
				foreach ($items as $item) {
					if ($item['logo'] && UR_exists($item['logo'])) {
						$bg = "background-image: url('".$item['logo']."');";
					} else {
						$bg = '';
					}
					
					$id_program = $item['id_program'];
					
					if ($item['id_module'] == 1) {
						$item_url = $apiurl_programs.$id_program.'/observations';
					} else {
						$item_url = $apiurl_programs.$id_program.'/sites';
					}
			?>
				<div class="col-sm-12 col-md-6 col-lg-4 item-programs">
					<div class="program d-flex <?php if ($bg=='') echo 'no-bg';?>" style="<?php echo $bg; ?>">
						<a class="program-link d-flex" href="<?php echo $item_url;?>" target="_blank">
							<span class="align-self-center"><?php echo $item['title'];?></span>
						</a>
					</div>
				</div>
			<?
				}
			?>
			</div>
			<?php
			}
			?>
			</div>
		</div>
	</div>

<?php
get_footer();