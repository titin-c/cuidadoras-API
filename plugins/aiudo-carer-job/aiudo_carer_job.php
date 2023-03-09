<?php

/*
Plugin Name: Aiudo Carer Job
Description: Custom Post conectada a la API de aiudo
Author: Titín
Text Domain: aiudo-carer-job
Version:           1.1.0
*/



include plugin_dir_path(__FILE__) . 'functions.php';
include plugin_dir_path(__FILE__) . 'taxonomy-tipo.php';
include plugin_dir_path(__FILE__) . 'taxonomy-provincias.php';



add_action('init', 'add_cpt_acj');

function add_cpt_acj()
{
    $labels = array(
        'name' => _x('Ofertas', 'post type general name', 'aiudo-carer-job'),
        'singular_name' => _x('Oferta', 'post type singular name', 'aiudo-carer-job'),
        'menu_name' => _x('Ofertas de empleo', 'admin menu', 'aiudo-carer-job'),
        'add_new' => _x('Añadir nueva', 'servidor', 'aiudo-carer-job'),
        'add_new_item' => __('Añadir nueva oferta', 'aiudo-carer-job'),
        'new_item' => __('Nuevo oferta', 'aiudo-carer-job'),
        'edit_item' => __('Editar oferta', 'aiudo-carer-job'),
        'view_item' => __('Ver oferta', 'aiudo-carer-job'),
        'all_items' => __('Todos las ofertas', 'aiudo-carer-job'),
        'search_items' => __('Buscar oferta', 'aiudo-carer-job'),
        'not_found' => __('No hay ofertas.', 'aiudo-carer-job'),
        'not_found_in_trash' => __('No hay ofertas en la papelera.', 'aiudo-carer-job')
    );
    $args = array(
        'labels' => $labels,
        'description' => __('Descripción.', 'aiudo-carer-job'),
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_admin_bar' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'trabajo-cuidadora-ancianos'),
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => 3,
        'show_in_rest' => true,
        'supports' => array('title', 'editor', 'custom-fields'),
        'menu-icon' => 'dashicons-id-alt,',
        'taxonomies' => array('provincias', 'tipo-empleo'),

    );

    register_post_type('aiudoCarerJob', $args);
}



function acj_attributes_metabox()
{
    add_meta_box('acj-attributes', 'Características de la oferta', 'add_acj_attributes', 'aiudoCarerJob', 'advanced', 'high');
}


add_action('add_meta_boxes', 'acj_attributes_metabox');

