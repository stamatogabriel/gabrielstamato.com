<?php
/**
 * Search results template.
 *
 * @package astradev
 */

defined( 'ABSPATH' ) || exit;

get_header();

$search_query = get_search_query();
$results_count = (int) $wp_query->found_posts;
?>

<section class="ad-blog-section">
    <div class="ast-container">
        <header class="ad-blog-intro ad-blog-intro--search">
            <span class="pf-section__eyebrow"><?php echo esc_html( astradev_t( 'search_intro_eyebrow', 'Busca' ) ); ?></span>
            <h1 class="ad-blog-hero__title"><?php printf( esc_html( astradev_t( 'search_intro_title', 'Resultados para "%s"' ) ), esc_html( $search_query ) ); ?></h1>
            <p class="ad-blog-hero__subtitle">
                <?php
                if ( $results_count > 0 ) {
                    printf(
                        esc_html( _n( astradev_t( 'search_found_one', '%d artigo encontrado.' ), astradev_t( 'search_found_many', '%d artigos encontrados.' ), $results_count, 'astradev' ) ),
                        $results_count
                    );
                } else {
                    echo esc_html( astradev_t( 'search_none', 'Nenhum artigo encontrado com este termo.' ) );
                }
                ?>
            </p>
        </header>

        <div class="ad-blog-layout">

            <main class="ad-blog-main" aria-label="<?php echo esc_attr( astradev_t( 'search_results_aria', 'Resultados da busca' ) ); ?>">
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

                    <nav class="ad-blog-pagination" aria-label="<?php echo esc_attr( astradev_t( 'search_pagination_aria', 'Navegacao dos resultados' ) ); ?>">
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
                        <h2><?php echo esc_html( astradev_t( 'search_no_results_title', 'Nenhum resultado encontrado' ) ); ?></h2>
                        <p><?php echo esc_html( astradev_t( 'search_no_results_text', 'Tente outro termo de busca ou confira os artigos recentes na barra lateral.' ) ); ?></p>
                    </article>
                <?php endif; ?>
            </main>

            <aside class="ad-blog-sidebar" aria-label="Refinar busca e atalhos">
                <div class="ad-blog-widget">
                    <h3 class="ad-blog-widget__title"><?php echo esc_html( astradev_t( 'search_new_search_title', 'Nova busca' ) ); ?></h3>
                    <form class="ad-blog-search" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <input type="search" name="s" value="<?php echo esc_attr( $search_query ); ?>" placeholder="<?php echo esc_attr( astradev_t( 'blog_search_placeholder', 'Buscar artigos...' ) ); ?>" aria-label="<?php echo esc_attr( astradev_t( 'blog_search_placeholder', 'Buscar artigos...' ) ); ?>">
                        <button type="submit"><?php echo esc_html( astradev_t( 'blog_search_button', 'Buscar' ) ); ?></button>
                    </form>
                </div>

                <?php
                $blog_categories = get_categories( [ 'hide_empty' => true ] );
                if ( $blog_categories ) :
                ?>
                <div class="ad-blog-widget">
                    <h3 class="ad-blog-widget__title"><?php echo esc_html( astradev_t( 'blog_categories_title', 'Categorias' ) ); ?></h3>
                    <ul class="ad-blog-widget__list">
                        <?php foreach ( $blog_categories as $category ) : ?>
                            <li>
                                <a href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>">
                                    <?php echo esc_html( $category->name ); ?>
                                    <span><?php echo (int) $category->count; ?></span>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>

                <?php
                $recent_posts = new WP_Query( [
                    'posts_per_page'      => 5,
                    'post_status'         => 'publish',
                    'ignore_sticky_posts' => true,
                ] );
                if ( $recent_posts->have_posts() ) :
                ?>
                <div class="ad-blog-widget">
                    <h3 class="ad-blog-widget__title"><?php echo esc_html( astradev_t( 'blog_recent_posts_title', 'Publicacoes recentes' ) ); ?></h3>
                    <ul class="ad-blog-widget__list ad-blog-widget__list--recent">
                        <?php while ( $recent_posts->have_posts() ) : $recent_posts->the_post(); ?>
                            <li>
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                </div>
                <?php
                endif;
                wp_reset_postdata();
                ?>
            </aside>

        </div>
    </div>
</section>

<?php get_footer(); ?>
