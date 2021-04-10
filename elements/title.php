<?php 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Element_Custom_Title extends \Bricks\Element {

  /** 
   * How to create your own elements
   * 
   * https://docs.bricksbuilder.io/article/38-create-your-own-elements
   */

  public $category     = 'custom';
  public $name         = 'custom-title';
  public $icon         = 'fas fa-anchor'; // FontAwesome 5 icon in builder (https://fontawesome.com/icons)
  public $css_selector = '.custom-title-wrapper'; // Default CSS selector for all controls with 'css' properties
  // public $scripts      = []; // Enqueue registered scripts

  public function get_label() {
    return esc_html__( 'Title', 'bricks' );
  }

  // Set builder control groups
  public function set_control_groups() {

    $this->control_groups['typography'] = [
      'title' => esc_html__( 'Typography', 'bricks' ),
      'tab' => 'content', // Either 'content' or 'style'
    ];

  }

  // Set builder controls
  public function set_controls() {
    // Title and subtitle controls are not grouped
    $this->controls['title'] = [
      'tab' => 'content',
      'label' => esc_html__( 'Title', 'bricks' ),
      'type' => 'text',
			'hasDynamicData' => 'text',
      'default' => esc_html__( 'I am a custom element', 'bricks' ),
      'placeholder' => esc_html__( 'Title goes here ..', 'bricks' ),
    ];

    $this->controls['subtitle'] = [
      'tab' => 'content',
      'label' => esc_html__( 'Subtitle', 'bricks' ),
      'type' => 'text',
			'hasDynamicData' => 'text',
      'default' => esc_html__( 'Just a subtitle. Click to edit me!', 'bricks' ),
      'placeholder' => esc_html__( 'Subtitle goes here ..', 'bricks' ),
    ];

    // Group title and subtitle typography under 'typography' in 'content' tab
    $this->controls['titleTypography'] = [
      'tab' => 'content',
      'group' => 'typography',
      'label' => esc_html__( 'Title typography', 'bricks' ),
      'type' => 'typography',
      'css' => [
        [
          'property' => 'typography',
          'selector' => '.title',
        ],
      ],
      'inline' => true,
      'small' => true,
      'default' => [
        'color' => [
          'hex' => '#f44336',
        ],
      ],
    ];

    $this->controls['subtitleTypography'] = [
      'tab' => 'content',
      'group' => 'typography',
      'label' => esc_html__( 'Subtitle typography', 'bricks' ),
      'type' => 'typography',
      'css' => [
        [
          'property' => 'typography',
          'selector' => '.subtitle',
        ],
      ],
      'inline' => true,
      'small' => true,
      'default' => [
        'font-size' => '18px',
      ],
    ];
  }

  /** 
   * Render element HTML on frontend
   * 
   * If no 'render_builder' function is defined then this code is used to render element HTML in builder, too.
   */
  public function render() {
    $settings = $this->settings;
    $title = isset( $settings['title'] ) && ! empty( $settings['title'] ) ? $settings['title'] : false;
    $subtitle = isset( $settings['subtitle'] ) && ! empty( $settings['subtitle'] ) ? $settings['subtitle'] : false;

    // Element placeholder
    if ( ! $title && ! $subtitle ) {
      return $this->render_element_placeholder( [
        'icon-class' => 'ti-paragraph',
        'text'       => esc_html__( 'Please add a title/subtitle.', 'bricks' ),
      ] );
    }

    echo '<div class="custom-title-wrapper">';

    if ( $title ) {
      $this->set_attribute( 'title-wrapper', 'class', ['title'] );
    
      echo '<h4 ' . $this->render_attributes( 'title-wrapper' ) . '>' . $title . '</h4>';
    }

    if ( $subtitle ) {
      $this->set_attribute( 'subtitle-wrapper', 'class', ['subtitle'] );
    
      echo '<div ' . $this->render_attributes( 'subtitle-wrapper' ) . '>' . $subtitle . '</div>';
    }

    echo '</div>';
  }

  /**
   * Render element HTML in builder (optional)
   * 
   * Adds element render scripts to wp_footer via x-template.
   * Better performance than 'render' function, which requires an AJAX request on every re-render. 
   * Works only for static, non-WordPess data, that does not be to retrieved from the database.
   */
  public static function render_builder() { ?>
		<script type="text/x-template" id="tmpl-bricks-element-custom-title">
			<div class="custom-title-wrapper">
			<contenteditable
				v-if="settings.title" 
				tag="h4"
				:name="name"
				:settings="settings"
				controlKey="title"
				class="title" />

        <contenteditable
					v-if="settings.subtitle" 
					:name="name"
					:settings="settings"
					controlKey="subtitle"
					class="subtitle"/>
			</div>
		</script>
	<?php
	}

}