function add_acj_attributes($post)
{
    $values = get_post_custom($post->ID);



    $salary = isset($values['acj_att_salary']) ? esc_attr($values['acj_att_salary'][0]) : '';
    $week_hours = isset($values['acj_att_week_hours']) ? esc_attr($values['acj_att_week_hours'][0]) : '';
    $carer_attributes = isset($values['acj_desc_carer_attributes']) ? esc_attr($values['acj_desc_carer_attributes'][0]) : '';
    $user_attributes = isset($values['acj_desc_user_attributes']) ? esc_attr($values['acj_desc_user_attributes'][0]) : '';
    $job_tasks = isset($values['acj_desc_job_tasks']) ? esc_attr($values['acj_desc_job_tasks'][0]) : '';

    $job_title = isset($values['acj_job_title']) ? esc_attr($values['acj_job_title'][0]) : '';
    $job_id = isset($values['acj_job_id']) ? esc_attr($values['acj_job_id'][0]) : '';
    $job_country = isset($values['acj_job_country']) ? esc_attr($values['acj_job_country'][0]) : '';
    $job_community = isset($values['acj_job_community']) ? esc_attr($values['acj_job_community'][0]) : '';
    $is_weekend_job = isset($values['acj_job_is_weekend_job']) ? esc_attr($values['acj_job_is_weekend_job'][0]) : '';
    $job_posted_date = isset($values['acj_job_posted_date']) ? esc_attr($values['acj_job_posted_date'][0]) : '';

    if ($is_weekend_job) {
        $is_checked = 'checked="checked"';
    } else {
        $is_checked = '';
    }

    ?>
    <style>
        input,
        textarea {
            width: 100%
        }

        input {
            width: 100%
        }

        textarea {
            height: 100px
        }
    </style>
    <p>
        <label for="acj_att_salary">Salario</label>
        <input type="text" name="acj_att_salary" id="acj_att_salary" value="<?php echo esc_html($salary); ?>" />

    </p>
    <p>
        <label for="acj_att_week_hours">Horas semanales</label>
        <input type="text" name="acj_att_week_hours" id="acj_att_week_hours" value="<?php echo esc_html($week_hours); ?>" />

    </p>
    <p>
        <label for="acj_desc_carer_attributes">Características de la cuidadora</label>
        <textarea type="text" name="acj_desc_carer_attributes"
            id="acj_desc_carer_attributes"><?php echo esc_html($carer_attributes); ?></textarea>

    </p>
    <p>
        <label for="acj_desc_user_attributes">Características del usuario</label>
        <textarea type="text" name="acj_desc_user_attributes"
            id="acj_desc_user_attributes"><?php echo esc_html($user_attributes); ?></textarea>

    </p>
    <p>
        <label for="acj_desc_job_tasks">Tareas</label>
        <textarea type="text" name="acj_desc_job_tasks"
            id="acj_desc_job_tasks"><?php echo esc_html($job_tasks); ?></textarea>

    </p>
    <!--campos no modificables -->
    <p>
        <label for="acj_job_title">Aiudo empleo Título</label>
        <input type="text" name="acj_job_title" id="acj_job_title" value="<?php echo esc_html($job_title); ?>"
            readonly="readonly" />

    </p>
    <p>
        <label for="acj_job_id">Aiudo empleo id</label>
        <input type="text" name="acj_job_id" id="acj_job_id" value="<?php echo esc_html($job_id); ?>" readonly="readonly" />

    </p>
    <p>
        <label for="acj_job_country">País</label>
        <input type="text" name="acj_job_country" id="acj_job_country" value="<?php echo esc_html($job_country); ?>"
            readonly="readonly" />

    </p>
    <p>
        <label for="acj_job_community">Comunidad Autónoma</label>
        <input type="text" name="acj_job_community" id="acj_job_community" value="<?php echo esc_html($job_community); ?>"
            readonly="readonly" />

    </p>
    <p>
        <label for="acj_job_is_weekend_job">Es un trabajo de finde</label>
        <input type="checkbox" name="acj_job_is_weekend_job" id="acj_job_is_weekend_job" <?php echo $is_checked ?>
            readonly="readonly" />

    </p>
    <p>
        <label for="acj_job_posted_date">Fecha de publicación</label>
        <input type="text" name="acj_job_posted_date" id="acj_job_posted_date"
            value="<?php echo esc_html($job_posted_date); ?>" readonly="readonly" />

    </p>
    <?php
    console_log(get_post_type());
}




function acj_attributes_metabox_save($post_id)
{
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    } /**/

    if (isset($post_id) && get_post_type() == 'aiudocarerjob') {

        update_post_meta($post_id, 'acj_job_title', $_POST['acj_job_title']);
        update_post_meta($post_id, 'acj_att_salary', $_POST['acj_att_salary']);
        update_post_meta($post_id, 'acj_att_week_hours', $_POST['acj_att_week_hours']);
        update_post_meta($post_id, 'acj_desc_carer_attributes', $_POST['acj_desc_carer_attributes']);
        update_post_meta($post_id, 'acj_desc_user_attributes', $_POST['acj_desc_user_attributes']);
        update_post_meta($post_id, 'acj_desc_job_tasks', $_POST['acj_desc_job_tasks']);

        update_post_meta($post_id, 'acj_job_id', $_POST['acj_job_id']);
        update_post_meta($post_id, 'acj_job_country', $_POST['acj_job_country']);
        update_post_meta($post_id, 'acj_job_community', $_POST['acj_job_community']);
        update_post_meta($post_id, 'acj_job_is_weekend_job', $_POST['acj_job_is_weekend_job']);
        update_post_meta($post_id, 'acj_job_posted_date', $_POST['acj_job_posted_date']);
    }



}
add_action('save_post_aiudocarerjob', 'acj_attributes_metabox_save');


//registramos la ruta para  poder añadir al cpt

add_action('rest_api_init', function () {
    register_rest_route('api/v1', '/insertar_ofeta', [
        'methods' => 'POST',
        'callback' => 'insertar_ofeta'
    ]);
});


