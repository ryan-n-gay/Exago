<?php
/**
 * Exago Theme Customizer.
 *
 * @package Exago
 */

function exago_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
    $wp_customize->get_section( 'header_image' )->panel         = 'exago_header_panel';
    $wp_customize->get_section( 'title_tagline' )->priority     = '9';
    $wp_customize->get_section( 'title_tagline' )->title        = __('Site branding', 'exago');
    $wp_customize->remove_control( 'header_textcolor' );


    //Titles
    class exago_Info extends WP_Customize_Control {
        public $type = 'info';
        public $label = '';
        public function render_content() {
        ?>
            <h3 style="margin-top:30px;border-bottom:1px solid;padding:5px;color:#111;text-transform:uppercase;"><?php echo esc_html( $this->label ); ?></h3>
        <?php
        }
    }
    //___Header area___//
    $wp_customize->add_panel( 'exago_header_panel', array(
        'priority'       => 10,
        'capability'     => 'edit_theme_options',
        'theme_supports' => '',
        'title'          => __('Header area', 'exago'),
    ) );
    //___Header type___//
    $wp_customize->add_section(
        'exago_header_type',
        array(
            'title'         => __('Header type', 'exago'),
            'priority'      => 10,
            'panel'         => 'exago_header_panel',
            'description'   => __('Select your header type', 'exago'),
        )
    );
    //Front page
    $wp_customize->add_setting(
        'front_header_type',
        array(
            'default'           => 'image',
            'sanitize_callback' => 'exago_sanitize_header',
        )
    );
    $wp_customize->add_control(
        'front_header_type',
        array(
            'type'        => 'radio',
            'label'       => __('Front page header type', 'exago'),
            'section'     => 'exago_header_type',
            'description' => __('Select the header type for your front page', 'exago'),
            'choices' => array(
                'image'     => __('Image', 'exago'),
                'video'     => __('Video', 'exago'),
                'nothing'   => __('Only menu', 'exago')
            ),
        )
    );
    //Site
    $wp_customize->add_setting(
        'site_header_type',
        array(
            'default'           => 'nothing',
            'sanitize_callback' => 'exago_sanitize_header',
        )
    );
    $wp_customize->add_control(
        'site_header_type',
        array(
            'type'        => 'radio',
            'label'       => __('Site header type', 'exago'),
            'section'     => 'exago_header_type',
            'description' => __('Select the header type for all pages except the front page', 'exago'),
            'choices' => array(
                'image'     => __('Image', 'exago'),
                'video'     => __('Video', 'exago'),
                'nothing'   => __('Only menu', 'exago')
            ),
        )
    );

    //___Header text___//
    $wp_customize->add_section(
        'exago_header_text',
        array(
            'title'         => __('Header text', 'exago'),
            'priority'      => 14,
            'panel'         => 'exago_header_panel',
        )
    );
    $wp_customize->add_setting(
        'header_text',
        array(
            'default' => '',
            'sanitize_callback' => 'exago_sanitize_text',
            'transport'     => 'postMessage'
        )
    );
    $wp_customize->add_control(
        'header_text',
        array(
            'label' => __( 'Header text', 'exago' ),
            'section' => 'exago_header_text',
            'type' => 'text',
            'priority' => 10
        )
    );
    $wp_customize->add_setting(
        'header_subtext',
        array(
            'default' => '',
            'sanitize_callback' => 'exago_sanitize_text',
            'transport'     => 'postMessage'
        )
    );
    $wp_customize->add_control(
        'header_subtext',
        array(
            'label' => __( 'Header small text', 'exago' ),
            'section' => 'exago_header_text',
            'type' => 'text',
            'priority' => 10
        )
    );
    $wp_customize->add_setting(
        'header_button',
        array(
            'default' => '',
            'sanitize_callback' => 'exago_sanitize_text',
        )
    );
    $wp_customize->add_control(
        'header_button',
        array(
            'label' => __( 'Button text', 'exago' ),
            'section' => 'exago_header_text',
            'type' => 'text',
            'priority' => 10
        )
    );
    $wp_customize->add_setting(
        'header_button_url',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    $wp_customize->add_control(
        'header_button_url',
        array(
            'label' => __( 'Button URL', 'exago' ),
            'section' => 'exago_header_text',
            'type' => 'text',
            'priority' => 11
        )
    );

		//___Tablet header image___//
    $wp_customize->add_setting(
        'tablet_header',
        array(
            'default' => get_template_directory_uri() . '/images/header-mobile.jpg',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'tablet_header',
            array(
               'label'          => __( 'Tablet screens header image', 'exago' ),
               'type'           => 'image',
               'section'        => 'header_image',
               'settings'       => 'tablet_header',
               'description'    => __( 'Add a header image for screen widths smaller than 1024px', 'exago' ),
               'priority'       => 10,
            )
        )
    );

    //___Mobile header image___//
    $wp_customize->add_setting(
        'mobile_header',
        array(
            'default' => get_template_directory_uri() . '/images/header-mobile.jpg',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'mobile_header',
            array(
               'label'          => __( 'Small screens header image', 'exago' ),
               'type'           => 'image',
               'section'        => 'header_image',
               'settings'       => 'mobile_header',
               'description'    => __( 'Add a header image for screen widths smaller than 678px', 'exago' ),
               'priority'       => 10,
            )
        )
    );

		//___Header Logo Image___//
		$wp_customize->add_setting(
				'logo-header',
				array(
						// 'default' => get_template_directory_uri() . '/images/header-mobile.jpg',
						'sanitize_callback' => 'esc_url_raw',
				)
		);
		$wp_customize->add_control(
				new WP_Customize_Image_Control(
						$wp_customize,
						'header_logo',
						array(
							 'label'          => __( 'Header Logo Image', 'exago' ),
							 'type'           => 'image',
							 'section'        => 'header_logo',
							 'settings'       => 'logo-header',
							 'description'    => __( 'Add a secondary image to overlap the background ', 'exago' ),
							 'priority'       => 10,
						)
				)
		);

    //___Menu style___//
    $wp_customize->add_section(
        'exago_menu_style',
        array(
            'title'         => __('Menu style', 'exago'),
            'priority'      => 15,
            'panel'         => 'exago_header_panel',
        )
    );
    //Sticky menu
    $wp_customize->add_setting(
        'sticky_menu',
        array(
            'default'           => 'sticky',
            'sanitize_callback' => 'exago_sanitize_sticky',
        )
    );
    $wp_customize->add_control(
        'sticky_menu',
        array(
            'type' => 'radio',
            'priority'    => 10,
            'label' => __('Sticky menu', 'exago'),
            'section' => 'exago_menu_style',
            'choices' => array(
                'sticky'   => __('Sticky', 'exago'),
                'static'   => __('Static', 'exago'),
            ),
        )
    );
    //Menu style
    $wp_customize->add_setting(
        'menu_style',
        array(
            'default'           => 'inline',
            'sanitize_callback' => 'exago_sanitize_menu_style',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        'menu_style',
        array(
            'type'      => 'radio',
            'priority'  => 11,
            'label'     => __('Menu style', 'exago'),
            'section'   => 'exago_menu_style',
            'choices'   => array(
                'inline'     => __('Inline', 'exago'),
                'centered'   => __('Centered', 'exago'),
            ),
        )
    );

    //___Fonts___//
    $wp_customize->add_section(
        'exago_fonts',
        array(
            'title' => __('Fonts', 'exago'),
            'priority' => 15,
            'description' => __('You can use any Google Fonts you want for the heading and/or body. See the fonts here: google.com/fonts. See the documentation if you need help with this: !!!!!documentation/exago', 'exago'),
        )
    );

    //Body fonts
    $wp_customize->add_setting(
        'body_font_name',
        array(
            'default' => '//fonts.googleapis.com/css?family=Open+Sans:300,300italic,600,600italic',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    $wp_customize->add_control(
        'body_font_name',
        array(
            'label' => __( 'Body font name/style/sets', 'exago' ),
            'section' => 'exago_fonts',
            'type' => 'text',
            'priority' => 11
        )
    );

    //Body fonts family
    $wp_customize->add_setting(
        'body_font_family',
        array(
            'sanitize_callback' => 'exago_sanitize_text',
            'default' => 'font-family: \'Open Sans\', sans-serif;',
        )
    );
    $wp_customize->add_control(
        'body_font_family',
        array(
            'label' => __( 'Body font family', 'exago' ),
            'section' => 'exago_fonts',
            'type' => 'text',
            'priority' => 12
        )
    );
    //Headings fonts
    $wp_customize->add_setting(
        'headings_font_name',
        array(
            'default' => '//fonts.googleapis.com/css?family=Josefin+Sans:300italic,300',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    $wp_customize->add_control(
        'headings_font_name',
        array(
            'label' => __( 'Headings font name/style/sets', 'exago' ),
            'section' => 'exago_fonts',
            'type' => 'text',
            'priority' => 14
        )
    );
    //Headings fonts family
    $wp_customize->add_setting(
        'headings_font_family',
        array(
            'sanitize_callback' => 'exago_sanitize_text',
            'default' => 'font-family: \'Josefin Sans\', sans-serif;',
        )
    );
    $wp_customize->add_control(
        'headings_font_family',
        array(
            'label' => __( 'Headings font family', 'exago' ),
            'section' => 'exago_fonts',
            'type' => 'text',
            'priority' => 15
        )
    );

    // Site title
    $wp_customize->add_setting(
        'site_title_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '36',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control( 'site_title_size', array(
        'type'        => 'number',
        'priority'    => 17,
        'section'     => 'exago_fonts',
        'label'       => __('Site title', 'exago'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 80,
            'step'  => 1,
        ),
    ) );
    // Site description
    $wp_customize->add_setting(
        'site_desc_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '14',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control( 'site_desc_size', array(
        'type'        => 'number',
        'priority'    => 17,
        'section'     => 'exago_fonts',
        'label'       => __('Site description', 'exago'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 50,
            'step'  => 1,
        ),
    ) );
    //H1 size
    $wp_customize->add_setting(
        'h1_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '36',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control( 'h1_size', array(
        'type'        => 'number',
        'priority'    => 17,
        'section'     => 'exago_fonts',
        'label'       => __('H1 font size', 'exago'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 60,
            'step'  => 1,
        ),
    ) );
    //H2 size
    $wp_customize->add_setting(
        'h2_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '30',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control( 'h2_size', array(
        'type'        => 'number',
        'priority'    => 18,
        'section'     => 'exago_fonts',
        'label'       => __('H2 font size', 'exago'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 60,
            'step'  => 1,
        ),
    ) );

    //H3 size
    $wp_customize->add_setting(
        'h3_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '24',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control( 'h3_size', array(
        'type'        => 'number',
        'priority'    => 19,
        'section'     => 'exago_fonts',
        'label'       => __('H3 font size', 'exago'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 60,
            'step'  => 1,
        ),
    ) );
    //H4 size
    $wp_customize->add_setting(
        'h4_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '18',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control( 'h4_size', array(
        'type'        => 'number',
        'priority'    => 20,
        'section'     => 'exago_fonts',
        'label'       => __('H4 font size', 'exago'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 60,
            'step'  => 1,
        ),
    ) );
    //H5 size
    $wp_customize->add_setting(
        'h5_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '14',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control( 'h5_size', array(
        'type'        => 'number',
        'priority'    => 21,
        'section'     => 'exago_fonts',
        'label'       => __('H5 font size', 'exago'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 60,
            'step'  => 1,
        ),
    ) );
    //H6 size
    $wp_customize->add_setting(
        'h6_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '12',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control( 'h6_size', array(
        'type'        => 'number',
        'priority'    => 22,
        'section'     => 'exago_fonts',
        'label'       => __('H6 font size', 'exago'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 60,
            'step'  => 1,
        ),
    ) );
    //Body
    $wp_customize->add_setting(
        'body_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '14',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control( 'body_size', array(
        'type'        => 'number',
        'priority'    => 23,
        'section'     => 'exago_fonts',
        'label'       => __('Body font size', 'exago'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 24,
            'step'  => 1,
        ),
    ) );


    //___Blog options___//
    $wp_customize->add_section(
        'blog_options',
        array(
            'title' => __('Blog options', 'exago'),
            'priority' => 13,
        )
    );
    // Blog layout
    $wp_customize->add_setting(
        'blog_layout',
        array(
            'default'           => 'list',
            'sanitize_callback' => 'exago_sanitize_blog',
        )
    );
    $wp_customize->add_control(
        'blog_layout',
        array(
            'type'      => 'radio',
            'label'     => __('Blog layout', 'exago'),
            'section'   => 'blog_options',
            'priority'  => 11,
            'choices'   => array(
                'list'           	=> __( 'List', 'exago' ),
                'fullwidth'         => __( 'Full width (no sidebar)', 'exago' ),
                'masonry-layout'    => __( 'Masonry (grid style)', 'exago' )
            ),
        )
    );
    //Full width singles
    $wp_customize->add_setting(
        'fullwidth_single',
        array(
            'sanitize_callback' => 'exago_sanitize_checkbox',
        )
    );
    $wp_customize->add_control(
        'fullwidth_single',
        array(
            'type'      => 'checkbox',
            'label'     => __('Full width single posts?', 'exago'),
            'section'   => 'blog_options',
            'priority'  => 12,
        )
    );
    //Excerpt
    $wp_customize->add_setting(
        'exc_length',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '40',
        )
    );
    $wp_customize->add_control( 'exc_length', array(
        'type'        => 'number',
        'priority'    => 13,
        'section'     => 'blog_options',
        'label'       => __('Excerpt length', 'exago'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 200,
            'step'  => 5,
        ),
    ) );
    //Meta
    $wp_customize->add_setting(
      'hide_meta',
      array(
        'sanitize_callback' => 'exago_sanitize_checkbox',
        'default' => 0,
      )
    );
    $wp_customize->add_control(
      'hide_meta',
      array(
        'type' => 'checkbox',
        'label' => __('Hide post meta?', 'exago'),
        'section' => 'blog_options',
        'priority' => 14,
      )
    );
    //Index images
    $wp_customize->add_setting(
        'featured_image',
        array(
            'sanitize_callback' => 'exago_sanitize_checkbox',
        )
    );
    $wp_customize->add_control(
        'featured_image',
        array(
            'type' => 'checkbox',
            'label' => __('Hide featured images?', 'exago'),
            'section' => 'blog_options',
            'priority' => 22,
        )
    );

    //___Footer___//
    $wp_customize->add_section(
        'exago_footer',
        array(
            'title'         => __('Footer', 'exago'),
            'priority'      => 18,
        )
    );
    $wp_customize->add_setting(
        'footer_widget_areas',
        array(
            'default'           => '3',
            'sanitize_callback' => 'exago_sanitize_fwidgets',
        )
    );
    $wp_customize->add_control(
        'footer_widget_areas',
        array(
            'type'        => 'radio',
            'label'       => __('Footer widget area', 'exago'),
            'section'     => 'exago_footer',
            'description' => __('Choose the number of widget areas in the footer, then go to Appearance > Widgets and add your widgets.', 'exago'),
            'choices' => array(
                '1'     => __('One', 'exago'),
                '2'     => __('Two', 'exago'),
                '3'     => __('Three', 'exago'),
            ),
        )
    );
    //Logo Upload
    $wp_customize->add_setting(
        'footer_logo',
        array(
            'default-image' => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'footer_logo',
            array(
               'label'          => __( 'Upload your footer logo', 'exago' ),
               'type'           => 'image',
               'section'        => 'exago_footer',
               'priority'       => 11,
            )
        )
    );
    // Footer contact
    $wp_customize->add_setting('exago_options[info]', array(
            'type'              => 'info_control',
            'sanitize_callback' => 'esc_attr',
        )
    );
    $wp_customize->add_control( new exago_Info( $wp_customize, 'footer_contact', array(
        'label' => __('Contact', 'exago'),
        'section' => 'exago_footer',
        'settings' => 'exago_options[info]',
        'priority' => 12
        ) )
    );
    //Activate contact
    $wp_customize->add_setting(
        'toggle_contact_footer',
        array(
            'sanitize_callback' => 'exago_sanitize_checkbox',
            'default'           => 1
        )
    );
    $wp_customize->add_control(
        'toggle_contact_footer',
        array(
            'type' => 'checkbox',
            'label' => __('Activate the footer contact and logo area?', 'exago'),
            'section' => 'exago_footer',
            'priority' => 13,
        )
    );
    //Address
    $wp_customize->add_setting(
        'footer_contact_address',
        array(
            'default' => '',
            'sanitize_callback' => 'exago_sanitize_text',
        )
    );
    $wp_customize->add_control(
        'footer_contact_address',
        array(
            'label' => __( 'Address', 'exago' ),
            'section' => 'exago_footer',
            'type' => 'text',
            'priority' => 14
        )
    );
    //Email
    $wp_customize->add_setting(
        'footer_contact_email',
        array(
            'default' => '',
            'sanitize_callback' => 'exago_sanitize_text',
        )
    );
    $wp_customize->add_control(
        'footer_contact_email',
        array(
            'label' => __( 'Email address', 'exago' ),
            'section' => 'exago_footer',
            'type' => 'text',
            'priority' => 15
        )
    );
    //Phone
    $wp_customize->add_setting(
        'footer_contact_phone',
        array(
            'default' => '',
            'sanitize_callback' => 'exago_sanitize_text',
        )
    );
    $wp_customize->add_control(
        'footer_contact_phone',
        array(
            'label' => __( 'Phone number', 'exago' ),
            'section' => 'exago_footer',
            'type' => 'text',
            'priority' => 16
        )
    );

    //___Colors___//
    //Primary color
    $wp_customize->add_setting(
        'primary_color',
        array(
            'default'           => '#ee0000',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'primary_color',
            array(
                'label'         => __('Primary color', 'exago'),
                'section'       => 'colors',
                'priority'      => 12
            )
        )
    );
    //Site title
    $wp_customize->add_setting(
        'site_title',
        array(
            'default'           => '#ffffff',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'site_title',
            array(
                'label'         => __('Site title', 'exago'),
                'section'       => 'colors',
                'priority'      => 13
            )
        )
    );
    //Site desc
    $wp_customize->add_setting(
        'site_description',
        array(
            'default'           => '#BDBDBD',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'site_description',
            array(
                'label'         => __('Site description', 'exago'),
                'section'       => 'colors',
                'priority'      => 13
            )
        )
    );
    //Menu
    $wp_customize->add_setting(
        'menu_bg',
        array(
            'default'           => '#202529',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'menu_bg',
            array(
                'label'         => __('Menu background', 'exago'),
                'section'       => 'colors',
                'priority'      => 13
            )
        )
    );
    //Body
    $wp_customize->add_setting(
        'body_text_color',
        array(
            'default'           => '#656D6D',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'body_text_color',
            array(
                'label' => __('Body text', 'exago'),
                'section' => 'colors',
                'settings' => 'body_text_color',
                'priority' => 14
            )
        )
    );
    //Footer
    $wp_customize->add_setting(
        'footer_bg',
        array(
            'default'           => '#202529',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'footer_bg',
            array(
                'label' => __('Footer background', 'exago'),
                'section' => 'colors',
                'priority' => 15
            )
        )
    );

}
add_action( 'customize_register', 'exago_customize_register' );


/**
 * Sanitize
 */
//Header type
function exago_sanitize_header( $input ) {
    if ( in_array( $input, array( 'image', 'shortcode', 'video', 'nothing' ), true ) ) {
        return $input;
    }
}
//Text
function exago_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}
//Checkboxes
function exago_sanitize_checkbox( $input ) {
    if ( $input == 1 ) {
        return 1;
    } else {
        return '';
    }
}
//Menu style
function exago_sanitize_menu_style( $input ) {
    if ( in_array( $input, array( 'inline', 'centered' ), true ) ) {
        return $input;
    }
}
//Menu style
function exago_sanitize_sticky( $input ) {
    if ( in_array( $input, array( 'sticky', 'static' ), true ) ) {
        return $input;
    }
}
//Footer widget areas
function exago_sanitize_fwidgets( $input ) {
    if ( in_array( $input, array( '1', '2', '3' ), true ) ) {
        return $input;
    }
}
//Blog layout
function exago_sanitize_blog( $input ) {
    if ( in_array( $input, array( 'list', 'fullwidth', 'masonry-layout' ), true ) ) {
        return $input;
    }
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function exago_customize_preview_js() {
	wp_enqueue_script( 'exago_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'exago_customize_preview_js' );
