<?php
/**
 * Single post template for AstraDev.
 *
 * @package astradev
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<!-- Reading progress bar -->
<div class="ad-progress-bar" aria-hidden="true">
    <div id="ad-progress-fill" class="ad-progress-fill"></div>
</div>

<?php astra_primary_content_top(); ?>

<div id="primary" class="content-area primary-content-area ad-single-primary">
    <main id="main" class="site-main">

        <?php while ( have_posts() ) : the_post(); ?>

            <?php $categories = get_the_category(); ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class( 'ad-single-post' ); ?>>

                <!-- ── 1. Hero header (full-bleed) ─────────────────── -->
                <header class="ad-post-header">
                    <div class="ad-post-header__inner">

                        <!-- Breadcrumb -->
                        <nav class="ad-post-breadcrumb" aria-label="<?php echo esc_attr( astradev_t( 'single_breadcrumb_aria', 'Navegação estrutural' ) ); ?>">
                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo esc_html( astradev_t( 'single_home', 'Início' ) ); ?></a>
                            <span class="sep" aria-hidden="true">/</span>
                            <?php if ( $categories ) : $cat = $categories[0]; ?>
                                <a href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>">
                                    <?php echo esc_html( $cat->name ); ?>
                                </a>
                                <span class="sep" aria-hidden="true">/</span>
                            <?php endif; ?>
                            <span class="current"><?php the_title(); ?></span>
                        </nav>

                        <!-- Category badges -->
                        <?php if ( $categories ) : ?>
                            <div class="ad-post-cats">
                                <?php foreach ( $categories as $cat ) : ?>
                                    <a href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>" class="ad-badge">
                                        <?php echo esc_html( $cat->name ); ?>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>

                        <!-- Title -->
                        <h1 class="entry-title ad-post-title"><?php the_title(); ?></h1>

                        <!-- Meta row -->
                        <div class="ad-post-meta">
                            <?php echo get_avatar( get_the_author_meta( 'ID' ), 44, '', '', [ 'class' => 'ad-post-meta__avatar' ] ); ?>
                            <div class="ad-post-meta__info">
                                <span class="ad-post-meta__author"><?php the_author(); ?></span>
                                <div class="ad-post-meta__secondary">
                                    <time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
                                        <?php echo esc_html( get_the_date() ); ?>
                                    </time>
                                    <span aria-hidden="true">&middot;</span>
                                    <span><?php echo esc_html( astradev_reading_time() ); ?></span>
                                    <?php
                                    $comment_count = (int) get_comments_number();
                                    if ( $comment_count ) : ?>
                                        <span aria-hidden="true">&middot;</span>
                                        <a href="#comments">
                                            <?php printf(
                                                esc_html( _n( astradev_t( 'single_comments_one', '%d comentário' ), astradev_t( 'single_comments_many', '%d comentários' ), $comment_count, 'astradev' ) ),
                                                (int) $comment_count
                                            ); ?>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <!-- Share buttons -->
                        <div class="ad-post-share">
                            <span class="ad-post-share__label"><?php echo esc_html( astradev_t( 'single_share', 'Compartilhar:' ) ); ?></span>
                            <?php
                            $post_url   = rawurlencode( get_permalink() );
                            $post_title = rawurlencode( get_the_title() );
                            ?>
                            <a class="ad-post-share__btn"
                               href="https://x.com/intent/tweet?text=<?php echo $post_title; ?>&url=<?php echo $post_url; ?>"
                               target="_blank" rel="noopener noreferrer">X / Twitter</a>
                            <a class="ad-post-share__btn"
                               href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $post_url; ?>&title=<?php echo $post_title; ?>"
                               target="_blank" rel="noopener noreferrer">LinkedIn</a>
                            <button class="ad-post-share__btn ad-post-share__btn--copy"
                                    id="ad-copy-link"
                                    data-url="<?php echo esc_attr( get_permalink() ); ?>">
                                <?php echo esc_html( astradev_t( 'single_copy_link', 'Copiar link' ) ); ?>
                            </button>
                        </div>

                    </div><!-- .ad-post-header__inner -->
                </header><!-- .ad-post-header -->

                <!-- ── 2. Featured image ───────────────────────────── -->
                <?php if ( has_post_thumbnail() ) : ?>
                    <div class="ad-featured-wrap">
                        <div class="ad-post-header__inner">
                            <figure class="ad-featured-figure">
                                <?php the_post_thumbnail( 'large' ); ?>
                            </figure>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- ── 3. Content + sidebar ───────────────────────── -->
                <div class="ad-content-wrap">
                    <div class="ad-post-header__inner">
                        <?php astra_entry_top(); ?>
                        <div class="ad-content-columns">

                            <!-- Main column -->
                            <div class="ad-content-main">
                                <div id="ad-entry-content" class="entry-content">
                                    <?php the_content(); ?>
                                    <?php wp_link_pages( [
                                        'before'      => '<div class="page-links">' . esc_html( astradev_t( 'single_pages', 'Páginas:' ) ),
                                        'after'       => '</div>',
                                        'link_before' => '<span>',
                                        'link_after'  => '</span>',
                                    ] ); ?>
                                </div><!-- #ad-entry-content -->

                                <!-- Tags -->
                                <?php $tags = get_the_tags(); if ( $tags ) : ?>
                                    <div class="ad-post-tags">
                                        <span class="ad-post-tags__label"><?php echo esc_html( astradev_t( 'single_tags', 'Tags:' ) ); ?></span>
                                        <?php foreach ( $tags as $tag ) : ?>
                                            <a href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>" class="ad-tag">
                                                #<?php echo esc_html( $tag->name ); ?>
                                            </a>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>

                                <!-- Author card -->
                                <div class="ad-author-card">
                                    <?php echo get_avatar( get_the_author_meta( 'ID' ), 72, '', '', [ 'class' => 'ad-author-card__avatar' ] ); ?>
                                    <div class="ad-author-card__body">
                                        <span class="ad-author-card__label"><?php echo esc_html( astradev_t( 'single_written_by', 'Escrito por' ) ); ?></span>
                                        <h3 class="ad-author-card__name"><?php the_author(); ?></h3>
                                        <?php $bio = get_the_author_meta( 'description' ); if ( $bio ) : ?>
                                            <p class="ad-author-card__bio"><?php echo esc_html( $bio ); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <!-- Post navigation -->
                                <?php
                                $prev_post = get_previous_post();
                                $next_post = get_next_post();
                                if ( $prev_post || $next_post ) : ?>
                                    <nav class="ad-post-nav" aria-label="<?php echo esc_attr( astradev_t( 'single_post_nav_aria', 'Navegação entre posts' ) ); ?>">
                                        <?php if ( $prev_post ) : ?>
                                            <a class="ad-post-nav__item ad-post-nav__item--prev"
                                               href="<?php echo esc_url( get_permalink( $prev_post ) ); ?>">
                                                <span class="ad-post-nav__dir">&larr; <?php echo esc_html( astradev_t( 'single_prev', 'Anterior' ) ); ?></span>
                                                <span class="ad-post-nav__title"><?php echo esc_html( get_the_title( $prev_post ) ); ?></span>
                                            </a>
                                        <?php else : ?>
                                            <div class="ad-post-nav__item ad-post-nav__item--empty"></div>
                                        <?php endif; ?>
                                        <?php if ( $next_post ) : ?>
                                            <a class="ad-post-nav__item ad-post-nav__item--next"
                                               href="<?php echo esc_url( get_permalink( $next_post ) ); ?>">
                                                <span class="ad-post-nav__dir"><?php echo esc_html( astradev_t( 'single_next', 'Próximo' ) ); ?> &rarr;</span>
                                                <span class="ad-post-nav__title"><?php echo esc_html( get_the_title( $next_post ) ); ?></span>
                                            </a>
                                        <?php else : ?>
                                            <div class="ad-post-nav__item ad-post-nav__item--empty"></div>
                                        <?php endif; ?>
                                    </nav>
                                <?php endif; ?>

                                <!-- Comments -->
                                <?php if ( comments_open() || get_comments_number() ) : ?>
                                    <?php comments_template(); ?>
                                <?php endif; ?>

                            </div><!-- .ad-content-main -->

                            <!-- Sidebar column -->
                            <aside class="ad-content-sidebar">

                                <!-- Table of Contents (auto-built by JS) -->
                                <div id="ad-toc" class="ad-toc" style="display:none;" aria-label="<?php echo esc_attr( astradev_t( 'single_toc_aria', 'Sumário' ) ); ?>">
                                    <span class="ad-toc__title"><?php echo esc_html( astradev_t( 'single_on_page', 'Nesta página' ) ); ?></span>
                                    <nav id="ad-toc-nav"></nav>
                                </div>

                                <!-- Search -->
                                <div class="ad-sidebar-widget">
                                    <span class="ad-sidebar-widget__title"><?php echo esc_html( astradev_t( 'single_search_title', 'Buscar' ) ); ?></span>
                                    <form class="ad-sidebar-search" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                                        <input type="search"
                                               name="s"
                                               placeholder="<?php echo esc_attr( astradev_t( 'single_search_placeholder', 'Buscar artigos…' ) ); ?>"
                                               value="<?php echo esc_attr( get_search_query() ); ?>"
                                               aria-label="<?php echo esc_attr( astradev_t( 'single_search_aria', 'Buscar' ) ); ?>">
                                        <button type="submit">&#8981;</button>
                                    </form>
                                </div>

                                <!-- Categories -->
                                <?php
                                $cats = get_categories( [ 'hide_empty' => false ] );
                                if ( $cats ) : ?>
                                    <div class="ad-sidebar-widget">
                                        <span class="ad-sidebar-widget__title"><?php echo esc_html( astradev_t( 'blog_categories_title', 'Categorias' ) ); ?></span>
                                        <ul class="ad-sidebar-widget__list ad-sidebar-widget__list--cats">
                                            <?php foreach ( $cats as $cat ) : ?>
                                                <li>
                                                    <a href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>">
                                                        <?php echo esc_html( $cat->name ); ?>
                                                        <span class="ad-cat-count"><?php echo (int) $cat->count; ?></span>
                                                    </a>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                <?php endif; ?>

                                <!-- Recent posts -->
                                <?php
                                $recent = new WP_Query( [
                                    'posts_per_page' => 5,
                                    'post__not_in'   => [ get_the_ID() ],
                                ] );
                                if ( $recent->have_posts() ) : ?>
                                    <div class="ad-sidebar-widget">
                                        <span class="ad-sidebar-widget__title"><?php echo esc_html( astradev_t( 'single_recent_posts', 'Posts recentes' ) ); ?></span>
                                        <ul class="ad-sidebar-widget__list">
                                            <?php while ( $recent->have_posts() ) : $recent->the_post(); ?>
                                                <li>
                                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                </li>
                                            <?php endwhile; wp_reset_postdata(); ?>
                                        </ul>
                                    </div>
                                <?php endif; ?>

                            </aside><!-- .ad-content-sidebar -->

                        </div><!-- .ad-content-columns -->
                        <?php astra_entry_bottom(); ?>
                    </div><!-- .ad-post-header__inner -->
                </div><!-- .ad-content-wrap -->

            </article>

            <?php
            /* ── More posts section ───────────────────────────────── */
            $ad_more = new WP_Query( [
                'posts_per_page'      => 6,
                'post__not_in'        => [ get_the_ID() ],
                'post_status'         => 'publish',
                'ignore_sticky_posts' => true,
            ] );
            if ( $ad_more->have_posts() ) : ?>
            <section class="ad-more-posts">
                <div class="ad-post-header__inner">
                    <div class="ad-more-posts__head">
                        <h2 class="ad-more-posts__title"><?php echo esc_html( astradev_t( 'single_more_posts', 'Mais posts' ) ); ?></h2>
                        <a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>" class="pf-btn pf-btn--outline"><?php esc_html_e( 'Todos os artigos', 'astradev' ); ?> &rarr;</a>
                    </div>
                    <div class="ad-more-posts__grid">
                        <?php while ( $ad_more->have_posts() ) : $ad_more->the_post(); ?>
                            <a href="<?php the_permalink(); ?>" class="pf-post-card pf-post-card--sm">
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <div class="pf-post-card__thumb"><?php the_post_thumbnail( 'medium' ); ?></div>
                                <?php else : ?>
                                    <div class="pf-post-card__thumb pf-post-card__thumb--placeholder"><span>{ }</span></div>
                                <?php endif; ?>
                                <div class="pf-post-card__body">
                                    <?php $cats = get_the_category(); if ( $cats ) : ?>
                                        <span class="pf-post-card__cat"><?php echo esc_html( $cats[0]->name ); ?></span>
                                    <?php endif; ?>
                                    <h3 class="pf-post-card__title"><?php the_title(); ?></h3>
                                    <span class="pf-post-card__date">
                                        <?php echo esc_html( get_the_date() ); ?> &middot; <?php echo esc_html( astradev_reading_time() ); ?>
                                    </span>
                                </div>
                            </a>
                        <?php endwhile; wp_reset_postdata(); ?>
                    </div>
                </div>
            </section>
            <?php endif; ?>

        <?php endwhile; ?>

    </main>
</div><!-- #primary -->

<?php astra_primary_content_bottom(); ?>

<!-- Back to top button -->
<button id="ad-back-to-top" class="ad-back-to-top" aria-label="<?php echo esc_attr( astradev_t( 'single_back_to_top', 'Voltar ao topo' ) ); ?>">&#8679;</button>

<?php get_footer(); ?>