// creamos la función callback que crea los posts
function insertar_ofeta($data)
{

    $parameters = $data->get_params();

    $my_post = array(
        //'post_title' => $parameters['post_title'],
        'post_title' => $parameters['post_title'] . '-' . $parameters['acj_job_id'],
        'post_content' => $parameters['post_content'],
        'post_status' => 'publish',
        'post_author' => 1,
        'post_type' => 'aiudoCarerJob',
        'page_template' => "carer-job.php",
        'tax_input' => array(
            'provincias' => $parameters['acj_tax_provincia'],
            'tipo-empleo' => $parameters['acj_tax_tipo'],
        ),
        'meta_input' => array(
            'acj_job_title' => $parameters['acj_tax_tipo'] . ' en ' . $parameters['acj_tax_provincia'],
            'acj_att_salary' => $parameters['acj_att_salary'],
            'acj_att_week_hours' => $parameters['acj_att_week_hours'],
            'acj_desc_carer_attributes' => $parameters['acj_desc_carer_attributes'],
            'acj_desc_user_attributes' => $parameters['acj_desc_user_attributes'],
            'acj_desc_job_tasks' => $parameters['acj_desc_job_tasks'],
            //otros parametros del endpoint
            'acj_tax_provincia' => $parameters['acj_tax_provincia'],
            'acj_tax_tipo' => $parameters['acj_tax_tipo'],
            'acj_job_id' => $parameters['acj_job_id'],
            'acj_job_country' => $parameters['acj_job_country'],
            'acj_job_community' => $parameters['acj_job_community'],
            'acj_job_is_weekend_job' => $parameters['acj_job_is_weekend_job'],
            'acj_job_posted_date' => $parameters['acj_job_posted_date']


        )
    );


    $idPost = wp_insert_post($my_post);

    if ($idPost != 0) {
        return "OK";
    }
    ;
    return "KO";
}


//creamos una nueva ruta para listarlos trabajos

add_action('rest_api_init', function () {
    register_rest_route('api/v1', '/obtener_oferta', [
        'methods' => 'GET',
        'callback' => 'obtener_oferta'
    ]);
});

// creamos el callback que lista los cpt

function obtener_oferta($request)
{
    // Initialize the array that will receive the posts' data. 
    $posts = array();
    // Receive and set the page parameter from the $request for pagination purposes
    $paged = $request->get_param('page');
    $paged = (isset($paged) || !(empty($paged))) ? $paged : 1;

    $args = [
        'paged' => $paged,
        'post__not_in' => get_option('sticky_posts'),
        'posts_per_page' => 10,
        'post_type' => 'aiudoCarerJob',
    ];

    $posts = get_posts($args);


    foreach ($posts as $post) {
        $data[] = (object) array(
            'ID' => $post->ID,
            'post_title' => $post->post_title,
            'acj_job_title' => $post->acj_job_title,
            'post_content' => $post->post_content,
            'acj_att_salary' => $post->acj_att_salary,
            'acj_att_week_hours' => $post->acj_att_week_hours,
            'acj_desc_carer_attributes' => $post->acj_desc_carer_attributes,
            'acj_desc_user_attributes' => $post->acj_desc_user_attributes,
            'acj_desc_job_tasks' => $post->acj_desc_job_tasks,
            'acj_job_id' => $post->acj_job_id,
            'acj_job_country' => $post->acj_job_country,
            'acj_job_community' => $post->acj_job_community,
            'acj_job_is_weekend_job' => $post->acj_job_is_weekend_job,
            'acj_job_posted_date' => $post->acj_job_posted_date,
            'acj_tax_provincia' => $post->acj_tax_provincia,
            'acj_tax_tipo' => $post->acj_tax_tipo,

        );



    }
    return $data;
}

/* add_action( 'rest_api_init', 'custom_api_get_all_jobs' );   
function custom_api_get_all_jobs() {
register_rest_route( 'api/v1', '/obtener_oferta', array(
'methods' => 'GET',
'callback' => 'obtener_oferta'
));
}
function obtener_oferta( $request ) {
// Initialize the array that will receive the posts' data. 
$posts_data = array();
// Receive and set the page parameter from the $request for pagination purposes
$paged = $request->get_param( 'page' );
$paged = ( isset( $paged ) || ! ( empty( $paged ) ) ) ? $paged : 1; 
// Get the posts using the 'post' and 'news' post types
$posts = get_posts( array(
'numberposts' => 10,
'post_type' => 'aiudoCarerJob'
)
); 
// Loop through the posts and push the desired data to the array we've initialized earlier in the form of an object
foreach( $posts as $post ) {
$id = $post->ID; 
$posts_data[] = (object) array( 
'acj_job_title' => $post->acj_job_title
);
}                  
return $posts_data;                   
}  */