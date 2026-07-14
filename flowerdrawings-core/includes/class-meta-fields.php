<?php
/**
 * Registers and manages Flower Tutorial metadata.
 *
 * @package Flowerdrawings_Core
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Tutorial meta field registration and admin UI.
 */
final class Flowerdrawings_Core_Meta_Fields {
	private const NONCE_ACTION = 'flowerdrawings_save_tutorial_meta';
	private const NONCE_NAME   = 'flowerdrawings_tutorial_meta_nonce';

	/**
	 * Registers WordPress hooks.
	 */
	public function register_hooks(): void {
		add_action( 'init', array( $this, 'register_meta_fields' ) );
		add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
		add_action( 'save_post_' . Flowerdrawings_Core_Post_Type::POST_TYPE, array( $this, 'save_meta_box' ), 10, 2 );
	}

	/**
	 * Field definitions used by registration, rendering, and saving.
	 *
	 * @return array<string, array<string, mixed>>
	 */
	private function get_fields(): array {
		return array(
			'focus_keyword'        => array(
				'label'       => __( 'Focus Keyword', 'flowerdrawings' ),
				'type'        => 'string',
				'input'       => 'text',
				'description' => __( 'Primary exact-match keyword for this tutorial.', 'flowerdrawings' ),
			),
			'seo_title'            => array(
				'label'       => __( 'SEO Title', 'flowerdrawings' ),
				'type'        => 'string',
				'input'       => 'text',
				'description' => __( 'Optional SEO title used by the theme when no SEO plugin handles metadata.', 'flowerdrawings' ),
			),
			'meta_description'     => array(
				'label'       => __( 'Meta Description', 'flowerdrawings' ),
				'type'        => 'string',
				'input'       => 'textarea',
				'description' => __( 'Optional meta description used by the theme when no SEO plugin handles metadata.', 'flowerdrawings' ),
			),
			'tutorial_difficulty'  => array(
				'label'       => __( 'Difficulty', 'flowerdrawings' ),
				'type'        => 'string',
				'input'       => 'select',
				'options'     => array( 'Easy', 'Beginner', 'Intermediate' ),
				'description' => __( 'Choose the best difficulty label for readers.', 'flowerdrawings' ),
			),
			'tutorial_time'        => array(
				'label'       => __( 'Tutorial Time', 'flowerdrawings' ),
				'type'        => 'string',
				'input'       => 'text',
				'description' => __( 'Short time estimate, such as 15 minutes.', 'flowerdrawings' ),
			),
			'tutorial_step_count'  => array(
				'label'       => __( 'Step Count', 'flowerdrawings' ),
				'type'        => 'integer',
				'input'       => 'number',
				'description' => __( 'Number of visible tutorial steps.', 'flowerdrawings' ),
			),
			'worksheet_webp'       => array(
				'label'       => __( 'Worksheet WebP URL', 'flowerdrawings' ),
				'type'        => 'string',
				'input'       => 'url',
				'description' => __( 'URL for the worksheet preview image.', 'flowerdrawings' ),
			),
			'worksheet_pdf'        => array(
				'label'       => __( 'Worksheet PDF URL', 'flowerdrawings' ),
				'type'        => 'string',
				'input'       => 'url',
				'description' => __( 'URL for the downloadable worksheet PDF.', 'flowerdrawings' ),
			),
			'featured_image_alt'   => array(
				'label'       => __( 'Featured Image Alt Text', 'flowerdrawings' ),
				'type'        => 'string',
				'input'       => 'text',
				'description' => __( 'Concise alt text for the final tutorial image.', 'flowerdrawings' ),
			),
			'featured_image_title' => array(
				'label'       => __( 'Featured Image Title', 'flowerdrawings' ),
				'type'        => 'string',
				'input'       => 'text',
				'description' => __( 'Optional title attribute for the final tutorial image.', 'flowerdrawings' ),
			),
		);
	}

