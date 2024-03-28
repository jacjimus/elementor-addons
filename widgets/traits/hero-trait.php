<?php

namespace ElementorAddons\Widgets\Traits;

defined( 'ABSPATH' ) || exit;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Utils;

trait Hero_Trait
{
    protected function injectTabContentControl(): void
    {
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Layout', 'elementoraddons' ),
                'tab' => Controls_Manager::TAB_CONTENT,

            ]
        );

        $this->add_responsive_control(
            'nav_bar_direction',
            [
                'type' => Controls_Manager::CHOOSE,
                'label' => esc_html__( 'Navbar Direction', 'elementoraddons' ),
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'elementoraddons' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'elementoraddons' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
            ]
        );
        $this->add_responsive_control(
            'menu_position',
            [
                'type' => Controls_Manager::CHOOSE,
                'label' => esc_html__( 'Menu Position', 'elementoraddons' ),
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'elementoraddons' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'elementoraddons' ),
                        'icon' => 'eicon-h-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'elementoraddons' ),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'default' => 'center',
            ]
        );
        $this->add_control(
            'pointer',
            [
                'label' => esc_html__( 'Pointer', 'elementoraddons' ),
                'type' => Controls_Manager::SELECT,
                'separator' => 'before',
                'options' => [
                    'title' => esc_html__( 'None', 'elementoraddons' ),
                    'underline' => esc_html__( 'Underline', 'elementoraddons' ),
                    'background' => esc_html__( 'Background', 'elementoraddons' ),

                ],
                'default' => 'none',
            ]
        );
        $this->add_control(
            'mobile_dropdown',
            [
                'label' => esc_html__( 'Mobile Dropdown', 'elementoraddons' ),
                'type' => Controls_Manager::SELECT,
                'separator' => 'before',
                'options' => [
                    'tablet' => esc_html__( 'Tablet', 'elementoraddons' ),
                    'mobile' => esc_html__( 'Mobile', 'elementoraddons' ),
                    'none' => esc_html__( 'None', 'elementoraddons' ),

                ],
                'default' => 'tablet',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'site_identity_section',
            [
                'label' => esc_html__( 'Site Identity', 'elementoraddons' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_responsive_control(
            'type',
            [
                'label' => esc_html__( 'Type', 'elementoraddons' ),
                'type' => Controls_Manager::SELECT,
                'separator' => 'before',
                'options' => [
                    'logo' => esc_html__( 'Site Logo', 'elementoraddons' ),
                    'title' => esc_html__( 'Site title', 'elementoraddons' ),

                ],
                'default' => 'logo',
            ]
        );
        $this->add_control(
            'image',
            [
                'label' => esc_html__( 'Site Logo', 'elementoraddons' ),
                'type' => Controls_Manager::MEDIA,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'type' => 'logo',
                ],
            ]
        );
        $this->add_control(
            'site_title',
            [
                'type' =>Controls_Manager::NOTICE,
                'notice_type' => 'info',
                'dismissible' => false,
                'heading' => false,
                'content' => sprintf( 'Go to <a href="%s">Site Identity</a> > <a href="%s">Site Description</a> to edit the site title.', admin_url( 'customize.php?autofocus[section]=title_tagline' ), admin_url( 'customize.php?autofocus[section]=title_tagline' ) ),
                'condition' => [
                    'type' => 'title']
            ]
        );


        $this->end_controls_section();
        $this->start_controls_section(
            'menu_section',
            [
                'label' => esc_html__( 'Menu', 'elementoraddons' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'menu_list',
            [
                'label' => esc_html__( 'Pro access', 'elementoraddons' ),
                'type' =>Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'title',
                        'label' => esc_html__( 'Title', 'elementoraddons' ),
                        'type' => Controls_Manager::TEXT,
                        'default' => esc_html__( 'Menu # 1', 'elementoraddons' ),
                        'label_block' => false,
                    ],
                    [
                        'name' => 'link',
                        'label' => esc_html__( 'Link', 'elementoraddons' ),
                        'type' => Controls_Manager::URL,
                        'label_block' => false,
                    ]


                ],
                'default' => [
                    [
                        'title' => esc_html__(  'Menu 1', 'elementoraddons' ),
                        'link' => esc_html__(  'Item content. Click the edit button to change this text.', 'elementoraddons' ),
                    ],

                ],

                'title_field' => '{{{ title }}}',
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'button_section',
            [
                'label' => esc_html__( 'CTA Button', 'elementoraddons' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'cta_title',
            [
                'label' => esc_html__( 'Title', 'elementoraddons' ),
                'type' => Controls_Manager::TEXT,
                'ai' => [
                    'type' => 'text',
                ],
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__( '', 'elementoraddons' ),
                'default' => esc_html__( 'Get started', 'elementoraddons' ),
            ]
        );

        $this->add_control(
            'cta_link',
            [
                'label' => esc_html__( 'Link', 'elementoraddons' ),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => '',
                ],
            ]
        );
        $this->add_control(
            'cta_icon',
            [
                'label' => esc_html__( 'Icon', 'elementoraddons' ),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'skin' => 'inline',
                'label_block' => false,
                'icon_exclude_inline_options' =>'icon_exclude_inline_options',
                'default' => [
                    'value' => 'fas fa-arrow-circle-right',
                    'library' => 'fa-solid',
                ],
            ]
        );
        $this->end_controls_section();
    }
    protected function injectTabStyleControl(): void
    {
        $this->start_controls_section(
            'section_tab_logo',
            [
                'label' => esc_html__( 'Logo', 'elementoraddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'width',
            [
                'label' => esc_html__( 'Width', 'elementoraddons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 62,
                ],
                'selectors' => [
                    '{{WRAPPER}} img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_tab_menu',
            [
                'label' => esc_html__( 'Menu', 'elementoraddons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'menu_spacing',
            [
                'label' => esc_html__( 'Spacing', 'elementoraddons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 20,
                ],
                'selectors' => [
                    '{{WRAPPER}} .menu-spacing' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography',
                'selector' => '{{WRAPPER}} .your-class',
            ]
        );


        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_box_shadow',
                'selector' => '{{WRAPPER}} .elementor-button',
            ]
        );
        $this->end_controls_section();
    }
    protected function renderHeroHeader($settings): void
    {
        ?>
       <div class="hero-nav">
            <input type="checkbox" id="nav-check">
            <div class="nav-header">
                <div class="nav-title">
               <?php
                if (!empty($settings['image'])) {
                    Group_Control_Image_Size::print_attachment_image_html( $settings );
                } else {
                    echo 'Logo';
                }

        ?>

                </div>
            </div>
            <div class="nav-btn">
                <label for="nav-check">
                <span></span>
                <span></span>
                <span></span>
              </label>
            </div>

            <div class="nav-links">
                <?php
                if ( !empty( $settings['menu_list'] ) ) {

                    foreach ( $settings['menu_list'] as $menu ) {
                ?>
                         <a href="<?php echo esc_attr($menu['link']) ?>"> <?php echo esc_html( $menu['title'] ) ?></a>
                <?php
                    }
                }
                ?>
            </div>

            <div>
                <?php
                if( !empty($settings['cta_title'])) {
                ?>
                <a  href="<?php echo esc_attr( $settings['cta_link']['url'] ) ?>" class="action-btn">
                   <?php echo esc_html( $settings['cta_title'] ) ?>
                </a>
                 <?php
                  }
                 ?>

            </div>
        </div>
     <?php

    }

}
