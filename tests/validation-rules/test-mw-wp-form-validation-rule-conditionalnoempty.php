<?php
class MW_WP_Form_Validation_Rule_CondtionalNoEmpty_Test extends WP_UnitTestCase {

	/**
	 * @var MW_WP_Form_Validation_Rule_ConditionalNoEmpty
	 */
	protected $Rule;

	/**
	 * setUp
	 */
	public function setUp() {
		parent::setUp();
		$form_key   = MWF_Config::NAME . '-1';
		$this->Data = MW_WP_Form_Data::getInstance( $form_key );
		$this->Rule = new MW_WP_Form_Validation_Rule_ConditionalNoEmpty();
		$this->Rule->set_Data( $this->Data );
	}

	/**
	 * tearDown
	 */
	public function tearDown() {
		parent::tearDown();
		$this->Data->clear_values();
	}

	public function test_存在しなければnull() {
		$this->Data->set( 'text', null );
		$this->Data->set( 'cond', true );
		$this->assertNull( $this->Rule->rule( 'text', array( 'target' => 'cond' ) ) );

		$this->Data->set( 'cond', null );
		$this->assertNull( $this->Rule->rule( 'text', array( 'target' => 'cond' ) ) );
	}

	public function test_空文字列ならnotnull() {
		$this->Data->set( 'text', '' );
		$this->Data->set( 'cond', true );
		$this->assertNotNull( $this->Rule->rule( 'text', array( 'target' => 'cond' ) ) );

		$this->Data->set( 'cond', null );
		$this->assertNull( $this->Rule->rule( 'text', array( 'target' => 'cond' ) ) );
	}

	public function test_0ならnull() {
		$this->Data->set( 'text', 0 );
		$this->Data->set( 'cond', true );
		$this->assertNull( $this->Rule->rule( 'text', array( 'target' => 'cond' ) ) );

		$this->Data->set( 'cond', null );
		$this->assertNull( $this->Rule->rule( 'text', array( 'target' => 'cond' ) ) );
	}

	public function test_値があればnull() {
		$this->Data->set( 'text', 'aaa' );
		$this->Data->set( 'cond', true );
		$this->assertNull( $this->Rule->rule( 'text', array( 'target' => 'cond' ) ) );

		$this->Data->set( 'cond', null );
		$this->assertNull( $this->Rule->rule( 'text', array( 'target' => 'cond' ) ) );
	}
}
