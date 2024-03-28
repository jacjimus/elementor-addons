<?php

namespace ElementorAddons\Widgets;

require_once( __DIR__ . '/traits/hero-trait.php' );

/**
 * @package Hero_widget
 */

defined( 'ABSPATH' ) || exit;

use Elementor\Widget_Base;
use ElementorAddons\Widgets\Traits\Hero_Trait;

class Hero_Widget extends Widget_Base
{
    use Hero_Trait;

    public function get_name(): string
    {
        return 'hero_widget';
    }

    public function get_title(): string
    {
        return esc_html__( 'Hero Widget', 'elementoraddons' );
    }

    public function get_icon(): string
    {
        return 'eicon-header';
    }

    public function get_categories(): array
    {
        return [ 'basic' ];
    }

    public function get_keywords(): array
    {
        return ['Hero', 'Header'];
    }

    public function get_style_depends(): array
    {
        return [ 'hero-widget-style' ];
    }
    protected function register_controls(): void
    {
        $this->injectTabContentControl();

        $this->injectTabStyleControl();
    }

    protected function render(): void
    {
        $settings = $this->get_settings_for_display();

        $this->renderHeroHeader( $settings );
    }


    protected function content_template()
    {
        ?>
        <# if ( settings.image ) {
         var image = {
            id: settings.image.id,
            url: settings.image.url,
            size: settings.image_size,
            dimension: settings.image_custom_dimension,
            model: view.getEditModel()
        };
        var image_url = elementor.imagesManager.getImageUrl( image );

        if ( ! image_url ) {
        return;
        }

        var imgClass = '';

        if ( '' !== settings.width ) {
        imgClass = 'elementor-animation-' + settings.width;

        } #>
        <div class="hero-nav">
            <input type="checkbox" id="nav-check">
            <div class="nav-header">
                <div class="nav-title">
                    <img src="{{{ image_url }}}" class="{{{ imgClass }}}" />
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
                <a href="#" target="_blank">Our Work</a>
                <a href="#" target="_blank">About</a>
                <a href="#" target="_blank">Blog</a>
                <a href="#" target="_blank">Contact</a>
            </div>

            <div>
                <a class="action-btn">
                    Get Started
                </a>
            </div>
        </div>
        <# } #>
        <?php
    }
}
