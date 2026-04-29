<?php
require '/var/www/html/wp-load.php';

$active = get_option( 'active_plugins', [] );

if ( ! in_array( 'wp-mail-smtp/wp_mail_smtp.php', $active, true ) ) {
    $active[] = 'wp-mail-smtp/wp_mail_smtp.php';
}

update_option( 'active_plugins', array_values( array_unique( $active ) ) );

$options = [
    'mail' => [
        'from_email' => 'eu@gabrielstamato.com',
        'from_name' => 'Gabriel Stamato',
        'mailer' => 'smtp',
        'return_path' => true,
        'from_email_force' => true,
        'from_name_force' => false,
    ],
    'smtp' => [
        'host' => 'mail.gabrielstamato.com',
        'port' => '587',
        'encryption' => 'tls',
        'autotls' => true,
        'auth' => true,
        'user' => 'eu@gabrielstamato.com',
        'pass' => 'Ma20032002$',
    ],
    'general' => [
        'summary_report_email_disabled' => false,
    ],
];

update_option( 'wp_mail_smtp', $options );

echo "SMTP configurado para eu@gabrielstamato.com\n";
echo "Host: mail.gabrielstamato.com:587 (TLS)\n";
echo "Redirecionamento de destinatario ativo via MU-plugin (stamato7@gmail.com)\n\n";

add_action( 'wp_mail_failed', function ( $wp_error ) {
    echo 'Erro wp_mail: ' . $wp_error->get_error_message() . "\n";
} );

$ok = wp_mail(
    'destino-qualquer@exemplo.com',
    'Teste SMTP com destinatario forcado',
    'Este e-mail deve ser redirecionado para stamato7@gmail.com.'
);

echo $ok ? "Resultado: SUCESSO\n" : "Resultado: FALHA\n";
