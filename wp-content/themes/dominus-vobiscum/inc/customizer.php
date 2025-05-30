<?php
/**
 * Dominus Vobiscum Theme Customizer
 *
 * @package Dominus_Vobiscum
 */

if ( class_exists( 'Kirki' ) ) {
	new \Kirki\Panel(
		'theme_panel_id',
		[
			'priority'    => 1,
			'title'       => esc_html__( 'Theme Option', 'kirki' ),
			'description' => esc_html__( 'Pengaturan tema Dominus Vobiscum.', 'kirki' ),
		]
	);


	new \Kirki\Section(
		'header_section_id',
		[
			'title'       => esc_html__( 'Header', 'kirki' ),
			'description' => esc_html__( 'Pengaturan header website.', 'kirki' ),
			'panel'       => 'theme_panel_id',
			'priority'    => 1,
		]
	);

	new \Kirki\Field\Image(
		[
			'settings'    => 'set_homepage_banner',
			'label'       => esc_html__( 'Home Banner Image', 'kirki' ),
			'description' => esc_html__( 'Masukkan gambar untuk mengganti banner di homepage', 'kirki' ),
			'section'     => 'header_section_id',
			'default'     => 'https://images.unsplash.com/photo-1583364486567-ce2e045676e9',
			'priority' => 1
		]
	);

	new \Kirki\Field\Text(
		[
			'settings' => 'set_homepage_banner_alt',
			'label'    => esc_html__( 'Set Homepage Banner Alt Text', 'kirki' ),
			'description' => esc_html__( 'Masukkan image alt text disini untuk SEO.', 'kirki' ),
			'section'  => 'header_section_id',
			'default'  => esc_html__( 'lorem-ipsum', 'kirki' ),
			'priority' => 2,
		]
	);

	new \Kirki\Field\Text(
		[
			'settings' => 'set_homepage_banner_title',
			'label'    => esc_html__( 'Set Homepage Title', 'kirki' ),
			'section'  => 'header_section_id',
			'default'  => esc_html__( 'Lorem ipsum dolor sit amet', 'kirki' ),
			'priority' => 3,
		]
	);

	new \Kirki\Field\Editor(
		[
			'settings'    => 'set_homepage_banner_description',
			'label'       => esc_html__( 'Set Homepage Banner Description', 'kirki' ),
			'description' => esc_html__( 'Masukkan deskripsi disini untuk banner pada homepage.', 'kirki' ),
			'section'     => 'header_section_id',
			'default'     => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut a erat venenatis, semper elit eu, pharetra odio.', 'kirki' ),
			'priority' => 4
		]
	);

	new \Kirki\Field\Repeater(
		[
			'settings'    => 'set_banner_buttons',
			'label'       => esc_html__( 'Banner Buttons', 'kirki' ),
			'section'     => 'header_section_id',
			'priority'    => 5,
			'row_label'   => [
				'type' => 'text', 
				'value' => 'Button' 
			],
			'default'     => [
				[
					'link_text'   => esc_html__( 'Jadwal Misa', 'kirki' ),
					'link_target' => 0,
				],
				[
					'link_text'   => esc_html__( 'Pengumuman', 'kirki' ),
					'link_target' => 0,
				],
			],
			'fields'   => [
				'link_text'   => [
					'type'    => 'text',
					'label'   => esc_html__( 'Teks Tombol', 'kirki' ),
					'default' => esc_html__( 'Teks Tombol', 'kirki' ),
				],
				'link_target' => [
					'type'        => 'dropdown-pages',
					'label'       => esc_html__( 'Pilih Halaman', 'kirki' ),
					'description' => esc_html__( 'Link target akan diarahkan ke halaman ini', 'kirki' ),
					'default'     => 0,
				],
			],
			'choices'  => [
				'limit'             => 2,
				'item_name'         => esc_html__( 'Button', 'kirki' ),       // singular
				'item_name_plural'  => esc_html__( 'Buttons', 'kirki' ),      // plural (opsional)
				'item_label'        => [
					'selector'  => 'link_text',
					'edit_mode' => true,
				],
			],
		]
	);

	new \Kirki\Section(
		'footer_section_id',
		[
			'title'       => esc_html__( 'Footer', 'kirki' ),
			'description' => esc_html__( 'Pengaturan footer website.', 'kirki' ),
			'panel'       => 'theme_panel_id',
			'priority'    => 1,
		]
	);

	new \Kirki\Field\Text(
		[
			'settings' => 'set_copyright',
			'label'    => esc_html__( 'Set Copyright', 'kirki' ),
			'section'  => 'footer_section_id',
			'default'  => esc_html__( '© 20XX - Copyright Lorem Ipsum - All Rights Reserved', 'kirki' ),
			'priority' => 1,
		]
	);

	new \Kirki\Field\Text(
		[
			'settings' => 'set_territory',
			'label'    => esc_html__( 'Set Territory', 'kirki' ),
			'section'  => 'footer_section_id',
			'default'  => esc_html__( 'lorem ipsum', 'kirki' ),
			'priority' => 2,
		]
	);

	new \Kirki\Field\Editor(
		[
			'settings'    => 'set_footer_text',
			'label'       => esc_html__( 'Set Footer Text', 'kirki' ),
			'description' => esc_html__( 'Masukkan teks di footer.', 'kirki' ),
			'section'     => 'footer_section_id',
			'default'     => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut a erat venenatis, semper elit eu, pharetra odio. Quisque nec feugiat quam. Curabitur faucibus blandit purus, vitae congue lectus imperdiet a.', 'kirki' ),
			'priority' => 3
		]
	);
}
