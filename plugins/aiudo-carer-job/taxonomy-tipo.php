<?php


if (!function_exists('add_tipo_taxonomy')) {
    function add_tipo_taxonomy()
    {

        /**
         * Taxonomy: Tipos de empleo.
         */

        $labels = [
            "name" => esc_html__("Tipos de empleo", "aiudo-carer-job"),
            "singular_name" => esc_html__("Tipo de empleo", "aiudo-carer-job"),
        ];


        $args = [
            "label" => esc_html__("Tipos de empleo", "aiudo-carer-job"),
            "labels" => $labels,
            "public" => true,
            "publicly_queryable" => true,
            "hierarchical" => false,
            "show_ui" => true,
            "show_in_menu" => true,
            "show_in_nav_menus" => true,
            "query_var" => true,
            "rewrite" => [
                'slug' => 'trabajos-de-cuidadora-de-ancianos-como',
                'with_front' => true,
            ],
            "show_admin_column" => true,
            "show_in_rest" => true,
            "show_tagcloud" => false,
            "rest_base" => "tipo-empleo",
            "rest_controller_class" => "WP_REST_Terms_Controller",
            "rest_namespace" => "api/v1",
            "show_in_quick_edit" => true,
            "sort" => true,
            "show_in_graphql" => true,
        ];
        register_taxonomy("tipo-empleo", ["aiudocarerjob"], $args);
    }
    add_action('init', 'add_tipo_taxonomy');
}


//Creamos los campos para la descripción 2
function add_description_2_on_taxonomy($taxonomy)
{
?>
    <div class="form-field">
        <label for="description_2">Descripción 2</label>
        <textarea name="description_2" id="description_2"></textarea>
        <p>Segunda descripción.</p>
    </div>
<?php
}

function edit_description_2_on_taxonomy($term, $taxonomy)
{
    $description_2_field = get_term_meta($term->term_id, 'description_2', true);
?>
    <tr class="form-field">
        <th><label for="description_2">Descripción 2</label></th>
        <td>
            
            <?php
            wp_editor(wp_kses_post($description_2_field, ENT_QUOTES, 'UTF-8'), 'description_2');
            ?>
            <p>Segunda descripción.</p>
        </td>
    </tr>
<?php
}


add_action('tipo-empleo_add_form_fields', 'add_description_2_on_taxonomy');
add_action('tipo-empleo_edit_form_fields', 'edit_description_2_on_taxonomy', 10, 2);



//Creamos la función de guardar los campos
function save_description_2_on_taxonomy($termId)
{
    update_term_meta(
        $termId,
        'description_2',
        $_POST['description_2']
        );
}

add_action('created_tipo-empleo', 'save_description_2_on_taxonomy');
add_action('edited_tipo-empleo', 'save_description_2_on_taxonomy');

// Mostramos los valores de los campos en las columnas de edición
function display_description_2_on_taxonomy($string, $columns, $term_id)
{
    switch ($columns) {
        case 'description_2':
            echo esc_html(get_term_meta($term_id, 'description_2', true));
            break;
    }
}

function display_description_2_on_taxonomy_column($columns)
{
    $columns['description_2'] = 'Descripción 2';
    return $columns;
}

add_action('manage_tipo-empleo_custom_column', 'display_description_2_on_taxonomy', 10, 3);
add_filter('manage_edit-tipo-empleo_columns', 'display_description_2_on_taxonomy_column');





// creamos los 3 campos de las opuiniones
function add_reviews_on_taxonomy($taxonomy)
{
?>
    <hr>
    <div class="form-field">
        <label for="review_author_1">Nombre de la cuidadora</label>
        <input type="text" name="review_author_1" id="review_author_1" value="" />
    </div>
    <div class="form-field">
        <label for="review_1">Opinión 1</label>
        <textarea name="review_1" id="review_1"></textarea>
        <p>Primera opinión.</p>
    </div>
    <hr>
    <div class="form-field">
        <label for="review_author_2">Nombre de la cuidadora</label>
        <input type="text" name="review_author_2" id="review_author_2" value="" />
    </div>
    <div class="form-field">
        <label for="review_2">Opinión 2</label>
        <textarea name="review_2" id="review_2"></textarea>
        <p>Segunda opinión.</p>
    </div>
    <hr>
    <div class="form-field">
        <label for="review_author_3">Nombre de la cuidadora</label>
        <input type="text" name="review_author_3" id="review_author_3" value="" />
    </div>
    <div class="form-field">
        <label for="review_3">Opinión 3</label>
        <textarea name="review_3" id="review_3"></textarea>
        <p>Tercera opinión.</p>
    </div>
<?php
}

