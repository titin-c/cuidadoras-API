<?php
/**
 * The template for displaying singular post-types: aiudocarerjob.
 *
 * @package aiudocarerjob
 */



if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}


$custom_fields = get_post_custom();
$post_type = get_post_type();
$taxonomies = get_object_taxonomies($post_type);
$taxonomy_tipo_empleo = wp_get_object_terms(get_the_ID(), 'tipo-empleo');
$taxonomy_provincia = wp_get_object_terms(get_the_ID(), 'provincias');


while (have_posts()):
	the_post();
	?>

	<main id="content" <?php post_class('site-main'); ?> role="main">
		<?php if (apply_filters('hello_elementor_page_title', true)): ?>
			<header class="page-header">
				<?php the_title('<h1 class="entry-title">', '</h1>'); ?>
			</header>
		<?php endif; ?>
		<div>
			<ul>
				<li><strong>Salario: </strong>
					<?php if (isset($custom_fields['acj_att_salary'])) {
						echo $custom_fields['acj_att_salary'][0];
					} ?>
				</li>
				<li><strong>Horas semanales: </strong>
					<?php if (isset($custom_fields['acj_att_week_hours'])) {
						echo $custom_fields['acj_att_week_hours'][0];
					} ?>
				</li>
				<li><strong>Características de la cuidadora: </strong>
					<?php if (isset($custom_fields['acj_desc_carer_attributes'])) {
						echo $custom_fields['acj_desc_carer_attributes'][0];
					} ?>
				</li>
				<li><strong>Características del usuario: </strong>
					<?php if (isset($custom_fields['acj_desc_user_attributes'])) {
						echo $custom_fields['acj_desc_user_attributes'][0];
					} ?>
				</li>
				<li><strong>Tipo: </strong>
					<?php if (!empty($taxonomy_tipo_empleo)):
						foreach ($taxonomy_tipo_empleo as $tax_tipo): ?>
							<a href="<?php echo get_bloginfo('wpurl'). "/trabajo-cuidadora-ancianos-como/" .  $tax_tipo->slug; ?>"><?php echo $tax_tipo->name; ?></a>
						<?php endforeach;
					endif;
					?>
				</li>
				<li><strong>Provincia: </strong>
					<?php if (!empty($taxonomy_provincia)):
						foreach ($taxonomy_provincia as $tax_provincia): ?>
							<a href="<?php echo get_bloginfo('wpurl'). "/trabajo-cuidadora-ancianos-en/" .  $tax_provincia->slug; ?>"><?php echo $tax_provincia->name; ?></a>
						<?php endforeach;
					endif;
					?>
				</li>
			</ul>
		</div>
		<div class="page-content">

			<?php the_content(); ?>

			<div class="post-tags">
				<?php the_tags('<span class="tag-links">' . __('Tagged ', 'hello-elementor'), null, '</span>'); ?>
			</div>
			<?php wp_link_pages(); ?>
		</div>

		<?php comments_template(); ?>
	</main>

<?php
endwhile;