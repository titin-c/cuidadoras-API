<?php
/**
 * The template for displaying archive pages.
 *
 * @package aiudocarerjob
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}
?>
<main id="content" class="site-main" role="main">

	<?php if (apply_filters('hello_elementor_page_title', true)): ?>
		<header class="page-header">
			<?php
			the_archive_title('<h1 class="entry-title">', '</h1>');
			the_archive_description('<p class="archive-description">', '</p>');
			?>
		</header>
	<?php endif; ?>
	<div class="page-content">
		<?php
		while (have_posts()) {
			the_post();
			$post_link = get_permalink();

			$custom_fields = get_post_custom();
			$post_type = get_post_type();
			$taxonomies = get_object_taxonomies($post_type);
			$taxonomy_tipo_empleo = wp_get_object_terms(get_the_ID(), 'tipo-empleo');
			$taxonomy_provincia = wp_get_object_terms(get_the_ID(), 'provincias');
			?>
			<article class="post">
				<?php
				printf('<h3 class="%s"><a href="%s">%s</a></h3>', 'entry-title', esc_url($post_link), wp_kses_post(get_the_title()));
				printf('<a href="%s">%s</a>', esc_url($post_link), get_the_post_thumbnail($post, 'large')); ?>
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
		<?php
				the_excerpt();
				?>
			</article>
		<?php } ?>
	</div>

	<?php wp_link_pages(); ?>

	<?php
	global $wp_query;
	if ($wp_query->max_num_pages > 1):
		?>
		<nav class="pagination" role="navigation">
			<?php /* Translators: HTML arrow */?>
			<div class="nav-previous">
				<?php next_posts_link(sprintf(__('%s older', 'hello-elementor'), '<span class="meta-nav">&larr;</span>')); ?>
			</div>
			<?php /* Translators: HTML arrow */?>
			<div class="nav-next">
				<?php previous_posts_link(sprintf(__('newer %s', 'hello-elementor'), '<span class="meta-nav">&rarr;</span>')); ?>
			</div>
		</nav>
	<?php endif; ?>
</main>