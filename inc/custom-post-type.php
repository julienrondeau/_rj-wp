<?php
/**
 * Custom Post Type Example
 * This page walks you through creating
 * a custom post type and taxonomies.
 *
 * You should copy this to a new file to
 * create your custom type.
 *
 * Make sure to include it in functions.php
 */

/*
 * Custom Post Types
 */

// Ajout d'un Custom Post Type - Offres //

add_action('init', 'register_kilic_post_types');

function register_kilic_post_types() {

   register_post_type( 'offres',
	 	// let's now add all the options for this post type
		array(
			'labels' => array(
				'name'               => __( 'Recrutement', '_rj' ),                   // This is the Title of the Group
				'singular_name'      => __( 'Recrutement', '_rj' ),                    // This is the individual type
				'all_items'          => __( 'Toutes les Offres', '_rj' ),               // the all items menu item
				'add_new'            => __( 'Ajouter', '_rj' ),                        // The add new menu item
				'add_new_item'       => __( 'Ajouter une Offre', '_rj' ),            // Add New Display Title
				'edit'               => __( 'Modifier', '_rj' ),                           // Edit Dialog
				'edit_item'          => __( 'Modifier l\'Offre', '_rj' ),                // Edit Display Title
				'new_item'           => __( 'Nouvelle Offre', '_rj' ),                  // New Display Title
				'view_item'          => __( 'Voir l\'Offre', '_rj' ),                 // View Display Title
				'search_items'       => __( 'Rechercher une Offre', '_rj' ),               // Search Custom Type Title
				'not_found'          => __( 'Aucune offre.', '_rj' ), // This displays if there are no entries yet
				'not_found_in_trash' => __( 'Aucune offre dans la corbeille', '_rj' ),         // This displays if there is nothing in the trash
				'parent_item_colon'  => ''
			),
			//'description'         => __( 'This is the example custom post type', '_rj' ), // Custom Type Description
			'public'              => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'show_ui'             => true,
			'menu_position'       => 5,                       // where CPT appars in primary admin menu
			'menu_icon'           => get_stylesheet_directory_uri() . '/images/admin-offres.png',   // icon for CPT 
			'capability_type'     => 'post',
			'hierarchical'        => false,
			'has_archive'         => 'Offres',           // you can rename the archive slug here
			'rewrite'	          => false,
			'query_var'           => true,

			// the next one is important, it tells what's enabled in the post editor
			'supports'            => array( 'title',  'editor', 'thumbnail', 'revisions', 'sticky' ),
			
			// register taxonomies for CPT, edit if new CT's defined above
			'taxonomies'          => array( 'Offres_cat', 'Offres_tags')
	 	)
	); /* end of register post type */
   
   /**
	 * Register Custom Taxonomies
	 * http://codex.wordpress.org/Function_Reference/register_taxonomy
	 */

// Catégories personnalisées pour les Offres
   
	register_taxonomy( 'offres_cat',
		array( 'offres' ),  // CPT handle defined above
		array(
			'hierarchical' => true, // if this is true, it acts like categories
			'labels' => array(
				'name'              => __( 'Types d\'Offres', '_rj' ),        // name of the custom taxonomy
				'singular_name'     => __( 'Type d\'Offres', '_rj' ),          // single taxonomy name
				'search_items'      => __( 'Rechercher un Type d\'Offres', '_rj' ), // search title for taxomony
				'all_items'         => __( 'Tous les Types d\'Offres', '_rj' ),    // all title for taxonomies
				'parent_item'       => __( 'Type d\'Offres Parent', '_rj' ),   // parent title for taxonomy
				'parent_item_colon' => __( 'Type d\'Offres Parent :', '_rj' ),  // parent taxonomy title
				'edit_item'         => __( 'Modifier le Type d\'Offres', '_rj' ),     // edit custom taxonomy title
				'update_item'       => __( 'Mettre à jour le Type d\'Offres', '_rj' ),   // update title for taxonomy
				'add_new_item'      => __( 'Ajouter un Type d\'Offres', '_rj' ),  // add new title for taxonomy
				'new_item_name'     => __( 'Nom du Type d\'Offres', '_rj' )  // name title for taxonomy
			),
			'show_admin_column' => true,
			'show_ui'           => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => __( 'recrutement', '_rj' ) )
		)
	);

