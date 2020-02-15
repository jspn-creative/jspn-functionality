<?php
/**
 * Add new MIME types
 *
 * @package     JSPN
 * @subpackage  JSPN/includes
 * @copyright   Copyright (c) 2020, Jaspin Creative
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 * @author      Josh Spinney <josh@jaspin.io>
 */

class JSPN_Add_Mime_Types {

	/**
	 * Initialize the class
	 */
	public function __construct() {
		add_filter('upload_mimes', array($this, 'add_svg'));
		add_filter('wp_check_filetype_and_ext', array($this, 'upload_check'), 10, 4);
		add_action('wp_AJAX_svg_get_attachment_url', array($this, 'display_svg_files_backend'));
		add_filter('wp_prepare_attachment_for_js', array($this, 'display_svg_media'), 10, 3);
	}

	/**
     * Add SVG MIME type
     *
     * @since  1.0.0
     * @access public
     * @return void
     */
	public function add_svg( $mimes ){
		$mimes['svg'] = 'image/svg+xml';
		return $mimes;
	}

	/**
     * Checks SVG uploads
     *
     * @since  1.0.0
     * @access public
     * @return void
     */
	public function upload_check($checked, $file, $filename, $mimes){

	if (!$checked['type']) {

		$upload_check = wp_check_filetype($filename, $mimes);
		$ext              = $upload_check['ext'];
		$type             = $upload_check['type'];
		$proper_filename  = $filename;

		if ($type && 0 === strpos($type, 'image/') && $ext !== 'svg') {
			$ext = $type = false;
		}

		// Check the filename
		$checked = compact('ext', 'type', 'proper_filename');
	}

	return $checked;
	}

	/**
     * Displays SVG thumbnails in backend.
     *
     * @since  1.0.0
     * @access public
     * @return void
     */
	function display_svg_files_backend(){

	$url = '';
	$attachmentID = isset($_REQUEST['attachmentID']) ? $_REQUEST['attachmentID'] : '';

	if ($attachmentID) {
		$url = wp_get_attachment_url($attachmentID);
	}
	echo $url;

	die();
	}

	/**
     * Displays SVG thumbnails in media folder.
     *
     * @since  1.0.0
     * @access public
     * @return void
     */
	function display_svg_media($response, $attachment, $meta){
	if ($response['type'] === 'image' && $response['subtype'] === 'svg+xml' && class_exists('SimpleXMLElement')) {
		try {

			$path = get_attached_file($attachment->ID);

			if (@file_exists($path)) {
				$svg = new SimpleXMLElement(@file_get_contents($path));
				$src = $response['url'];
				$width = (int) $svg['width'];
				$height = (int) $svg['height'];
				$response['image'] = compact('src', 'width', 'height');
				$response['thumb'] = compact('src', 'width', 'height');

				$response['sizes']['full'] = array(
					'height'        => $height,
					'width'         => $width,
					'url'           => $src,
					'orientation'   => $height > $width ? 'portrait' : 'landscape',
				);
			}
		} catch (Exception $e) { }
	}

	return $response;
}

}