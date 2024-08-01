<?php

/**
 * Fuction yang digunakan di theme ini.
 */
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

add_action('after_setup_theme', 'velocitychild_theme_setup', 9);

function velocitychild_theme_setup()
{

	if (class_exists('Kirki')) :

		Kirki::add_panel('panel_berita', [
			'priority'    => 10,
			'title'       => esc_html__('Berita', 'justg'),
			'description' => esc_html__('', 'justg'),
		]);

        // section title_tagline
        Kirki::add_section('title_tagline', [
            'panel'    => 'panel_berita',
            'title'    => __('Site Identity', 'justg'),
            'priority' => 10,
        ]);

		///Section Color
		Kirki::add_section('section_colorberita', [
			'panel'    => 'panel_berita',
			'title'    => __('Warna', 'justg'),
			'priority' => 10,
		]);
		Kirki::add_field('justg_config', [
			'type'        => 'color',
			'settings'    => 'color_theme',
			'label'       => __('Color Theme', 'kirki'),
			'description' => esc_html__('', 'kirki'),
			'section'     => 'section_colorberita',
			'default'     => '#3faf48',
			'transport'   => 'auto',
			'output'      => [
				[
					'element'   => ':root',
					'property'  => '--color-theme',
				],
				[
					'element'   => '.border-color-theme',
					'property'  => '--bs-border-color',
				],
				[
					'element'   => '.bg-color-theme',
					'property'  => 'background-color',
				],
			],
		]);
        Kirki::add_field('justg_config', [
            'type'        => 'background',
            'settings'    => 'background_themewebsite',
            'label'       => __('Background', 'kirki'),
            'description' => esc_html__('', 'kirki'),
            'section'     => 'section_colorberita',
            'default'     => [
                'background-color'      => '#f1f1f1',
                'background-image'      => '',
                'background-repeat'     => 'repeat',
                'background-position'   => 'center center',
                'background-size'       => 'cover',
                'background-attachment' => 'scroll',
            ],
            'transport'   => 'auto',
            'output'      => [
                [
                    'element'   => ':root[data-bs-theme=light] body',
                ],
                [
                    'element'   => 'body',
                ],
            ],
        ]);

		///Section Iklan
		Kirki::add_section('section_iklanberita', [
			'panel'    => 'panel_berita',
			'title'    => __('Iklan', 'justg'),
			'priority' => 10,
		]);
		$fieldiklan = [
			'iklan_header'  => [
				'label'			=> 'Iklan Header',
				'description'	=> 'Iklan sebelah logo 728x90',
			],
			'iklan_home_1'  => [
				'label'			=> 'Iklan Home 1',
				'description'	=> 'Iklan Halaman Depan 650x70',
			],
			'iklan_home_2'  => [
				'label'			=> 'Iklan Home 2',
				'description'	=> 'Iklan Halaman Depan 650x70',
			],
			'iklan_home_bawah_1'  => [
				'label'			=> 'Iklan Home Bawah 1',
				'description'	=> 'Iklan Halaman Depan Bawah 600x80',
			],
			'iklan_home_bawah_2'  => [
				'label'			=> 'Iklan Home Bawah 2',
				'description'	=> 'Iklan Halaman Depan Bawah 600x80',
			],
			'iklan_content'  => [
				'label'			=> 'Iklan Single',
				'description'	=> 'Iklan Single post 650x70 ',
			],
			'iklan_content_2'  => [
				'label'			=> 'Iklan Single 2',
				'description'	=> 'Iklan Single post 650x70 ',
			],
			'iklan_content_3'  => [
				'label'			=> 'Iklan Single 3',
				'description'	=> 'Iklan Single post 650x70 ',
			],
			'iklan_archive'  => [
				'label'			=> 'Iklan Archive',
				'description'	=> 'Iklan Arsip post 600x60',
			],
			'iklan_archive_2'  => [
				'label'			=> 'Iklan Archive 2',
				'description'	=> 'Iklan Arsip post 600x60',
			]
		];
		foreach ($fieldiklan as $idfield => $datafield) {
			new \Kirki\Pro\Field\Headline(
				[
					'settings'    => 'headline'. $idfield,
					'label'       => esc_html__( 'Iklan ' . $datafield['label'] . '', 'kirki' ),
					'description' => esc_html__( '', 'kirki' ),
					'section'     => 'section_iklanberita',
					'tooltip'     => '',
				]
			);
			Kirki::add_field('justg_config', [
				'type'        => 'image',
				'settings'    => 'image_' . $idfield,
				'label'       => esc_html__('Gambar', 'kirki'),
				'description' => esc_html__($datafield['description'], 'kirki'),
				'section'     => 'section_iklanberita',
				'default'     => '',
				'partial_refresh'	=> [
					'partial_' . $idfield => [
						'selector'        => '.part_' . $idfield,
						'render_callback' => '__return_false'
					]
				],
			]);
			Kirki::add_field('justg_config', [
				'type'     => 'link',
				'settings' => 'link_' . $idfield,
				'label'    => __('Link', 'kirki'),
				'section'  => 'section_iklanberita',
				'default'  => '',
				'priority' => 10,
			]);
		}

		///Section Sosmed
		Kirki::add_section('section_sosmedberita', [
			'panel'    => 'panel_berita',
			'title'    => __('Sosial Media', 'justg'),
			'priority' => 10,
		]);
		$fieldsosmed = [
			'facebook'  => [
				'label'	=> 'Facebook',
			],
			'twitter'  => [
				'label'	=> 'Twitter',
			],
			'instagram'  => [
				'label'	=> 'Instagram',
			],
			'youtube'  => [
				'label'	=> 'Youtube',
			]
		];
		foreach ($fieldsosmed as $idfield => $datafield) {
			Kirki::add_field('justg_config', [
				'type'     => 'link',
				'settings' => 'link_sosmed_' . $idfield,
				'label'    => __('Link ' . $datafield['label'], 'kirki'),
				'section'  => 'section_sosmedberita',
				'default'  => 'https://' . $idfield . '.com/',
				'priority' => 10,
			]);
		}

		///Section Home
		Kirki::add_section('section_homeberita', [
			'panel'    => 'panel_berita',
			'title'    => __('Home', 'justg'),
			'priority' => 10,
		]);

		///Section Kolom Kanan
		Kirki::add_section('section_sidebarberita', [
			'panel'    => 'panel_berita',
			'title'    => __('Kolom Kanan', 'justg'),
			'priority' => 10,
		]);

		///field set posts
		$fieldposts = [
			'bigcarousel_home'  => [
				'label'		=> 'Big Carousel Home',
				'section'	=> 'section_homeberita',
				// 'title'		=> '',
			],
			'posts_home_1'  => [
				'label'		=> 'Posts Home 1',
				'section'	=> 'section_homeberita',
				'title'		=> 'Recent Posts',
			],
			'posts_home_2'  => [
				'label'		=> 'Posts Home 2',
				'section'	=> 'section_homeberita',
				'title'		=> 'Recent Posts',
			],
		];
		$categories = Kirki_Helper::get_terms('category');
		$categories['disable'] = 'Nonaktifkan';
		$categories[''] = 'Semua Kategori';
		unset($categories[1]);
		foreach ($fieldposts as $idfield => $datafield) {
			if (isset($datafield['title'])) {
				Kirki::add_field('justg_config', [
					'type'     => 'text',
					'settings' => 'title_' . $idfield,
					'label'    => esc_html__('Judul ' . $datafield['label'], 'kirki'),
					'section'  => $datafield['section'],
					'default'  => esc_html__($datafield['title'], 'kirki'),
					'priority' => 10,
				]);
			}
			Kirki::add_field('justg_config', [
				'type'        => 'select',
				'settings'    => 'cat_' . $idfield,
				'label'       => esc_html__('Kategori ' . $datafield['label'], 'kirki'),
				'section'     => $datafield['section'],
				'default'     => '',
				'placeholder' => esc_html__('Pilih kategori', 'kirki'),
				'priority'    => 10,
				'multiple'    => 1,
				'choices'     => $categories,
				'partial_refresh'	=> [
					'partial_' . $idfield => [
						'selector'        => '.part_' . $idfield,
						'render_callback' => '__return_false'
					]
				],
			]);
			if (isset($datafield['sortby']) && $datafield['sortby'] == true) {
				Kirki::add_field('justg_config', [
					'type'     => 'select',
					'settings' => 'sortby_' . $idfield,
					'label'    => esc_html__('Urutkan ' . $datafield['label'] . ' berdasarkan', 'kirki'),
					'section'  => $datafield['section'],
					'default'  => 'date',
					'priority' => 10,
					'multiple' => 1,
					'choices'  => [
						'date'	=> esc_html__('Tanggal', 'kirki'),
						'view'	=> esc_html__('Tayangan', 'kirki'),
					],
				]);
			}
		}

		// remove panel in customizer 
		Kirki::remove_panel('global_panel');
		Kirki::remove_panel('panel_header');
		Kirki::remove_panel('panel_footer');
		Kirki::remove_panel('panel_antispam');
		Kirki::remove_control('display_header_text');
	endif;

	//remove action from Parent Theme
	remove_action('justg_header', 'justg_header_menu');
	remove_action('justg_do_footer', 'justg_the_footer_open');
	remove_action('justg_do_footer', 'justg_the_footer_content');
	remove_action('justg_do_footer', 'justg_the_footer_close');

}

