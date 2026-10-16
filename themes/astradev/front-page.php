<?php
/**
 * Portfolio front page for AstraDev.
 *
 * ── CUSTOMIZE YOUR PORTFOLIO BELOW ──────────────────────────
 * Edit the $pf_* variables to personalize without touching the HTML.
 *
 * @package astradev
 */
defined( 'ABSPATH' ) || exit;

/* ─── YOUR DATA — EDIT THESE ──────────────────────────────── */

$pf_role    = astradev_t( 'pf_role', 'Technical Lead & Full-Stack Developer' );
$pf_tagline = astradev_t( 'pf_tagline', 'Construo aplicações web escaláveis — do back-end robusto a interfaces modernas — liderando times e entregando software de qualidade.' );

$pf_about = [
    astradev_t( 'pf_about_1', "Sou desenvolvedor full-stack e Technical Lead com sede em Paulínia, SP. Trabalho com JavaScript, TypeScript, React, Node.js, PHP e Go — do banco de dados à interface — sempre focado em arquitetura limpa e código que escala." ),
    astradev_t( 'pf_about_2', "Apaixonado por DDD, boas práticas e open source. Quando não estou codando, estou estudando novas tecnologias ou escrevendo sobre desenvolvimento aqui no blog." ),
]; // EDIT

$pf_skills = [
    'Front-end' => [ 'JavaScript', 'TypeScript', 'React', 'Vue.js', 'Next.js', 'HTML5', 'CSS3' ],
    'Back-end'  => [ 'Node.js', 'PHP', 'Go', 'NestJS', 'AdonisJS', 'Express', 'REST API' ],
    'Banco de Dados' => [ 'PostgreSQL', 'MySQL', 'MongoDB' ],
    'Mobile'    => [ 'React Native' ],
    'DevOps'    => [ 'Docker', 'Linux', 'Git', 'GitHub Actions', 'Nginx' ],
];

