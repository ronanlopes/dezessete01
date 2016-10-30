<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to tfuse_comment() which is
 * located in the functions.php file.
 *
 */
?>

    <section id="comments" class="comments-area">
    <?php if ( post_password_required() ) : ?>
        <p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'tfuse' ); ?></p>
    </div><!-- #comments -->
    <?php
            /* Stop the rest of comments.php from being processed,
             * but don't kill the script entirely -- we still have
             * to fully load the template.
             */
            return;
        endif;
    ?>

    <?php
    $commenter = wp_get_current_commenter();
        $req = get_option( 'require_name_email' );
        $aria_req = ( $req ? " aria-required='true'" : '' );
    
        // You can start editing here -- including this comment! ?>

    <?php if ( have_comments() ) : ?>
        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
        <nav id="comment-nav-above">
            <div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'tfuse' ) ); ?></div>
            <div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'tfuse' ) ); ?></div>
        </nav>
        <?php endif; // check for comment navigation ?> 

        <h3 class="comments-title"><?php comments_number("0 ".__('Comments','tfuse'), "1 ".__('Comment','tfuse'), "% ".__('Comments','tfuse')); ?><?php _e(' Added', 'tfuse') ?></h2>
        <a href="#addcomments" class="link-add-comment anchor"><?php _e( 'Join Discussion', 'tfuse' );?></a>
        <ol class="comment-list">
            <?php
                /* Loop through and list the comments. Tell wp_list_comments()
                 * to use tfuse_comment() to format the comments.
                 * If you want to overload this in a child theme then you can
                 * copy file comments-template.php to child theme or
                 * define your own tfuse_comment() and that will be used instead.
                 * See tfuse_comment() in comments-template.php for more.
                 */
                get_template_part( 'comments', 'template' );
                wp_list_comments( array( 'callback' => 'tfuse_comment' ) );
            ?>
        </ol>

        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
        <nav id="comment-nav-below">
            <div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'tfuse' ) ); ?></div>
            <div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'tfuse' ) ); ?></div>
        </nav>
        <?php endif; // check for comment navigation ?>

    <?php elseif ( comments_open() ) : // If comments are open, but there are no comments ?>

        <p class="nocomments"><?php _e('No comments yet.', 'tfuse') ?></p>

    <?php endif; ?>
</section><!-- #comments -->
<?php
$args = array(
    'id_form'           => 'addcomments',
    'id_submit'         => 'submit',
    'title_reply'       => __( 'Leave Your Reply','tfuse'  ),
    'title_reply_to'    => __( 'Leave Your Reply to %s','tfuse'  ),
    'cancel_reply_link' => __( 'Cancel Reply','tfuse'  ),
    'label_submit'      => __( 'POST COMMENT','tfuse'  ),

    'comment_field' => ' <div class="row_form field_textarea">
                            <label class="label_title">' . __( 'Comment', 'tfuse' ) .'</label>
                            <textarea cols="30" rows="10" name="comment" class="textarea" placeholder="' . __( 'Comment', 'tfuse' ) .'"></textarea>
                        </div>',

    'must_log_in' => '<p class="must-log-in">' .
        sprintf(
            __( 'You must be <a href="%s">logged in</a> to post a comment.','tfuse'  ),
            wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )
        ) . '</p>',

    'logged_in_as' => '<p class="logged-in-as">' .
        sprintf(
            __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>','tfuse'  ),
            admin_url( 'profile.php' ),
            $user_identity,
            wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) )
        ) . '</p>',

    'comment_notes_before' => '',

    'comment_notes_after' => '',

    'fields' => apply_filters( 'comment_form_default_fields', array(

            'author' =>'<div class="row_form alignleft field_text">
                            <label class="label_title">' . __( 'Name', 'tfuse' ) . '</label>
                            <input type="text" name="author" value="' . esc_attr( $commenter['comment_author'] ) .'" class="inputtext required" placeholder="' . __( 'Name', 'tfuse' ) . '"  ' . $aria_req . '>
                        </div>',

            'email' =>'<div class="row_form alignleft field_text omega">
                            <label class="label_title">' . __( 'Email', 'tfuse' ) . ' <small>'. __('(never published)','tfuse').'</small></label>
                            <input type="text" name="email" value="' . esc_attr(  $commenter['comment_author_email'] ) .'" class="inputtext required" placeholder="'. __('Email (never published)','tfuse').'" ' . $aria_req . '>
                        </div>
                        <div class="clear"></div>',
        )
    ),
);
comment_form($args);

?>