<?php
/**
 * Comments template for AstraDev.
 *
 * @package astradev
 */

defined( 'ABSPATH' ) || exit;

if ( post_password_required() ) {
    return;
}
?>

<div id="comments" class="comments-area">

    <?php if ( have_comments() ) : ?>
        <h2 class="comments-title">
            <?php
            $comment_count = (int) get_comments_number();
            printf(
                /* translators: 1: post title, 2: comment count */
                esc_html( _n( astradev_t( 'comments_title_one', 'Um comentário em "%2$s"' ), astradev_t( 'comments_title_many', '%1$s comentários em "%2$s"' ), $comment_count, 'astradev' ) ),
                number_format_i18n( $comment_count ),
                esc_html( get_the_title() )
            );
            ?>
        </h2>

        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
            <nav class="comment-navigation" aria-label="<?php echo esc_attr( astradev_t( 'comments_nav_aria', 'Navegação de comentários' ) ); ?>">
                <div class="nav-previous"><?php previous_comments_link( esc_html( astradev_t( 'comments_older', '&larr; Comentários antigos' ) ) ); ?></div>
                <div class="nav-next"><?php next_comments_link( esc_html( astradev_t( 'comments_newer', 'Comentários recentes &rarr;' ) ) ); ?></div>
            </nav>
        <?php endif; ?>

        <ol class="comment-list">
            <?php
            wp_list_comments( [
                'style'       => 'ol',
                'short_ping'  => true,
                'avatar_size' => 40,
                'callback'    => 'astradev_comment',
            ] );
            ?>
        </ol>

        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
            <nav class="comment-navigation" aria-label="<?php echo esc_attr( astradev_t( 'comments_nav_aria', 'Navegação de comentários' ) ); ?>">
                <div class="nav-previous"><?php previous_comments_link( esc_html( astradev_t( 'comments_older', '&larr; Comentários antigos' ) ) ); ?></div>
                <div class="nav-next"><?php next_comments_link( esc_html( astradev_t( 'comments_newer', 'Comentários recentes &rarr;' ) ) ); ?></div>
            </nav>
        <?php endif; ?>

    <?php else : ?>
        <?php if ( ! comments_open() ) : ?>
            <p class="no-comments"><?php echo esc_html( astradev_t( 'comments_closed', 'Os comentários estão fechados.' ) ); ?></p>
        <?php endif; ?>
    <?php endif; ?>

    <?php
    comment_form( [
        'title_reply'          => esc_html( astradev_t( 'comments_leave', 'Deixe um comentário' ) ),
        'title_reply_before'   => '<h2 class="comment-reply-title">',
        'title_reply_after'    => '</h2>',
        'label_submit'         => esc_html( astradev_t( 'comments_submit', 'Publicar comentário' ) ),
        'comment_notes_before' => '',
        'comment_notes_after'  => '',
    ] );
    ?>

</div><!-- #comments -->
