<?php
/**
 * Contact page template for AstraDev.
 * Automatically applied to any page with slug "contact".
 *
 * ── EDIT YOUR CONTACT INFO ────────────────────────────────
 * Update the $contact_info array below.
 *
 * NOTE: wp_mail() requires a configured mail server or plugin
 * (e.g. WP Mail SMTP). Without it, messages won't be delivered.
 *
 * @package astradev
 */
defined( 'ABSPATH' ) || exit;

/* ─── Form processing — MUST run before any HTML output ─── */
$contact_vals  = [ 'name' => '', 'email' => '', 'subject' => '', 'message' => '' ];
$contact_error = false;
$contact_sent  = isset( $_GET['status'] ) && 'sent' === sanitize_key( $_GET['status'] );
$contact_fail  = isset( $_GET['status'] ) && 'mailfail' === sanitize_key( $_GET['status'] );

if ( 'POST' === $_SERVER['REQUEST_METHOD'] && isset( $_POST['ad_contact_submitted'] ) ) {

    if ( ! isset( $_POST['_wpnonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['_wpnonce'] ) ), 'ad_contact_form' ) ) {
        wp_die( esc_html__( 'Falha na verificacao de seguranca. Volte e tente novamente.', 'astradev' ), '', [ 'response' => 403 ] );
    }

    $contact_vals = [
        'name'    => sanitize_text_field( wp_unslash( $_POST['contact_name']    ?? '' ) ),
        'email'   => sanitize_email( wp_unslash( $_POST['contact_email']        ?? '' ) ),
        'subject' => sanitize_text_field( wp_unslash( $_POST['contact_subject'] ?? '' ) ),
        'message' => sanitize_textarea_field( wp_unslash( $_POST['contact_message'] ?? '' ) ),
    ];

    $valid = $contact_vals['name']
        && is_email( $contact_vals['email'] )
        && $contact_vals['subject']
        && strlen( $contact_vals['message'] ) >= 10;

    if ( ! $valid ) {
        $contact_error = true;
        // Fall through — re-render template with preserved values and error message
    } else {
        $to      = get_option( 'admin_email' );
        $headers = [
            'Content-Type: text/plain; charset=UTF-8',
            'Reply-To: ' . $contact_vals['name'] . ' <' . $contact_vals['email'] . '>',
        ];
        $body = sprintf(
            "Nome: %s\nE-mail: %s\n\n%s",
            $contact_vals['name'],
            $contact_vals['email'],
            $contact_vals['message']
        );
        $sent = wp_mail( $to, '[Contato do Portfolio] ' . $contact_vals['subject'], $body, $headers );

        $base_url = esc_url_raw(
            home_url( wp_parse_url( wp_unslash( $_SERVER['REQUEST_URI'] ), PHP_URL_PATH ) )
        );
        wp_redirect( add_query_arg( 'status', $sent ? 'sent' : 'mailfail', $base_url ), 303 );
        exit;
    }
}

/* ─── EDIT YOUR CONTACT INFO ──────────────────────────────── */
$contact_info = [
    [
        'label' => 'Email',
        'value' => get_option( 'admin_email' ),
        'href'  => 'mailto:' . get_option( 'admin_email' ),
        'icon'  => '&#9993;',
    ],
    [
        'label' => 'GitHub',
        'value' => 'github.com/stamatogabriel',
        'href'  => 'https://github.com/stamatogabriel',
        'icon'  => '&#9670;',
    ],
    [
        'label' => 'LinkedIn',
        'value' => 'linkedin.com/in/gabriel-henrique-stamato',
        'href'  => 'https://www.linkedin.com/in/gabriel-henrique-stamato-a5497780/',
        'icon'  => 'in',
    ],
    [
        'label' => 'Localizacao',
        'value' => 'Paulínia, SP — Brasil',
        'href'  => false,
        'icon'  => '&#9737;',
    ],
]; // EDIT

$contact_page_content = get_post_field( 'post_content', get_queried_object_id() );

get_header();
?>

<!-- ── Hero ─────────────────────────────────────────────────── -->
<div class="pf-contact-hero">
    <div class="ad-post-header__inner">
        <span class="pf-section__eyebrow"><?php echo esc_html( astradev_t( 'pf_contact_eyebrow', 'Contato' ) ); ?></span>
        <h1 class="pf-section__title"><?php echo esc_html( astradev_t( 'pf_contact_title', 'Vamos Conversar' ) ); ?></h1>
        <p class="pf-section__subtitle">
            <?php echo esc_html( astradev_t( 'pf_contact_subtitle_1', 'Tem um projeto em mente, alguma duvida ou quer trocar uma ideia?' ) ); ?><br>
            <?php echo esc_html( astradev_t( 'pf_contact_subtitle_2', 'Normalmente respondo em ate 24 horas.' ) ); ?>
        </p>
    </div>
</div>

<?php if ( ! empty( trim( wp_strip_all_tags( $contact_page_content ) ) ) ) : ?>
<section class="pf-section pf-editor-section pf-contact-editor-section" id="contact-page-content">
    <div class="ad-post-header__inner">
        <div class="pf-editor-content entry-content">
            <?php echo apply_filters( 'the_content', $contact_page_content ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- ── Contact body ──────────────────────────────────────────── -->
<div class="pf-contact-body">
    <div class="ad-post-header__inner">
        <div class="pf-contact-grid">

            <!-- ── Form column ─────────────────────────────── -->
            <div>
                <?php if ( $contact_sent ) : ?>
                    <div class="pf-alert pf-alert--success">
                        <strong><?php esc_html_e( 'Mensagem enviada!', 'astradev' ); ?></strong>
                        <?php esc_html_e( ' Obrigado pelo contato. Retorno em breve.', 'astradev' ); ?>
                    </div>
                <?php elseif ( $contact_fail ) : ?>
                    <div class="pf-alert pf-alert--error">
                        <strong><?php esc_html_e( 'Falha no envio.', 'astradev' ); ?></strong>
                        <?php esc_html_e( ' O servidor nao conseguiu enviar o e-mail. Entre em contato direto comigo.', 'astradev' ); ?>
                    </div>
                <?php elseif ( $contact_error ) : ?>
                    <div class="pf-alert pf-alert--error">
                        <strong><?php esc_html_e( 'Ops!', 'astradev' ); ?></strong>
                        <?php esc_html_e( ' Preencha todos os campos corretamente (e-mail valido e mensagem com no minimo 10 caracteres).', 'astradev' ); ?>
                    </div>
                <?php endif; ?>

                <form method="post"
                      action="<?php echo esc_url( get_permalink() ); ?>"
                      class="pf-contact-form"
                      novalidate>

                    <?php wp_nonce_field( 'ad_contact_form' ); ?>
                    <input type="hidden" name="ad_contact_submitted" value="1">

                    <div class="form-row">
                        <div class="form-group">
                            <label for="contact_name"><?php esc_html_e( 'Nome', 'astradev' ); ?> *</label>
                            <input type="text"
                                   id="contact_name"
                                   name="contact_name"
                                   value="<?php echo esc_attr( $contact_vals['name'] ); ?>"
                                   placeholder="<?php esc_attr_e( 'Seu nome', 'astradev' ); ?>"
                                   required
                                   maxlength="100">
                        </div>
                        <div class="form-group">
                            <label for="contact_email"><?php esc_html_e( 'E-mail', 'astradev' ); ?> *</label>
                            <input type="email"
                                   id="contact_email"
                                   name="contact_email"
                                   value="<?php echo esc_attr( $contact_vals['email'] ); ?>"
                                   placeholder="<?php esc_attr_e( 'seu@email.com', 'astradev' ); ?>"
                                   required
                                   maxlength="200">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="contact_subject"><?php esc_html_e( 'Assunto', 'astradev' ); ?> *</label>
                        <input type="text"
                               id="contact_subject"
                               name="contact_subject"
                               value="<?php echo esc_attr( $contact_vals['subject'] ); ?>"
                               placeholder="<?php esc_attr_e( 'Sobre o que voce quer falar?', 'astradev' ); ?>"
                               required
                               maxlength="200">
                    </div>

                    <div class="form-group">
                        <label for="contact_message"><?php esc_html_e( 'Mensagem', 'astradev' ); ?> *</label>
                        <textarea id="contact_message"
                                  name="contact_message"
                                  placeholder="<?php esc_attr_e( 'Me conte mais...', 'astradev' ); ?>"
                                  required
                                  minlength="10"
                                  rows="6"><?php echo esc_textarea( $contact_vals['message'] ); ?></textarea>
                    </div>

                    <button type="submit" class="pf-btn pf-btn--primary">
                        <?php esc_html_e( 'Enviar Mensagem', 'astradev' ); ?> &rarr;
                    </button>

                </form>
            </div>

            <!-- ── Info column ─────────────────────────────── -->
            <div class="pf-contact-info-col">
                <?php foreach ( $contact_info as $info ) : ?>
                    <?php
                    $is_external = $info['href'] && strpos( $info['href'], 'mailto:' ) === false;
                    $tag         = $info['href'] ? 'a' : 'div';
                    $attrs       = '';
                    if ( $info['href'] ) {
                        $attrs .= ' href="' . esc_url( $info['href'] ) . '"';
                        if ( $is_external ) {
                            $attrs .= ' target="_blank" rel="noopener noreferrer"';
                        }
                    }
                    ?>
                    <<?php echo $tag; ?><?php echo $attrs; ?> class="pf-info-card">
                        <div class="pf-info-card__icon" aria-hidden="true"><?php echo wp_kses_post( $info['icon'] ); ?></div>
                        <div class="pf-info-card__body">
                            <span class="pf-info-card__label"><?php echo esc_html( $info['label'] ); ?></span>
                            <span class="pf-info-card__value"><?php echo esc_html( $info['value'] ); ?></span>
                        </div>
                    </<?php echo $tag; ?>>
                <?php endforeach; ?>
            </div>

        </div>
    </div>
</div>

<?php get_footer(); ?>