	/**
	 * Registers post meta for REST and editor usage.
	 */
	public function register_meta_fields(): void {
		foreach ( $this->get_fields() as $flowerdrawings_key => $flowerdrawings_field ) {
			$flowerdrawings_schema_type = 'integer' === $flowerdrawings_field['type'] ? 'integer' : 'string';

			register_post_meta(
				Flowerdrawings_Core_Post_Type::POST_TYPE,
				$flowerdrawings_key,
				array(
					'type'              => $flowerdrawings_schema_type,
					'single'            => true,
					'default'           => 'integer' === $flowerdrawings_schema_type ? 0 : '',
					'sanitize_callback' => array( $this, 'sanitize_registered_meta' ),
					'show_in_rest'      => array(
						'schema' => array(
							'type' => $flowerdrawings_schema_type,
						),
					),
				)
			);
		}
	}

	/**
	 * Sanitizes meta values passed through WordPress meta APIs.
	 *
	 * @param mixed  $meta_value The submitted meta value.
	 * @param string $meta_key   The registered meta key.
	 * @return string|int
	 */
	public function sanitize_registered_meta( mixed $meta_value, string $meta_key ): string|int {
		$flowerdrawings_value = is_scalar( $meta_value ) ? (string) $meta_value : '';

		return $this->sanitize_value( $meta_key, $flowerdrawings_value );
	}

	/**
	 * Adds the tutorial details meta box.
	 */
	public function add_meta_box(): void {
		add_meta_box(
			'flowerdrawings_tutorial_details',
			esc_html__( 'Flower Tutorial Details', 'flowerdrawings' ),
			array( $this, 'render_meta_box' ),
			Flowerdrawings_Core_Post_Type::POST_TYPE,
			'normal',
			'high'
		);
	}

	/**
	 * Renders the tutorial details meta box.
	 *
	 * @param WP_Post $post Current post.
	 */
	public function render_meta_box( WP_Post $post ): void {
		wp_nonce_field( self::NONCE_ACTION, self::NONCE_NAME );

		echo '<table class="form-table" role="presentation">';

		foreach ( $this->get_fields() as $flowerdrawings_key => $flowerdrawings_field ) {
			$flowerdrawings_value = get_post_meta( $post->ID, $flowerdrawings_key, true );

			echo '<tr>';
			echo '<th scope="row">';
			echo '<label for="' . esc_attr( $flowerdrawings_key ) . '">' . esc_html( $flowerdrawings_field['label'] ) . '</label>';
			echo '</th>';
			echo '<td>';
			$this->render_field( $flowerdrawings_key, $flowerdrawings_field, $flowerdrawings_value );

			if ( ! empty( $flowerdrawings_field['description'] ) ) {
				echo '<p class="description">' . esc_html( $flowerdrawings_field['description'] ) . '</p>';
			}

			echo '</td>';
			echo '</tr>';
		}

		echo '</table>';
	}

	/**
	 * Saves tutorial meta from the admin meta box.
	 *
	 * @param int     $post_id Current post ID.
	 * @param WP_Post $post    Current post.
	 */
	public function save_meta_box( int $post_id, WP_Post $post ): void {
		if ( Flowerdrawings_Core_Post_Type::POST_TYPE !== $post->post_type ) {
			return;
		}

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		if ( wp_is_post_revision( $post_id ) || wp_is_post_autosave( $post_id ) ) {
			return;
		}

		if ( ! isset( $_POST[ self::NONCE_NAME ] ) ) {
			return;
		}

		$flowerdrawings_nonce = sanitize_text_field( wp_unslash( $_POST[ self::NONCE_NAME ] ) );

		if ( ! wp_verify_nonce( $flowerdrawings_nonce, self::NONCE_ACTION ) ) {
			return;
		}

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

		foreach ( $this->get_fields() as $flowerdrawings_key => $flowerdrawings_field ) {
			$flowerdrawings_raw_value = $this->get_posted_value( $flowerdrawings_key );
			$flowerdrawings_value     = $this->sanitize_value( $flowerdrawings_key, $flowerdrawings_raw_value );

			if ( '' === $flowerdrawings_value || 0 === $flowerdrawings_value ) {
				delete_post_meta( $post_id, $flowerdrawings_key );
				continue;
			}

			update_post_meta( $post_id, $flowerdrawings_key, $flowerdrawings_value );
		}
	}