$pf_projects = [
    [
        'title'       => 'BossaBox — Tech Lead',
        'description' => 'Liderança técnica com foco em arquitetura de backend e qualidade de engenharia, construindo plataformas web do zero, do desenho do domínio à produção. Padrões arquiteturais viram guardrails automatizados (CI, hooks, testes, cobertura, regras de dependência), e a IA entra no fluxo de desenvolvimento com instruções por repositório, skills e agentes revisores de código.',
        'tags'        => [ 'Java', 'Spring Boot', 'PostgreSQL', 'Vue.js', 'Nuxt', 'TypeScript', 'AWS', 'Liderança' ],
        'url'         => 'https://www.linkedin.com/in/gabriel-henrique-stamato-a5497780/',
        'repo'        => '#',
        'period'      => 'fev/2026 – atual',
    ],
    [
        'title'       => 'Futura Markets — Full Stack Developer',
        'description' => 'Freelance em produtos digitais, serviços backend e sistemas internos de automação: features full-stack, integrações, APIs e robôs de automação em Python para processos repetitivos e tratamento de dados.',
        'tags'        => [ 'TypeScript', 'Node.js', 'React', 'Python', 'Automação', 'SQL' ],
        'url'         => 'https://www.linkedin.com/in/gabriel-henrique-stamato-a5497780/',
        'repo'        => '#',
        'period'      => 'nov/2025 – mai/2026',
    ],
    [
        'title'       => 'Advanced Corretora — Technical Lead',
        'description' => 'Liderei a transformação digital da corretora: site institucional, plataforma de câmbio online e interface entre time técnico e negócio. Gerenciei pipelines CI/CD, infraestrutura AWS e times de desenvolvimento.',
        'tags'        => [ 'NestJS', 'Next.js', 'ReactJS', 'MongoDB', 'AWS', 'Terraform', 'Amazon ECS', 'Liderança' ],
        'url'         => 'https://www.linkedin.com/in/gabriel-henrique-stamato-a5497780/',
        'repo'        => '#',
        'period'      => 'out/2020 – jan/2026',
    ],
    [
        'title'       => 'Direção Concursos — Technical Lead / Fullstack',
        'description' => 'Tech Lead no time de aquisição: e-commerce, SEO, microsserviços AWS, sistema de pagamentos e player de vídeos. Responsável pela arquitetura e liderança técnica do squad.',
        'tags'        => [ 'React.js', 'NestJS', 'Node.js', 'Amazon ECS', 'Amazon SQS', 'Redux.js', 'Liderança' ],
        'url'         => 'https://www.linkedin.com/in/gabriel-henrique-stamato-a5497780/',
        'repo'        => '#',
        'period'      => 'set/2021 – out/2023',
    ],
    [
        'title'       => 'BossaBox / Me Poupe — Tech Lead Fullstack',
        'description' => 'Desenvolvimento da plataforma SOS Me Poupe (marketplace de anúncios) como freelancer. Liderança técnica, devOps, pipelines AWS e arquitetura com NestJS e VueJS.',
        'tags'        => [ 'NestJS', 'Vue.js', 'TypeScript', 'AWS', 'Docker', 'Jenkins', 'Amazon ECS', 'Terraform' ],
        'url'         => 'https://www.linkedin.com/in/gabriel-henrique-stamato-a5497780/',
        'repo'        => '#',
        'period'      => 'out/2019 – fev/2023',
    ],
    [
        'title'       => 'Advanced Corretora — Full Stack Engineer',
        'description' => 'Concepção e implementação de produtos digitais do zero. Construção de APIs com Node.js/NestJS e interfaces com Next.js/React, TypeScript, com foco em performance e SEO.',
        'tags'        => [ 'Node.js', 'NestJS', 'Next.js', 'React.js', 'TypeScript', 'MongoDB', 'PostgreSQL', 'AWS' ],
        'url'         => 'https://www.linkedin.com/in/gabriel-henrique-stamato-a5497780/',
        'repo'        => '#',
        'period'      => 'out/2019 – out/2020',
    ],
    [
        'title'       => 'BossaBox / Árvore Educação — Fullstack Developer',
        'description' => 'Frontend web e mobile para plataforma de incentivo à leitura. Desenvolvimento de novas features e internacionalização do produto.',
        'tags'        => [ 'React.js', 'React Native', 'TypeScript', 'JavaScript', 'CSS' ],
        'url'         => 'https://www.linkedin.com/in/gabriel-henrique-stamato-a5497780/',
        'repo'        => '#',
        'period'      => 'out/2023 – abr/2024',
    ],
    [
        'title'       => 'Certsys — Technical Lead | Full-Stack Developer',
        'description' => 'Atuação como Technical Lead e desenvolvedor full-stack, liderando o time de engenharia e entregando soluções de software de alta qualidade.',
        'tags'        => [ 'Full-Stack', 'Liderança Técnica', 'JavaScript', 'Node.js' ],
        'url'         => 'https://www.linkedin.com/in/gabriel-henrique-stamato-a5497780/',
        'repo'        => '#',
        'period'      => 'jun/2020 – set/2021',
    ],
];

$pf_portfolio = [
    [
        'title'       => 'AesthetIQ',
        'description' => 'Plataforma SaaS que gera prévias fotorrealistas com IA para procedimentos de harmonização orofacial. Inclui relatórios comerciais, histórico por paciente, gestão de clínicas com permissões por perfil e conformidade com a LGPD.',
        'tags'        => [ 'Next.js', 'IA Generativa', 'SaaS', 'JWT', 'LGPD' ],
        'url'         => 'https://www.aesthetiqapp.com/',
        'image'       => 'aesthetiq.jpg',
        'period'      => 'Freelance',
    ],
    [
        'title'       => 'Quem de Nós?',
        'description' => 'Jogo de perguntas multiplayer no navegador para casais, amigos e família, de 2 a 20 pessoas. Salas por link, QR code ou código, modo TV e seis modos de jogo. Ninguém precisa instalar nada para jogar.',
        'tags'        => [ 'Next.js', 'Multiplayer', 'Tempo real', 'Web' ],
        'url'         => 'https://quemdenos.com/',
        'image'       => 'quemdenos.jpg',
        'period'      => 'Projeto pessoal',
    ],
    [
        'title'       => 'MalaCheck',
        'description' => 'App para iPhone que gera a lista da mala em 1 minuto a partir do destino, das datas e das atividades. Funciona offline, explica cada item e aprende com as viagens anteriores.',
        'tags'        => [ 'iOS', 'Mobile', 'Offline-first', 'Assinaturas' ],
        'url'         => 'https://malacheck.pandoratechsolutions.com/',
        'image'       => 'malacheck.jpg',
        'period'      => 'Projeto pessoal',
    ],
];

