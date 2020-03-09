
<?php
/**
 * Class JSPN_Long_URL_Spam
 *
 * @package Jspn_Plugin
 */

/**
 * Sample test case.
 */
class JSPN_Long_URL_Spam_Test extends WP_UnitTestCase {

	/**
	 * Tests url_spamcheck()
	 */
	public function test_url_spamcheck() {
		$approved = 1; //approved
		$notapproved = 0; //not-approved
		$spam = 'spam';

		$goodurl['comment_author_url'] = 'https://jaspin.io';
		$badurl['comment_author_url'] = 'https://jaspin.io/earn-money-from-home-today-exclamation-mark';
		$emptyurl['comment_author_url'] = '';

// Refactor:

		$class = new JSPN_Long_URL_Spam;
		$results = $class->url_spamcheck($approved, $goodurl);
		$this->assertEquals( $approved, $results );

		$results = $class->url_spamcheck($notapproved, $goodurl);
		$this->assertEquals( $notapproved, $results );

		$results = $class->url_spamcheck($spam, $goodurl);
		$this->assertEquals( $spam, $results );

		$results = $class->url_spamcheck($approved, $badurl);
		$this->assertEquals( $spam, $results );

		$results = $class->url_spamcheck($notapproved, $badurl);
		$this->assertEquals( $spam, $results );

		$results = $class->url_spamcheck($notapproved, $emptyurl);
		$this->assertEquals( $notapproved, $results );

		$results = $class->url_spamcheck($approved, $emptyurl);
		$this->assertEquals( $approved, $results );
	}
}
