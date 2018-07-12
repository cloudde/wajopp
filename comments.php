<?php
/**
 * @package WordPress
 * @subpackage waj
 * 
 */
// Do not delete these lines
if ( !empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']) )
  die ( __('Please do not load this page directly.', 'colabsthemes') );
if ( post_password_required() ) { ?>
  <p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.','colabsthemes'); ?></p>
  <?php
  return;
}
global $commentDivsExist;

colabs_before_comments();
if ( have_comments() ) : ?>
  <?php $commentDivsExist = true; ?>
  <div id="comments">
    <header class="comment-header">
      <h3><?php comments_number(__('No Comments','colabsthemes'), __('One Comment','colabsthemes'), __('% Comments','colabsthemes') );?></h3>
    </header>
    <ol class="commentlist">
      <?php colabs_list_comments(); ?>
    </ol>
    <!-- /.commentlist -->
    <div class="navigation">
			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
			<nav id="comment-nav-below">
				<h1 class="assistive-text"><?php _e( 'Comment navigation', 'colabsthemes' ); ?></h1>
				<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'colabsthemes' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'colabsthemes' ) ); ?></div>
			</nav>
			<div class="clearfix"></div>
			<?php endif; // check for comment navigation ?>
    </div><!-- /navigation -->        
    <?php colabs_before_pings(); ?>
    <?php $carray = separate_comments( $comments ); // get the comments array to check for pings ?>
    <?php if ( !empty( $carray['pings'] ) ) : // pings include pingbacks & trackbacks ?>
      <h2 class="dotted" id="pings"><?php _e('Trackbacks/Pingbacks', 'colabsthemes'); ?></h2>
      <ol class="pinglist">
        <?php colabs_list_pings(); ?>
      </ol>
    <?php endif; ?>
    <?php colabs_after_pings(); ?>
<?php endif; // have_comments ?>

<?php colabs_after_comments(); ?>
<?php colabs_before_respond(); ?>
<?php if ( 'open' == $post->comment_status ) : ?>
    <?php colabs_before_comments_form(); ?>
    <?php colabs_comments_form(); ?>
    <?php colabs_after_comments_form(); ?>               
<?php endif; // open ?>
<?php colabs_after_respond(); ?>
<?php if ( $commentDivsExist ) : ?>
  </div>
<!-- #comments -->
<?php endif; ?>