$pf_social = [
    'GitHub'   => 'https://github.com/stamatogabriel',
    'LinkedIn' => 'https://www.linkedin.com/in/gabriel-henrique-stamato-a5497780/',
];

$pf_github_username = 'stamatogabriel';

/* ─── Derived values (no need to edit) ───────────────────── */
$site_name   = get_bloginfo( 'name' );
$admin_email = get_option( 'admin_email' );
$contact_url = home_url( '/contact/' );
$blog_url    = home_url( '/blog/' );

$pf_page_content = get_post_field( 'post_content', get_queried_object_id() );

$pf_render_card = function ( $project, $i ) {
    ?>
    <div class="pf-project-card">
        <?php if ( ! empty( $project['image'] ) ) : ?>
            <a class="pf-project-card__shot" href="<?php echo esc_url( $project['url'] ); ?>" target="_blank" rel="noopener noreferrer" tabindex="-1" aria-hidden="true">
                <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/img/portfolio/' . $project['image'] ); ?>" alt="" width="1280" height="800" loading="lazy" decoding="async" />
            </a>
        <?php endif; ?>
        <span class="pf-project-card__num">0<?php echo ( $i + 1 ); ?></span>
        <h3 class="pf-project-card__title"><?php echo esc_html( $project['title'] ); ?></h3>
        <?php if ( ! empty( $project['period'] ) ) : ?>
            <span class="pf-project-card__period"><?php echo esc_html( $project['period'] ); ?></span>
        <?php endif; ?>
        <p class="pf-project-card__desc"><?php echo esc_html( $project['description'] ); ?></p>

        <div class="pf-project-card__tags">
            <?php foreach ( $project['tags'] as $tag ) : ?>
                <span class="ad-badge"><?php echo esc_html( $tag ); ?></span>
            <?php endforeach; ?>
        </div>

        <div class="pf-project-card__links">
            <?php if ( ! empty( $project['url'] ) && '#' !== $project['url'] ) : ?>
                <a class="pf-card-link" href="<?php echo esc_url( $project['url'] ); ?>" target="_blank" rel="noopener noreferrer">
                    Live &#8599;
                </a>
            <?php endif; ?>
            <?php if ( ! empty( $project['repo'] ) && '#' !== $project['repo'] ) : ?>
                <a class="pf-card-link" href="<?php echo esc_url( $project['repo'] ); ?>" target="_blank" rel="noopener noreferrer">
                    Source
                </a>
            <?php endif; ?>
        </div>
    </div>
    <?php
};

get_header();
?>

<!-- ═══════════════════════════════════════════════════════════
     HERO
