<?php

class MW_WP_Form_Validation_Rule_ConditionalRequired extends MW_WP_Form_Validation_Rule_ConditionalNoEmpty {
	protected $name = 'conditionalrequired';
	protected $admin_label = 'The key to enable nom empty check(for checkbox).';
	protected $error_message = 'This is required.';

	protected function custom_checker($value) {
		return !is_null( $value ) || is_null( $value ) && !$this->Data->gets();
	}
}
