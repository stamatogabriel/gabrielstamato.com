<?php

/**
 * AstraDev functions and definitions.
 *
 * @package astradev
 */

defined('ABSPATH') || exit;

/* ─── 1. Enqueue parent + child styles ───────────────────────── */
add_action('wp_enqueue_scripts', 'astradev_enqueue_assets', 20);
function astradev_enqueue_assets()
{
  // Parent theme style (Astra enqueues its own; we make sure child loads after)
  wp_enqueue_style(
    'astradev-child',
    get_stylesheet_uri(),
    ['astra-theme-css'],
    '1.9.' . filemtime( get_stylesheet_directory() . '/style.css' )
  );

  // Child JS
  wp_enqueue_script(
    'astradev-js',
    get_stylesheet_directory_uri() . '/assets/js/astradev.js',
    [],
    '1.9.' . filemtime( get_stylesheet_directory() . '/assets/js/astradev.js' ),
    true
  );
}

/* ─── 2. Dark-mode anti-FOUC inline script ────────────────────── */
add_action('wp_head', 'astradev_theme_init_script', 1);
function astradev_theme_init_script()
{
?>
  <script>
    (function() {
      var t = localStorage.getItem('astradev-theme');
      if (!t) {
        t = 'dark';
        localStorage.setItem('astradev-theme', t);
      }
      document.documentElement.setAttribute('data-theme', t);
    })();
  </script>
<?php
}

/* ─── 3. Body class helpers ──────────────────────────────────── */
// Dark mode toggle is injected by JS (astradev.js) directly into
// .main-header-container so it is visible on both desktop and mobile.
// PHP-based injection via astra_masthead_toggle_buttons goes into the
// mobile-only div (.ast-mobile-menu-buttons) and is hidden on desktop.
add_filter('body_class', 'astradev_body_classes');
function astradev_body_classes($classes)
{
  if (is_page('contact')) {
    $classes[] = 'pf-page-contact';
  }
  return $classes;
}

/* ─── 3.1 Text helper ───────────────────────────────────────── */
function astradev_t($key, $default)
{
  return $default;
}

/* ─── 4. Reading-time helper ──────────────────────────────────── */
function astradev_reading_time($post_id = null)
{
  $content    = get_post_field('post_content', $post_id);
  $word_count = str_word_count(wp_strip_all_tags($content));
  $minutes    = max(1, (int) round($word_count / 200));
  /* translators: %d = number of minutes */
  $reading_time_singular = astradev_t('reading_time_singular', '%d min de leitura');
  $reading_time_plural = astradev_t('reading_time_plural', '%d min de leitura');

  return sprintf(_n($reading_time_singular, $reading_time_plural, $minutes, 'astradev'), $minutes);
}

/* ─── 5. Disable Astra's banner on single posts ──────────────── */
add_action('wp', 'astradev_disable_astra_single_banner');
function astradev_disable_astra_single_banner()
{
  if (is_singular('post')) {
    remove_action('astra_entry_top', 'astra_single_post_banner');
  }
}

/* ─── 6. Custom comment callback ─────────────────────────────── */
function astradev_comment($comment, $args, $depth)
{
?>
  <li <?php comment_class('comment-item', $comment); ?> id="comment-<?php echo esc_attr($comment->comment_ID); ?>">
    <article class="comment-body">
      <div class="comment-author-wrap">
        <?php echo get_avatar($comment, 40, '', '', ['class' => 'comment-avatar']); ?>
        <div class="comment-meta">
          <span class="comment-author-name"><?php echo esc_html(get_comment_author($comment)); ?></span>
          <a class="comment-date" href="<?php echo esc_url(get_comment_link($comment)); ?>">
            <?php echo esc_html(get_comment_date('', $comment)); ?>
          </a>
        </div>
        <div class="comment-reply-link-wrap">
          <?php
          comment_reply_link(array_merge($args, [
            'reply_text' => esc_html(astradev_t('comments_reply', 'Responder')),
            'depth'      => $depth,
            'max_depth'  => $args['max_depth'],
            'before'     => '',
            'after'      => '',
          ]), $comment);
          ?>
        </div>
      </div>

      <?php if ('0' === $comment->comment_approved) : ?>
        <p class="comment-awaiting-moderation"><?php echo esc_html(astradev_t('comments_moderation', 'Seu comentário está aguardando moderação.')); ?></p>
      <?php endif; ?>

      <div class="comment-content">
        <?php comment_text($comment); ?>
      </div>
    </article>
  <?php
  // Note: closing </li> is handled by wp_list_comments
}
