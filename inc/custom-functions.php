<?php

/*
 * 
 * Fonctions spécifiques pour le site
 * 
 */


// Ajouter les nouveaux CPT au flux RSS

function myfeed_request($qv) {
	if (isset($qv['feed']) && !isset($qv['post_type']))
		$qv['post_type'] = array('post', 'offres');
	return $qv;
}
add_filter('request', 'myfeed_request');

// Retirer des onglets du menu du back-office

function remove_admin_items() {
    remove_menu_page( 'edit-comments.php' );
	remove_menu_page( 'edit.php' );
}

add_action( 'admin_menu', 'remove_admin_items', 999 );

// Reorder back office admin menu

function reorder_admin_menu( $__return_true ) {
    return array(
        'index.php', // Dashboard
		'edit.php', // Posts
		'edit.php?post_type=offres', // Offres 
		'edit.php?post_type=partenaires', // Partenaires 
        'edit.php?post_type=page', // Pages 
        'upload.php', // Media
   );
}
add_filter( 'custom_menu_order', 'reorder_admin_menu' );
add_filter( 'menu_order', 'reorder_admin_menu' );