	/**
	 * Renders a field control.
	 *
	 * @param string              $key   Meta key.
	 * @param array<string,mixed> $field Field definition.
	 * @param mixed               $value Saved value.
	 */
	private function render_field( string $key, array $field, mixed $value ): void {
		$flowerdrawings_input_type = (string) $field['input'];

		if ( 'textarea' === $flowerdrawings_input_type ) {
			printf(
				'<textarea id="%1$s" name="%1$s" rows="4" class="large-text">%2$s</textarea>',
				esc_attr( $key ),
				esc_textarea( (string) $value )
			);
			return;
		}

		if ( 'select' === $flowerdrawings_input_type ) {
			$this->render_select_field( $key, $field, (string) $value );
			return;
		}

		$flowerdrawings_attributes = array(
			'id'    => $key,
			'name'  => $key,
			'type'  => $flowerdrawings_input_type,
			'value' => (string) $value,
			'class' => 'regular-text',
		);

		if ( 'number' === $flowerdrawings_input_type ) {
			$flowerdrawings_attributes['min']   = '0';
			$flowerdrawings_attributes['step']  = '1';
			$flowerdrawings_attributes['class'] = 'small-text';
		}

		echo '<input';

		foreach ( $flowerdrawings_attributes as $flowerdrawings_attribute => $flowerdrawings_attribute_value ) {
			echo ' ' . esc_attr( $flowerdrawings_attribute ) . '="' . esc_attr( $flowerdrawings_attribute_value ) . '"';
		}

		echo ' />';
	}

	/**
	 * Renders the difficulty select field.
	 *
	 * @param string              $key   Meta key.
	 * @param array<string,mixed> $field Field definition.
	 * @param string              $value Saved value.
	 */
	private function render_select_field( string $key, array $field, string $value ): void {
		$flowerdrawings_options = isset( $field['options'] ) && is_array( $field['options'] ) ? $field['options'] : array();

		echo '<select id="' . esc_attr( $key ) . '" name="' . esc_attr( $key ) . '">';
		echo '<option value="">' . esc_html__( 'Select difficulty', 'flowerdrawings' ) . '</option>';

		foreach ( $flowerdrawings_options as $flowerdrawings_option ) {
			printf(
				'<option value="%1$s"%2$s>%1$s</option>',
				esc_attr( (string) $flowerdrawings_option ),
				selected( $value, (string) $flowerdrawings_option, false )
			);
		}

		echo '</select>';
	}

	/**
	 * Gets a scalar submitted value.
	 */
	private function get_posted_value( string $key ): string {
		if ( ! isset( $_POST[ $key ] ) ) {
			return '';
		}

		$flowerdrawings_value = wp_unslash( $_POST[ $key ] );

		return is_scalar( $flowerdrawings_value ) ? (string) $flowerdrawings_value : '';
	}

	/**
	 * Sanitizes a value by field key.
	 *
	 * @return string|int
	 */
	private function sanitize_value( string $key, string $value ): string|int {
		if ( 'tutorial_step_count' === $key ) {
			return absint( $value );
		}

		if ( 'worksheet_webp' === $key || 'worksheet_pdf' === $key ) {
			return esc_url_raw( $value );
		}

		if ( 'meta_description' === $key ) {
			return sanitize_textarea_field( $value );
		}

		if ( 'tutorial_difficulty' === $key ) {
			$flowerdrawings_allowed = array( 'Easy', 'Beginner', 'Intermediate' );

			return in_array( $value, $flowerdrawings_allowed, true ) ? $value : '';
		}

		return sanitize_text_field( $value );
	}
}