add_action( 'after_setup_theme', 'childtheme_formats', 11 );
function childtheme_formats() {
	add_theme_support(
		'post-formats',
		array(
			'aside', 
			'gallery',
			'image',
			'video',
			'quote',
			'link',
		)
	);
}

///add action builder part
add_action('justg_before_header', 'vdberita_before_header');
function vdberita_before_header()
{
	echo '<div class="bg-color-theme p-1"></div>';
	echo '<div class="px-2 px-md-0">';
	echo '<div class="container shadow">';
}
add_action('justg_after_footer', 'vdberita_after_footer');
function vdberita_after_footer()
{
	echo '</div>';
	echo '</div>';
	echo '<div class="bg-color-theme p-1"></div>';
}

///add action builder part
add_action('justg_header', 'justg_header_berita');
function justg_header_berita()
{
	require_once(get_stylesheet_directory() . '/inc/part-header.php');
}
add_action('justg_do_footer', 'justg_footer_berita');
function justg_footer_berita()
{
	require_once(get_stylesheet_directory() . '/inc/part-footer.php');
}

if (!function_exists('justg_right_sidebar_check')) {
    /**
     * Right sidebar check
     * 
     */
    function justg_right_sidebar_check()
    {
        $sidebar_pos            = velocitytheme_option('justg_sidebar_position', 'right');
        $pages_sidebar_pos      = velocitytheme_option('justg_pages_sidebar_position');
        $singular_sidebar_pos   = velocitytheme_option('justg_blogs_sidebar_position');
        $archives_sidebar_pos   = velocitytheme_option('justg_archives_sidebar_position');
        $shop_sidebar_pos       = velocitytheme_option('justg_shop_sidebar_position', 'default');

        if ($sidebar_pos === 'disable') {
            return;
        }

        if (is_page() && !in_array($pages_sidebar_pos, array('', 'default'))) {
            $sidebar_pos = $pages_sidebar_pos;
        }

        if (is_singular() && !in_array($singular_sidebar_pos, array('', 'default'))) {
            $sidebar_pos = $singular_sidebar_pos;
        }

        if (is_archive() && !in_array($archives_sidebar_pos, array('', 'default'))) {
            $sidebar_pos = $archives_sidebar_pos;
        }

        if (is_singular('fl-builder-template')) {
            return;
        }

        if ('right' === $sidebar_pos) {
            if (!is_active_sidebar('main-sidebar') && !has_action('justg_before_main_sidebar') && !has_action('justg_after_main_sidebar')) {
                return;
            }

        ?>
            <div class="widget-area right-sidebar col-sm-4 order-3" id="right-sidebar" role="complementary">
                <?php do_action('justg_before_main_sidebar'); ?>
                <?php dynamic_sidebar('main-sidebar'); ?>
                <?php do_action('justg_after_main_sidebar'); ?>
            </div>
            <?php
        }
    }
}

