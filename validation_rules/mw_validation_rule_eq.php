<?php
/**
 * Name: MW Validation Rule Eq
 * Description: 値が一致している
 * Version: 1.0.0
 * Author: Takashi Kitajima
 * Author URI: http://2inc.org
 * Created : July 21, 2014
 * Modified:
 * License: GPLv2
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */
class MW_Validation_Rule_Eq extends MW_Validation_Rule {

	/**
	 * バリデーションルール名を指定
	 */
	protected static $name = 'eq';

	/**
	 * rule
	 * @param string $key name属性
	 * @param array $option
	 * @return string エラーメッセージ
	 */
	public function rule( $key, array $options = array() ) {
		$value = $this->Data->get( $key );
		if ( !is_null( $value ) ) {
			$defaults = array(
				'target' => null,
				'message' => __( 'This is not in agreement.', MWF_Config::DOMAIN )
			);
			$options = array_merge( $defaults, $options );
			$target_value = $this->Data->get( $options['target'] );
			if ( $value !== $target_value ) {
				return $options['message'];
			}
		}
	}

	/**
	 * admin
	 * @param numeric $key バリデーションルールセットの識別番号
	 * @param array $value バリデーションルールセットの内容
	 */
	public static function admin( $key, $value ) {
		?>
		<table>
			<tr>
				<td><?php esc_html_e( 'The key at same value', MWF_Config::DOMAIN ); ?></td>
				<td><input type="text" value="<?php echo esc_attr( @$value[self::getName()]['target'] ); ?>" name="<?php echo MWF_Config::NAME; ?>[validation][<?php echo $key; ?>][<?php echo esc_attr( self::getName() ); ?>][target]" /></td>
			</tr>
		</table>
		<?php
	}
}