════════════════════════════════════════════════════════════ -->
<section class="pf-hero" id="home">
    <div class="ast-container">
        <div class="pf-hero__inner">

            <!-- Text column -->
            <div class="pf-hero__text">
                <span class="pf-hero__greeting">Olá, sou</span>
                <h1 class="pf-hero__name"><?php echo esc_html( $site_name ); ?></h1>
                <p class="pf-hero__role"><?php echo esc_html( $pf_role ); ?></p>
                <p class="pf-hero__bio"><?php echo esc_html( $pf_tagline ); ?></p>

                <div class="pf-hero__cta">
                    <a href="#projects" class="pf-btn pf-btn--primary"><?php echo esc_html( astradev_t( 'pf_hero_btn_primary', 'Ver Experiências' ) ); ?></a>
                    <a href="<?php echo esc_url( $contact_url ); ?>" class="pf-btn pf-btn--outline"><?php echo esc_html( astradev_t( 'pf_hero_btn_contact', 'Fale Comigo' ) ); ?></a>
                </div>

                <div style="display:flex;gap:.45rem;flex-wrap:wrap;">
                    <?php foreach ( $pf_social as $label => $url ) : ?>
                        <a href="<?php echo esc_url( $url ); ?>" target="_blank" rel="noopener noreferrer" class="pf-social-link">
                            <?php echo esc_html( $label ); ?>
                        </a>
                    <?php endforeach; ?>
                    <a href="mailto:<?php echo esc_attr( $admin_email ); ?>" class="pf-social-link">Email</a>
                </div>
            </div>

            <!-- Terminal visual -->
            <div class="pf-hero__visual">
                <div class="pf-terminal">
                    <div class="pf-terminal__bar">
                        <span class="pf-terminal__dot"></span>
                        <span class="pf-terminal__dot"></span>
                        <span class="pf-terminal__dot"></span>
                        <span class="pf-terminal__filename">portfolio.config.js</span>
                    </div>
                    <pre class="pf-terminal__code"><span class="t-comment">// stamatogabriel — Technical Lead</span>
<span class="t-key">const</span> dev = {
  <span class="t-prop">name</span>:      <span class="t-string">"<?php echo esc_html( $site_name ); ?>"</span>,
  <span class="t-prop">location</span>:  <span class="t-string">"Paulínia, SP — Brasil"</span>,
  <span class="t-prop">stack</span>:     [
    <span class="t-string">"TypeScript"</span>, <span class="t-string">"React"</span>,
    <span class="t-string">"Node.js"</span>, <span class="t-string">"Go"</span>,
    <span class="t-string">"PHP"</span>, <span class="t-string">"Docker"</span>,
  ],
  <span class="t-prop">available</span>: <span class="t-bool">true</span>,
  <span class="t-prop">hire</span>:      <span class="t-fn">() =&gt;</span> contact(),
};</pre>
                </div>
            </div>

        </div>
    </div>
</section>