function get_berita_iklan($idiklan)
{
	$iklan_content  = velocitytheme_option('image_' . $idiklan, '');
	echo '<div class="part_' . $idiklan . '">';
	if ($iklan_content) {
		$linkiklan = velocitytheme_option('link_' . $idiklan, '');
		echo '<div class="mb-3 text-center">';
		echo $linkiklan ? '<a href="' . $linkiklan . '" target="_blank">' : '';
		echo '<img class="img-fluid" src="' . $iklan_content . '" loading="lazy">';
		echo $linkiklan ? '</a>' : '';
		echo '</div>';
	}
	echo '</div>';
}

function vdberita_limit_text($text, $limit)
{
	if (str_word_count($text, 0) > $limit) {
		$words = str_word_count($text, 2);
		$pos   = array_keys($words);
		$text  = substr($text, 0, $pos[$limit]) . '...';
	}
	return $text;
}

// Fungsi untuk menambahkan hit ke post meta
function tambahkan_hit_ke_post_meta()
{
	if (is_single()) { // Memeriksa apakah ini halaman single post
		$post_id = get_the_ID();
		$hit_count = get_post_meta($post_id, 'hit', true); // Dapatkan nilai hit sekarang

		if (empty($hit_count)) {
			$hit_count = 1; // Jika belum ada hit sebelumnya, mulai dari 1
		} else {
			$hit_count++; // Jika sudah ada hit sebelumnya, tambahkan 1
		}

		update_post_meta($post_id, 'hit', $hit_count); // Update nilai hit
	}
}

// Menjalankan fungsi saat halaman dimuat
add_action('wp_footer', 'tambahkan_hit_ke_post_meta');

function justg_get_hit() {
	echo get_post_meta(get_the_ID(),'hit',true);
}

function justg_get_sosmed() {
	$sosmed = ['facebook' => '#2d59a1', 'twitter' => '#079be3', 'instagram' => '#e72283', 'youtube' => '#DD2C26'];
	foreach ($sosmed as $key => $color) {
		$datalink  = velocitytheme_option('link_sosmed_' . $key);
		if ($datalink) {
			echo '<a class="btn border-0 btn-sm me-1 rounded-0 btn-secondary" style="--bs-btn-bg:' . $color . ';min-width:1.75rem;" href="' . $datalink . '" target="_blank"><i class="fa fa-' . $key . '"></i></a>';
		}
	}
}

