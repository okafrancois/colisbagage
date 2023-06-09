<?php
/**
 * @author  RadiusTheme
 * @since   1.0.0
 * @version 1.0.0
 */

if ( post_password_required() ) {
	return;
}

/**
 * Comment List
 */
?>

<?php if ( have_comments() ): ?>
	<?php
	$comments_number = get_comments_number();
	$comments_text   = $comments_number == 1 ? esc_html__( 'Comment', 'cl-classified' ) : esc_html__( 'Comments', 'cl-classified' );
	$comments_html   = number_format_i18n( $comments_number ) . ' ' . $comments_text;
	$has_avatar      = get_option( 'show_avatars' );
	$comment_class   = $has_avatar ? ' avatar-disabled' : '';
	$comment_args    = [
		'callback'    => 'RadiusTheme\ClassifiedLite\Helper::comments_callback',
		'reply_text'  => esc_html__( 'Reply', 'cl-classified' ),
		'avatar_size' => 70,
	];
	?>
    <div class="content-block-gap"></div>
    <div class="site-content-block blog-comment">
        <div class="main-title-block">
            <h3 class="main-title"><?php echo esc_html( $comments_html ); ?></h3>
        </div>
        <div class="main-content">
            <div class="comments-area">
                <ul class="comment-list<?php echo esc_attr( $comment_class ); ?>">
                    <?php wp_list_comments( $comment_args ); ?>
                </ul>
                <?php the_comments_navigation(); ?>

                <?php if ( ! comments_open() ) : ?>
                    <div class="comments-closed"><?php esc_html_e( 'Comments are closed.', 'cl-classified' ); ?></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php endif; ?>


<?php
/**
 * Comment Form
 */

$rdtheme_commenter = wp_get_current_commenter();
$rdtheme_req       = get_option( 'require_name_email' );
$rdtheme_aria_req  = ( $rdtheme_req ? " required" : '' );

$comment_form_fields = [
	'author' =>
		'<div class="row gutters-20"><div class="col-lg-6 form-group"><input type="text" id="author" name="author" value="' . esc_attr( $rdtheme_commenter['comment_author'] )
		. '" placeholder="' . esc_attr__( 'Name', 'cl-classified' ) . ( $rdtheme_req ? ' *' : '' ) . '" class="form-control"' . $rdtheme_aria_req . '></div>',

	'email' =>
		'<div class="col-lg-6 form-group"><input id="email" name="email" type="email" value="' . esc_attr( $rdtheme_commenter['comment_author_email'] )
		. '" class="form-control" placeholder="' . esc_attr__( 'Email', 'cl-classified' ) . ( $rdtheme_req ? ' *' : '' ) . '"' . $rdtheme_aria_req . '></div></div>',
];

$comment_form_args = [
	'class_submit'  => 'submit btn-send',
	'submit_field'  => '<div class="form-group submit-button">%1$s %2$s</div>',
	'comment_field' => '<div class="form-group"><textarea id="comment" name="comment" required placeholder="' . esc_attr__( 'Comment *', 'cl-classified' )
	                   . '" class="form-control textarea" rows="10" cols="40"></textarea></div>',
	'fields'        => apply_filters( 'comment_form_default_fields', $comment_form_fields ),
];
?>

<?php if ( comments_open() ): ?>
    <div class="content-block-gap"></div>
    <div class="site-content-block comment-reply-block">
        <div class="main-title-block">
            <h3 class="main-title"><?php esc_html_e( 'Leave a Comment', 'cl-classified' ); ?></h3>
        </div>
        <div class="main-content">
			<?php comment_form( $comment_form_args ); ?>
        </div>
    </div>
<?php endif; ?>