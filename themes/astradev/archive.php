<?php
/**
 * Archive template (categories, tags, date).
 *
 * @package astradev
 */

defined( 'ABSPATH' ) || exit;

get_header();

$archive_title       = get_the_archive_title();
$archive_description = get_the_archive_description();
?>

<section class="ad-blog-section">
    <div class="ast-container">
        <header class="ad-blog-intro ad-blog-intro--archive">
            <span class="pf-section__eyebrow"><?php echo esc_html( astradev_t( 'archive_intro_eyebrow', 'Arquivo' ) ); ?></span>
            <h1 class="ad-blog-hero__title"><?php echo esc_html( wp_strip_all_tags( $archive_title ) ); ?></h1>
            <?php if ( $archive_description ) : ?>
                <p class="ad-blog-hero__subtitle"><?php echo wp_kses_post( $archive_description ); ?></p>
            <?php else : ?>
                <p class="ad-blog-hero__subtitle"><?php echo esc_html( astradev_t( 'archive_intro_empty', 'Navegue pelas publicacoes relacionadas a este tema.' ) ); ?></p>
            <?php endif; ?>
        </header>

        <div class="ad-blog-layout ad-blog-layout--single-column">

            <main class="ad-blog-main" aria-label="Lista de publicacoes do arquivo">
                <?php if ( have_posts() ) : ?>
                    <div class="ad-blog-grid">
                        <?php while ( have_posts() ) : the_post(); ?>
                            <article id="post-<?php the_ID(); ?>" <?php post_class( 'ad-blog-card' ); ?>>
                                <a class="ad-blog-card__thumb" href="<?php the_permalink(); ?>" aria-label="<?php the_title_attribute(); ?>">
                                    <?php if ( has_post_thumbnail() ) : ?>
                                        <?php the_post_thumbnail( 'large' ); ?>
                                    <?php else : ?>
                                        <span class="ad-blog-card__placeholder">{ }</span>
                                    <?php endif; ?>
                                </a>

                                <div class="ad-blog-card__body">
                                    <?php $cats = get_the_category(); ?>
                                    <?php if ( $cats ) : ?>
                                        <a class="ad-blog-card__cat" href="<?php echo esc_url( get_category_link( $cats[0]->term_id ) ); ?>">
                                            <?php echo esc_html( $cats[0]->name ); ?>
                                        </a>
                                    <?php endif; ?>

                                    <h2 class="ad-blog-card__title">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h2>

                                    <p class="ad-blog-card__excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 24, '...' ) ); ?></p>

                                    <div class="ad-blog-card__meta">
                                        <time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
                                        <span aria-hidden="true">&middot;</span>
                                        <span><?php echo esc_html( astradev_reading_time( get_the_ID() ) ); ?></span>
                                    </div>

                                    <a class="ad-blog-card__link" href="<?php the_permalink(); ?>"><?php echo esc_html( astradev_t( 'blog_read_article', 'Ler artigo' ) ); ?> &rarr;</a>
                                </div>
                            </article>
                        <?php endwhile; ?>
                    </div>

                    <nav class="ad-blog-pagination" aria-label="Navegacao das publicacoes">
                        <?php
                        the_posts_pagination( [
                            'mid_size'  => 1,
                            'prev_text' => astradev_t( 'blog_pagination_prev', 'Anterior' ),
                            'next_text' => astradev_t( 'blog_pagination_next', 'Proxima' ),
                        ] );
                        ?>
                    </nav>
                <?php else : ?>
                    <article class="ad-blog-empty">
                        <h2><?php echo esc_html( astradev_t( 'blog_no_posts_title', 'Nenhuma publicacao encontrada' ) ); ?></h2>
                        <p><?php echo esc_html( astradev_t( 'archive_no_posts_text', 'Refine os filtros ou explore os ultimos artigos da pagina inicial.' ) ); ?></p>
                    </article>
                <?php endif; ?>
            </main>

        </div>
    </div>
</section>

<?php get_footer(); ?>
