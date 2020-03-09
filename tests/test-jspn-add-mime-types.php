<?php
/**
 * Class JSPN_Add_Mime_Types_Test
 *
 * @package Jspn_Plugin
 */

/**
 * Sample test case.
 */
class JSPN_Add_Mime_Types_Test extends WP_UnitTestCase {

	/**
	 * Tests add_svg()
	 */
	public function test_add_svg() {
		$mimes = [];
		$class = new JSPN_Add_Mime_Types;
		$results = $class->add_svg($mimes);
		$this->assertTrue( is_array($results) );
		$this->assertArrayHasKey( 'svg', $results );
	}
}