<?php if ( ! empty( trim( wp_strip_all_tags( $pf_page_content ) ) ) ) : ?>
<section class="pf-section pf-editor-section" id="page-content">
    <div class="ast-container">
        <div class="pf-editor-content entry-content">
            <?php echo apply_filters( 'the_content', $pf_page_content ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- ═══════════════════════════════════════════════════════════
     ABOUT
════════════════════════════════════════════════════════════ -->
<section class="pf-section pf-section--alt" id="about">
    <div class="ast-container">
        <div class="pf-about__inner">

            <div class="pf-about__avatar-wrap">
                <img
                    src="<?php echo esc_url( 'https://github.com/' . $pf_github_username . '.png?size=360' ); ?>"
                    alt="<?php echo esc_attr( $site_name ); ?>"
                    class="pf-about__avatar"
                    width="180"
                    height="180"
                    loading="lazy"
                    decoding="async"
                />
            </div>

            <div class="pf-about__content">
                <span class="pf-section__eyebrow">Sobre mim</span>
                <h2 class="pf-section__title" style="text-align:left;"><?php echo esc_html( astradev_t( 'pf_about_title', 'Quem sou eu' ) ); ?></h2>
                <?php foreach ( $pf_about as $para ) : ?>
                    <p><?php echo esc_html( $para ); ?></p>
                <?php endforeach; ?>

                <div class="pf-about__links">
                    <a href="#projects" class="pf-btn pf-btn--primary">Ver experiências</a>
                    <?php foreach ( $pf_social as $label => $url ) : ?>
                        <a href="<?php echo esc_url( $url ); ?>" target="_blank" rel="noopener noreferrer" class="pf-btn pf-btn--outline">
                            <?php echo esc_html( $label ); ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════════════════════
     SKILLS
════════════════════════════════════════════════════════════ -->
<section class="pf-section" id="skills">
    <div class="ast-container">
        <div class="pf-section__header">
            <span class="pf-section__eyebrow">Tech Stack</span>
            <h2 class="pf-section__title">Habilidades &amp; Ferramentas</h2>
            <p class="pf-section__subtitle">As tecnologias com as quais trabalho no dia a dia, agrupadas por área.</p>
        </div>

        <div class="pf-skills__groups">
            <?php foreach ( $pf_skills as $category => $skills ) : ?>
                <div class="pf-skills__group">
                    <span class="pf-skills__category"><?php echo esc_html( $category ); ?></span>
                    <div class="pf-skills__list">
                        <?php foreach ( $skills as $skill ) : ?>
                            <span class="pf-skill-badge"><?php echo esc_html( $skill ); ?></span>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════════════════════
     PROJECTS
════════════════════════════════════════════════════════════ -->
<section class="pf-section pf-section--alt" id="projects">
    <div class="ast-container">
        <div class="pf-section__header">
            <span class="pf-section__eyebrow">Experiência</span>
            <h2 class="pf-section__title">Experiência Profissional</h2>
            <p class="pf-section__subtitle">Empresas e projetos onde atuei como desenvolvedor e líder técnico.</p>
        </div>

        <div class="pf-projects__grid">
            <?php foreach ( $pf_projects as $i => $project ) { $pf_render_card( $project, $i ); } ?>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════════════════════
     PORTFOLIO
════════════════════════════════════════════════════════════ -->
<section class="pf-section" id="portfolio">
    <div class="ast-container">
        <div class="pf-section__header">
            <span class="pf-section__eyebrow">Portfólio</span>
            <h2 class="pf-section__title">Projetos</h2>
            <p class="pf-section__subtitle">Produtos que construí como freelancer e projetos pessoais no ar.</p>
        </div>

        <div class="pf-projects__grid">
            <?php foreach ( $pf_portfolio as $i => $project ) { $pf_render_card( $project, $i ); } ?>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════════════════════
     LATEST BLOG POSTS
════════════════════════════════════════════════════════════ -->
<?php
$recent_query = new WP_Query( [
    'posts_per_page'      => 6,
    'post_status'         => 'publish',
    'ignore_sticky_posts' => true,
] );
if ( $recent_query->have_posts() ) :
?>
<section class="pf-section pf-section--alt" id="blog">
    <div class="ast-container">
        <div class="pf-section__header">
            <span class="pf-section__eyebrow">Blog</span>
            <h2 class="pf-section__title">Últimos Artigos</h2>
            <p class="pf-section__subtitle">Reflexões sobre software, ferramentas e o que estou aprendendo no caminho.</p>
        </div>

        <div class="pf-blog__grid">
            <?php while ( $recent_query->have_posts() ) : $recent_query->the_post(); ?>
                <a href="<?php the_permalink(); ?>" class="pf-post-card">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="pf-post-card__thumb"><?php the_post_thumbnail( 'medium_large' ); ?></div>
                    <?php else : ?>
                        <div class="pf-post-card__thumb pf-post-card__thumb--placeholder"><span>{ }</span></div>
                    <?php endif; ?>

                    <div class="pf-post-card__body">
                        <?php $cats = get_the_category(); ?>
                        <?php if ( $cats ) : ?>
                            <span class="pf-post-card__cat"><?php echo esc_html( $cats[0]->name ); ?></span>
                        <?php endif; ?>
                        <h3 class="pf-post-card__title"><?php the_title(); ?></h3>
                        <p class="pf-post-card__excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 18, '&hellip;' ) ); ?></p>
                        <span class="pf-post-card__date">
                            <?php echo esc_html( get_the_date() ); ?> &middot; <?php echo esc_html( astradev_reading_time() ); ?>
                        </span>
                    </div>
                </a>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>

        <div class="pf-blog__footer">
            <a href="<?php echo esc_url( $blog_url ); ?>" class="pf-btn pf-btn--outline">Todos os artigos &rarr;</a>
        </div>
    </div>
</section>
<?php endif; ?>

<?php get_footer(); ?>
