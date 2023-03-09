<?php

// funcion para hacer console logs
function console_log($output, $with_script_tags = true)
{
    $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) .
        ');';
    if ($with_script_tags) {
        $js_code = '<script>' . $js_code . '</script>';
    }
    echo $js_code;
}


// Datos enriquecidos de oferta de empleo, se añade al HEAD si el tipo de post es 'aiudocarerjob'
function addschema() //Function for Schema.org

{
    if (is_singular('aiudocarerjob')) { //only for post type aiudoCarerJob
        global $post;
        $headline = get_the_title($post->ID); //Post Title (also headline)
        $values = get_post_meta($post->ID);
        $datemodified = get_the_modified_time('c'); //Date modified in ISO 8601 format
        $date_validThrough = date("Y-m-d H:i:s ", strtotime($datemodified . "+ 5 month"));


        $schema_blogposting = array(
            '@context' => "https://schema.org",
            '@type' => "JobPosting",
            'title' => "Cuidadora de personas mayores " . $values['acj_job_title'][0],
            'description' => $values['acj_desc_job_tasks'][0],
            'identifier' => array(
                '@type' => "PropertyValue",
                'name' => "Aiudo empleadas",
                'value' => $headline
            ),
            'datePosted' => $datemodified,
            'validThrough' => $date_validThrough,
            'employmentType' => "contract",
            'hiringOrganization' => array(
                '@type' => "Organization",
                'name' => "Aiudo",
                'sameAs' => "https://aiudo.es",
                'logo' => "https://aiudo.es/wp-content/uploads/landing-img/favicon-aiudo.svg"
            ),
            'jobLocation' => array(
                '@type' => "Place",
                'address' => array(
                    '@type' => "PostalAddress",
                    //'streetAddress' => "1600 Amphitheatre Pkwy",
                    'addressLocality' => $values['acj_tax_provincia'][0],
                    'addressRegion' => $values['acj_job_community'][0],
                    //'postalCode' => "94043",
                    'addressCountry' => $values['acj_job_country'][0]
                )
            ),
            'baseSalary' => array(
                '@type' => "MonetaryAmount",
                'currency' => "EUR",
                'value' => array(
                    '@type' => "QuantitativeValue",
                    'value' => $values['acj_att_salary'][0],
                    'unitText' => "month"
                )
            ),
        );
        echo '<script type="application/ld+json">' . json_encode($schema_blogposting) . '</script>'; //encode schema for blogposting
    } 
}
add_action('wp_head', 'addschema'); //Add Schema to header


// añadimos esta acción para que muestre el mensaje en el bucle de elementor
add_action('elementor/query/query_results', function($query){
    $total = $query->found_posts;

    if($total == 0){
echo '<p>No hemos encontrado más ofertas en esta provincia.</p>';
    }
});

 

// add new columns
add_filter( 'manage_aiudocarerjob_posts_columns', 'manage_is_weekend_column' );
// the above hook will add columns only for default 'post' post type, for CPT:
// manage_{POST TYPE NAME}_posts_columns
function manage_is_weekend_column( $column_array ) {

	$column_array[ 'acj_job_is_weekend_job' ] = 'Es finde?';
	// the above code will add columns at the end of the array
	// if you want columns to be added in another order, use array_slice()

	return $column_array;
}

// Populate our new columns with data
add_action( 'manage_posts_custom_column', 'add_is_weekend_column', 10, 2 );
function add_is_weekend_column( $column_name, $post_id ) {

	// if you have to populate more that one columns, use switch()
	switch( $column_name ) {
		case 'acj_job_is_weekend_job': {
			/* */$is_weekend_job = get_post_meta( $post_id, 'acj_job_is_weekend_job', true );
			echo $is_weekend_job ? 'Sí' : 'No'; 
            //echo get_post_meta( $post_id, 'acj_job_is_weekend_job', true );
			break;
		}
	}

}



// Add our text to the quick edit box
add_action('quick_edit_custom_box', 'on_quick_edit_custom_box', 10, 2);
function on_quick_edit_custom_box($column_name, $post_type)
{
    if ('acj_job_is_weekend_job' == $column_name) {
        ?>
				<fieldset class="inline-edit-col-left">
					<div class="inline-edit-col">
						<label>
							<span class="title">Es finde?</span>
							<input type="checkbox" name="acj_job_is_weekend_job">
						</label>
					</div>
				<?php
    }
}

// Add our text to the bulk edit box
add_action('bulk_edit_custom_box', 'on_bulk_edit_custom_box', 10, 2);
function on_bulk_edit_custom_box($column_name, $post_type)
{
    if ('acj_job_is_weekend_job' == $column_name) {
        ?>
				<fieldset class="inline-edit-col-left">
					<div class="inline-edit-col">
						<label>
							<span class="title">Es finde?</span>
							<input type="checkbox" name="acj_job_is_weekend_job">
						</label>
					</div>
				<?php
    }
}


//guardar datos del weekend en la edición rápida
add_action( 'save_post', 'weekend_quick_edit_save' );

function weekend_quick_edit_save( $post_id ){

	// check inlint edit nonce
	if ( ! wp_verify_nonce( $_POST[ '_inline_edit' ], 'inlineeditnonce' ) ) {
		return;
	}
	// update checkbox
	$is_weekend = ( isset( $_POST[ 'acj_job_is_weekend_job' ] ) && 'on' == $_POST[ 'acj_job_is_weekend_job' ] ) ? 'on' : '';
	update_post_meta( $post_id, 'acj_job_is_weekend_job', $is_weekend );

}

add_action( 'save_post', 'weekend_bulk_edit_save' );

function weekend_bulk_edit_save( $post_id ){

	/* */ // check bulk edit nonce
	if ( ! wp_verify_nonce( $_REQUEST[ '_wpnonce' ], 'bulk-posts' ) ) {
		return;
	}

	
	// update checkbox
	$is_weekend = ( isset( $_REQUEST[ 'acj_job_is_weekend_job' ] ) && 'on' == $_REQUEST[ 'acj_job_is_weekend_job' ] ) ? 'on' : '';
	update_post_meta( $post_id, 'acj_job_is_weekend_job', $is_weekend );

   
    }



//rellenamos el checkbox en la edición rápida
add_action('admin_footer', 'my_admin_add_js', 100);
function my_admin_add_js() {
	?>
    <script>
    jQuery( function( $ ){

        const wp_inline_edit_function = inlineEditPost.edit;
    
        // we overwrite the it with our own
        inlineEditPost.edit = function( post_id ) {
    
            // let's merge arguments of the original function
            wp_inline_edit_function.apply( this, arguments );
    
            // get the post ID from the argument
            if ( typeof( post_id ) == 'object' ) { // if it is object, get the ID number
                post_id = parseInt( this.getId( post_id ) );
                console.log('post_row');
            }
    
            // add rows to variables
            const edit_row = $( '#edit-' + post_id )
            const post_row = $( '#post-' + post_id )
    
            const isWeekend = 'Sí' == $( '.column-acj_job_is_weekend_job', post_row ).text() ? true : false;

            
    
            // populate the inputs with column data
            $( ':input[name="acj_job_is_weekend_job"]', edit_row ).prop( 'checked', isWeekend );
            
        }
    });
    </script>
    <?php
	
}

