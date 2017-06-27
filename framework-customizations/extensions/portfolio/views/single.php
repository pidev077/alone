<?php
get_header();
global $wp_query;

$alone_sidebar_position = function_exists( 'fw_ext_sidebars_get_current_position' ) ? fw_ext_sidebars_get_current_position() : 'right';
$alone_portfolio_settings = alone_get_options_portfolio();
$alone_portfolio_single_settings = $alone_portfolio_settings['portfolio_single'];

$ext_portfolio_instance = fw()->extensions->get( 'portfolio' );
$ext_portfolio_settings = $ext_portfolio_instance->get_settings();
$thumbnails = fw_theme_ext_portfolio_get_gallery_images();
// echo '<pre>'; print_r($thumbnails); echo '</pre>';

alone_title_bar();
?>
<section class="bt-main-row bt-section-space <?php alone_get_content_class( 'main', $alone_sidebar_position ); ?>" role="main" itemprop="mainEntity" itemscope="itemscope" itemtype="http://schema.org/Blog">
	<div class="container">
		<div class="row">
			<div class="bt-content-area <?php alone_get_content_class( 'content', $alone_sidebar_position ); ?>">
				<div class="bt-col-inner">
					<?php // if( function_exists('fw_ext_breadcrumbs') ) fw_ext_breadcrumbs(); ?>
					<?php while ( have_posts() ) : the_post();
						?>
            <article id="post-<?php the_ID(); ?>" <?php post_class( "portfolio portfolio-details" ); ?> itemscope="itemscope" itemtype="http://schema.org/PortfolioPosting" itemprop="portfolioPost">
            	<div class="fw-col-inner">
            		<div class="entry-content clearfix" itemprop="text">
            			<?php
            			/* content */
            			the_content();
                  ?>
                  <?php if(! empty($thumbnails) && count($thumbnails) > 0) : ?>
                  <div class="portfolio-gallery">
                    <h4 class="portfolio-gallery-title"><?php _e('Project Gallery', 'alone') ?></h4>
                    <div class="portfolio-gallery-items" data-bears-masonryhybrid='{"col": 4}' data-bears-lightgallery='{"selector": ".zoom-image"}'>
                      <div class="grid-sizer"></div>
          						<div class="gutter-sizer"></div>
                      <?php foreach($thumbnails as $thumb_item) :
                        $image_data = wp_get_attachment_image_src($thumb_item['attachment_id'], 'medium');
                      ?>
                      <div class="grid-item portfolio-gallery-item">
                        <div class="portfolio-gallery-item-inner">
                          <img src="<?php echo esc_attr($image_data[0]); ?>" alt="#">
                          <a href="<?php echo esc_attr($thumb_item['url']); ?>" class="zoom-image"><i class="fa fa-search" aria-hidden="true"></i></a>
                        </div>
                      </div>
                      <?php endforeach; ?>
                    </div>
                  </div>
                  <?php endif; ?>
                  <?php
            			wp_link_pages( array(
            				'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'alone' ) . '</span>',
            				'after'       => '</div>',
            				'link_before' => '<span>',
            				'link_after'  => '</span>',
            			) );
            			?>
            		</div>
            	</div>
            </article>
            <?php
						if ($alone_portfolio_single_settings['show_comment'] == 'yes') comments_template();
						break;
					endwhile; ?>
				</div><!-- /.bt-col-inner -->
			</div><!-- /.bt-content-area -->
			<?php get_sidebar(); ?>
		</div><!-- /.row -->
	</div><!-- /.container -->
</section>
<?php
// free memory
unset( $ext_portfolio_instance );
unset( $ext_portfolio_settings );
set_query_var( 'fw_portfolio_loop_data', '' );
get_footer();
