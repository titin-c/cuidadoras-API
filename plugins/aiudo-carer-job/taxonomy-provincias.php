<?php

if ( ! function_exists( 'add_provincias_taxonomy' ) ) {

    function add_provincias_taxonomy() {

        /**
         * Taxonomy: Provincias.
         */
    
        $labels = [
            "name" => esc_html__( "Provincias", "aiudo-carer-job" ),
            "singular_name" => esc_html__( "Provincia", "aiudo-carer-job" ),
        ];
    
        
        $args = [
            "label" => esc_html__( "Provincias", "aiudo-carer-job" ),
            "labels" => $labels,
            "public" => true,
            "publicly_queryable" => true,
            "hierarchical" => false,
            "show_ui" => true,
            "show_in_menu" => true,
            "show_in_nav_menus" => true,
            "query_var" => true,
            "rewrite" => [
                'slug' => 'trabajos-de-cuidadora-de-ancianos-en',
                'with_front' => true,
            ],
            "show_admin_column" => true,
            "show_in_rest" => true,
            "show_tagcloud" => false,
            "rest_base" => "provincias",
            "rest_controller_class" => "WP_REST_Terms_Controller",
            "rest_namespace" => "api/v1",
            "show_in_quick_edit" => true,
            "sort" => true,
            "show_in_graphql" => true,
        ];
        register_taxonomy( "provincias", [ "aiudocarerjob" ], $args );
    }
    add_action( 'init', 'add_provincias_taxonomy' );
    
    }