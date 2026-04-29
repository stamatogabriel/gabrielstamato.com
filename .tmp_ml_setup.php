<?php
require __DIR__ . '/wp-load.php';

if ( ! function_exists( 'pll_set_post_language' ) ) {
    echo "Polylang indisponivel\n";
    exit(1);
}

function ad_ensure_post_translation( $source_id, $target_lang, $new_title, $new_slug = null, $new_content = null ) {
    $source = get_post( $source_id );

    if ( ! $source ) {
        return 0;
    }

    pll_set_post_language( $source_id, 'pt' );

    $translated_id = function_exists( 'pll_get_post' ) ? pll_get_post( $source_id, $target_lang ) : 0;

    $args = [
        'post_title'   => $new_title,
        'post_name'    => $new_slug ?: sanitize_title( $new_title ),
        'post_content' => $new_content !== null ? $new_content : $source->post_content,
        'post_excerpt' => $source->post_excerpt,
        'post_status'  => 'publish',
        'post_type'    => $source->post_type,
        'post_author'  => $source->post_author,
    ];

    if ( $translated_id ) {
        $args['ID'] = $translated_id;
        wp_update_post( $args );
    } else {
        $translated_id = wp_insert_post( $args );
    }

    if ( ! $translated_id || is_wp_error( $translated_id ) ) {
        return 0;
    }

    pll_set_post_language( $translated_id, $target_lang );

    $translations = function_exists( 'pll_get_post_translations' ) ? pll_get_post_translations( $source_id ) : [];
    $translations['pt'] = $source_id;
    $translations[ $target_lang ] = $translated_id;
    pll_save_post_translations( $translations );

    return (int) $translated_id;
}

$map_pages = [
    7 => [ 'Home', 'home' ],
    8 => [ 'Blog', 'blog' ],
    9 => [ 'Contact', 'contact' ],
];

$en_pages = [];

foreach ( $map_pages as $pt_id => $cfg ) {
    $en_id = ad_ensure_post_translation( $pt_id, 'en', $cfg[0], $cfg[1] );

    if ( $en_id ) {
        $en_pages[ $pt_id ] = $en_id;
        echo "Pagina traduzida: PT {$pt_id} -> EN {$en_id}\n";
    }
}

$map_posts = [
    1  => [ 'Hello World', 'hello-world' ],
    25 => [ 'Agile Culture', 'agile-culture' ],
];

foreach ( $map_posts as $pt_id => $cfg ) {
    $en_id = ad_ensure_post_translation( $pt_id, 'en', $cfg[0], $cfg[1] );

    if ( $en_id ) {
        echo "Post traduzido: PT {$pt_id} -> EN {$en_id}\n";
    }
}

$menu_pt_id = 2;
pll_set_term_language( $menu_pt_id, 'pt' );

$menu_en = wp_get_nav_menu_object( 'Main Menu EN' );

if ( ! $menu_en ) {
    $menu_en_id = wp_create_nav_menu( 'Main Menu EN' );
} else {
    $menu_en_id = (int) $menu_en->term_id;
}

pll_set_term_language( $menu_en_id, 'en' );

if ( function_exists( 'pll_save_term_translations' ) ) {
    pll_save_term_translations(
        [
            'pt' => $menu_pt_id,
            'en' => $menu_en_id,
        ]
    );
}

$existing_items = wp_get_nav_menu_items( $menu_en_id );

if ( $existing_items ) {
    foreach ( $existing_items as $item ) {
        wp_delete_post( $item->ID, true );
    }
}

$home_en    = $en_pages[7] ?? ( function_exists( 'pll_get_post' ) ? pll_get_post( 7, 'en' ) : 0 );
$blog_en    = $en_pages[8] ?? ( function_exists( 'pll_get_post' ) ? pll_get_post( 8, 'en' ) : 0 );
$contact_en = $en_pages[9] ?? ( function_exists( 'pll_get_post' ) ? pll_get_post( 9, 'en' ) : 0 );

$items_to_create = [
    [ 'title' => 'Home', 'object_id' => $home_en ],
    [ 'title' => 'Blog', 'object_id' => $blog_en ],
    [ 'title' => 'Contact', 'object_id' => $contact_en ],
];

foreach ( $items_to_create as $data ) {
    if ( empty( $data['object_id'] ) ) {
        continue;
    }

    wp_update_nav_menu_item(
        $menu_en_id,
        0,
        [
            'menu-item-title'     => $data['title'],
            'menu-item-object-id' => (int) $data['object_id'],
            'menu-item-object'    => 'page',
            'menu-item-type'      => 'post_type',
            'menu-item-status'    => 'publish',
        ]
    );
}

$mods = get_theme_mod( 'nav_menu_locations' );

if ( ! is_array( $mods ) ) {
    $mods = [];
}

$mods['primary'] = $menu_pt_id;
set_theme_mod( 'nav_menu_locations', $mods );

echo "Menu PT/EN configurados.\n";
