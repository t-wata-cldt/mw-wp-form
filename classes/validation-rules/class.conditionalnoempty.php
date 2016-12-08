<?php

class MW_WP_Form_Validation_Rule_ConditionalNoEmpty extends MW_WP_Form_Abstract_Validation_Rule {
	protected $name = 'conditionalnoempty';
	protected $admin_label = 'The key to enable nom empty check.';
	protected $error_message = 'Please enter.';

	protected function custom_checker($value) {
		return ( is_null( $value ) || !MWF_Functions::is_empty( $value ) );
	}

	public function rule( $key, array $options = array() ) {
		$defaults = array(
				'target' => null,
				'message' => __($this->error_message, 'mw-wp-form')
		);
		$options = array_merge( $defaults, $options );

		// 'target'オプションがnullなら何もしない
		if (is_null($options['target'])) { return; }

		if (is_null( $this->Data->get($options['target']) )) { return; }

		if ( $this->custom_checker($this->Data->get( $key )) ) {
			return;
		}
		return $options['message'];
	}

	public function admin( $key, $value ) {
		$target = '';
		if ( is_array( $value[$this->getName()] ) && isset( $value[$this->getName()]['target'] ) ) {
			$target = $value[$this->getName()]['target'];
		}

		?>
		<table>
			<tr>
				<td><?php esc_html_e( $this->admin_label, 'mw-wp-form' ); ?></td>
				<td><input type="text" value="<?php echo esc_attr( $target ); ?>" name="<?php echo MWF_Config::NAME; ?>[validation][<?php echo $key; ?>][<?php echo esc_attr( $this->getName() ); ?>][target]" /></td>
			</tr>
		</table>
		<?php
	}
}
