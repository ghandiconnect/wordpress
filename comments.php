<?php

/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Iqconnetik
 * @since 0.0.1
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if (post_password_required()) {
	return;
}

?>

<div id="comments" class="comments-area">
	<div class="comments-wrap">
		<?php
		//placehoders for fields
		$iqconnetik_commenter = wp_get_current_commenter();
		$comment_form = array(
			'comment_notes_before' => '',
			'title_reply_before'   => '<h4 id="reply-title" class="comment-reply-title">',
			'title_reply'   => iqconnetik_option('blog_single_comments_title_reply', esc_html__('Write your comment', 'iqconnetik')),
			'title_reply_after'    => '</h4>',
			'fields'        => array(

				'author' => '<p class="comment-form-author"><label for="author">' . esc_html__('Name', 'iqconnetik') . ' <span class="required">*</span></label> ' .
					'<input id="author" name="author" type="text" value="' . esc_attr($iqconnetik_commenter['comment_author']) . '" size="30" maxlength="245" required="required" /></p>',
				'email'  => '<p class="comment-form-email"><label for="email">' . esc_html__('Email', 'iqconnetik') . ' <span class="required">*</span></label> ' .
					'<input id="email" name="email" type="email" value="' . esc_attr($iqconnetik_commenter['comment_author_email']) . '" size="30" maxlength="100" aria-describedby="email-notes" required="required" /></p>',
				'url'    => '',
			),
			'comment_field' => '<p class="comment-form-comment"><label for="comment">' . esc_html_x('Comment', 'noun', 'iqconnetik') . '</label> <textarea id="comment" name="comment" cols="45" rows="2" maxlength="65525" required="required"></textarea></p>',
			'label_submit'         => esc_html__('Send', 'iqconnetik'),
			'submit_button' => '<button type="submit" name="%1$s" id="%2$s" class="margin-top-20 btn btn-wide btn-big btn-gradient submit">%4$s</button>',
		);
		?>
		<?php
		// You can start editing here -- including this comment!
		if (have_comments()) :
		?>
			<h4 class="comments-title">
				<?php
				$iqconnetik_comments_number = get_comments_number();
				//this option does not exists. Leave this code if we'll nedd post title in future
				if (iqconnetik_option('blog_single_show_post_title_in_comments', '')) :
					if ('1' === $iqconnetik_comments_number) {
						/* translators: %s: post title */
						printf(esc_html_x('One Reply to &ldquo;%s&rdquo;', 'comments title', 'iqconnetik'), esc_html(get_the_title()));
					} else {
						printf(
							esc_html(
								/* translators: 1: number of comments, 2: post title */
								_nx(
									'%1$s Reply to &ldquo;%2$s&rdquo;',
									'%1$s Replies to &ldquo;%2$s&rdquo;',
									$iqconnetik_comments_number,
									'comments title',
									'iqconnetik'
								)
							),
							esc_html(
								number_format_i18n(
									$iqconnetik_comments_number
								)
							),
							esc_html(get_the_title())
						);
					}
				else :
					if ('1' === $iqconnetik_comments_number) {
						printf(esc_html_x('One comment', 'comments title', 'iqconnetik'), esc_html(get_the_title()));
					} else {
						printf(
							esc_html(
								/* translators: 1: number of comments */
								_nx(
									'%1$s comment',
									'%1$s comments',
									$iqconnetik_comments_number,
									'comments title',
									'iqconnetik'
								)
							),
							esc_html(
								number_format_i18n(
									$iqconnetik_comments_number
								)
							),
							esc_html(get_the_title())
						);
					}
				endif;
				?>
			</h4>

			<ol class="comment-list">
				<?php
				wp_list_comments(
					array(
						'walker'      => iqconnetik_return_comments_walker(),
						'avatar_size' => 100,
						'style'       => 'ol',
						'short_ping'  => true,
					)
				);
				?>
			</ol>

		<?php
			the_comments_pagination(
				iqconnetik_get_the_posts_pagination_atts()
			);

		endif; // Check for have_comments().
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')) :
		?>
			<p class="no-comments"><?php esc_html_e('Comments are closed.', 'iqconnetik'); ?></p>
		<?php
		endif; //comments_open
		?>
		<?php comment_form($comment_form); ?>
	</div>
	<!--.comments-wrap -->
</div><!-- #comments -->