// Tags personnalisés pour les Offres
	
	register_taxonomy( 'offres_tags',
		array( 'offres' ),   // CPT handle defined above
		array(
			'hierarchical' => false, // if this is false, it acts like tags
			'labels' => array(
				'name'              => __( 'Tags', '_rj' ),        // name of the custom taxonomy
				'singular_name'     => __( 'Tag', '_rj' ),         // single taxonomy name
				'search_items'      => __( 'Search Tags', '_rj' ), // search title for taxomony
				'all_items'         => __( 'All Tags', '_rj' ),    // all title for taxonomies
				'parent_item'       => __( 'Parent Tag', '_rj' ),  // parent title for taxonomy
				'parent_item_colon' => __( 'Parent Tag:', 'v' ), // parent taxonomy title
				'edit_item'         => __( 'Edit Tag', '_rj' ),    // edit custom taxonomy title
				'update_item'       => __( 'Update Tag', '_rj' ),  // update title for taxonomy
				'add_new_item'      => __( 'Add New Tag', '_rj' ), // add new title for taxonomy
				'new_item_name'     => __( 'New Tag Name', '_rj' ) // name title for taxonomy
			),
			'show_admin_column' => true,
			'show_ui'           => true,
			'query_var'         => true
		)
	);


/// Ajout d'un Custom Post Type - Partenaires

   register_post_type( 'Partenaires',
	 	// let's now add all the options for this post type
		array(
			'labels' => array(
				'name'               => __( 'Partenaires', '_rj' ),                   // This is the Title of the Group
				'singular_name'      => __( 'Partenaire', '_rj' ),                    // This is the individual type
				'all_items'          => __( 'Tous les partenaires', '_rj' ),               // the all items menu item
				'add_new'            => __( 'Ajouter', '_rj' ),                        // The add new menu item
				'add_new_item'       => __( 'Ajouter un partenaire', '_rj' ),            // Add New Display Title
				'edit'               => __( 'Modifier', '_rj' ),                           // Edit Dialog
				'edit_item'          => __( 'Modifier le partenaire', '_rj' ),                // Edit Display Title
				'new_item'           => __( 'Nouveau partenaire', '_rj' ),                  // New Display Title
				'view_item'          => __( 'Voir le partenaire', '_rj' ),                 // View Display Title
				'search_items'       => __( 'Rechercher un partenaire', '_rj' ),               // Search Custom Type Title
				'not_found'          => __( 'Aucun partenaire.', '_rj' ), // This displays if there are no entries yet
				'not_found_in_trash' => __( 'Aucun partenaire dans la corbeille', '_rj' ),         // This displays if there is nothing in the trash
				'parent_item_colon'  => ''
			),
			//'description'         => __( 'This is the example custom post type', '_rj' ), // Custom Type Description
			'public'              => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'show_ui'             => true,
			'menu_position'       => 5,                       // where CPT appars in primary admin menu
			'menu_icon'           => get_stylesheet_directory_uri() . '/images/admin-partenaire.png',   // icon for CPT 
			'capability_type'     => 'post',
			'hierarchical'        => false,
			'has_archive'         => 'Partenaires',           // you can rename the archive slug here
			'rewrite'	          => array(
				'slug' => __( 'partenaires', '_rj' ), // you can specify the url slug
				'with_front' => false
			),
			'query_var'           => true,

			// the next one is important, it tells what's enabled in the post editor
			'supports'            => array( 'title',  'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'sticky' )
	 	)
	); /* end of register post type */

}