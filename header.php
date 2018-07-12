<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7 ie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8 ie7" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9 ie8" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
  <meta charset="<?php bloginfo('charset'); ?>" />
  <title><?php colabs_title(); ?></title>

  <?php global $colabs_options;?>
  
  <!--[if lt IE 9]>
    <script src="<?php echo get_template_directory_uri(); ?>/includes/js/html5shiv.js"></script>
  <![endif]-->

  <?php 
  wp_head(); 
  $site_title = get_bloginfo( 'name' );
  $site_url = home_url( '/' );
  $site_description = get_bloginfo( 'description' ); 
  ?>
  
</head>
<body <?php body_class(); ?>>
<div class="main-wrapper">
<?php colabs_header_before(); ?>

<section class="container section-header">

  <div class="row">
    
    <header class="logo col4">
    <?php
      if (get_option('colabs_logotitle')=='logo'){
      if ( isset($colabs_options['colabs_logo']) && $colabs_options['colabs_logo'] ) {
        echo '<div id="logo"><a href="' . $site_url . '" title="' . $site_description . '"><img src="' . $colabs_options['colabs_logo'] . '" alt="' . $site_title . '" /></a></div>';
      } 
      }else {
        echo '<h1><a href="' . $site_url . '">' . $site_title . '</a></h1>';
      } // End IF Statement
      ?>    
      <hgroup class="tagline">
        <?php
      if ( $site_description ) { echo '<h3>' . $site_description . '</h3>'; }
    ?>      
      </hgroup>
    </header>
    <!-- /.logo -->

    <form action="<?php echo home_url('/'); ?>" method="get" id="searchform" class="form_search advance-search col8">
      <div class="column col10">      
        <?php if(get_terms(COLABS_TAX_LOC)):?>
        <p class="search-where column col4">
          <?php wp_dropdown_categories('show_option_all='.__('All Location', 'colabsthemes').'&hierarchical=1&title_li=&use_desc_for_title=1&tab_index=2&name=sloc&selected='.colabs_get_search_tax_id(COLABS_TAX_LOC,'sloc').'&class=custom-select&taxonomy='.COLABS_TAX_LOC.'&echo=false&hide_if_empty=true');
          ?>
        </p>
        <?php endif;?>
        <?php if(get_terms(COLABS_TAX_CAT)):?>
				<p class="search-categories column col4">
          <?php wp_dropdown_categories('show_option_all='.__('All Categories', 'colabsthemes').'&title_li=&use_desc_for_title=1&tab_index=2&name=scat&selected='.colabs_get_search_tax_id(COLABS_TAX_CAT,'scat').'&class=custom-select&taxonomy='.COLABS_TAX_CAT.'&echo=false&hide_if_empty=true');
          ?>
        </p>
        <?php endif;?>
				<p class="search-what column col4">
          <input name="s" type="text" <?php if(get_search_query()) { echo 'value="'.trim(strip_tags(esc_attr(get_search_query()))).'"'; } else { ?> value="<?php _e('What are you looking for?','colabsthemes'); ?>" onfocus="if (this.value == '<?php _e('What are you looking for?','colabsthemes'); ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e('What are you looking for?','colabsthemes'); ?>';}" <?php } ?>>
        </p>
      </div>

      <div class="column col2">
        <p class="search-button">
          <input type="submit"  id="go" value="<?php _e('Search','colabsthemes'); ?>">
        </p>
      </div>
      
      <input type="hidden" name="action" value="advance_search">
    </form>
    <!-- .advance-search -->
    
  </div>
  
	<div class="main-nav">
		<div class="row">
			
			<div class="nav-collapse">
				<?php 
				$arr = array(
						'theme_location' => 'main-menu',
						'container' => 'div',
						'container_class' => 'main-menu',
            'is_megamenu' => true
				);
				wp_nav_menu($arr); ?>
			</div>
		</div>
	</div>
	<!-- /.main-nav -->	
</section>
<!-- /.section-header -->

<?php if( is_home() ){ ?>

<section class="container section-featured">
  <div class="row">

    <?php get_template_part('includes/featured','main'); ?>

    <?php 
    $arr = array(
        'theme_location' => 'secondary-menu',
        'container' => 'div',
        'container_class' => 'category-listing',
        'fallback_cb' => 'secondarymenu',
    );
    wp_nav_menu($arr); ?>

  </div>
</section>
<!-- /.section-featured -->
<?php } wp_reset_postdata(); ?>

<section class="container main-content-wrapper">  