function edit_reviews_on_taxonomy($term, $taxonomy)
{
    $reviews_author_fields_1 = get_term_meta($term->term_id, 'review_author_1', true);
    $reviews_author_fields_2 = get_term_meta($term->term_id, 'review_author_2', true);
    $reviews_author_fields_3 = get_term_meta($term->term_id, 'review_author_3', true);

    $reviews_fields_1 = get_term_meta($term->term_id, 'review_1', true);
    $reviews_fields_2 = get_term_meta($term->term_id, 'review_2', true);
    $reviews_fields_3 = get_term_meta($term->term_id, 'review_3', true);
?>
    <tr class="form-field">
        <th><label for="review_1">Opinión 1</label></th>
        <td>
            <label for="review_author_1">Nombre de la cuidadora</label>
            <input type="text" name="review_author_1" id="review_author_1" value="<?php echo esc_attr($reviews_author_fields_1) ?>" />
            <label for="review_1">Opinión</label>
            <?php
            wp_editor(wp_kses_post($reviews_fields_1, ENT_QUOTES, 'UTF-8'), 'review_1');
            ?>
            <p>Primera opinión.</p>
        </td>
    </tr>
    <tr class="form-field">


        <th><label for="review_2">Opinión 2</label></th>
        <td>
            <label for="review_author_2">Nombre de la cuidadora</label>
            <input type="text" name="review_author_2" id="review_author_2" value="<?php echo esc_attr($reviews_author_fields_2) ?>" />
            <label for="review_2">Opinión</label>
            <?php
            wp_editor(wp_kses_post($reviews_fields_2, ENT_QUOTES, 'UTF-8'), 'review_2');
            ?>
            <p>Segunda descripción.</p>
        </td>
    </tr>
    <tr class="form-field">
        <th><label for="review_3">Opinión 3</label></th>
        <td>
            <label for="review_author_3">Nombre de la cuidadora</label>
            <input type="text" name="review_author_3" id="review_author_3" value="<?php echo esc_attr($reviews_author_fields_3) ?>" />
            <label for="review_3">Opinión</label>
            <?php
            wp_editor(wp_kses_post($reviews_fields_3, ENT_QUOTES, 'UTF-8'), 'review_3');
            ?>
            <p>Segunda descripción.</p>
        </td>
    </tr>
<?php
}
add_action('tipo-empleo_add_form_fields', 'add_reviews_on_taxonomy');
add_action('tipo-empleo_edit_form_fields', 'edit_reviews_on_taxonomy', 10, 2);


//Creamos la función de guardar los campos de opiniones
function save_reviews_on_taxonomy($termId)
{
    update_term_meta(
        $termId,
        'review_author_1',
        sanitize_text_field($_POST['review_author_1'])
    );
    update_term_meta(
        $termId,
        'review_author_2',
        sanitize_text_field($_POST['review_author_2'])
    );
    update_term_meta(
        $termId,
        'review_author_3',
        sanitize_text_field($_POST['review_author_3'])
    );

    update_term_meta(
        $termId,
        'review_1',
        $_POST['review_1']
    );
    update_term_meta(
        $termId,
        'review_2',
        $_POST['review_2']
    );
    update_term_meta(
        $termId,
        'review_3',
        $_POST['review_3']
    );
}

add_action('created_tipo-empleo', 'save_reviews_on_taxonomy');
add_action('edited_tipo-empleo', 'save_reviews_on_taxonomy');
