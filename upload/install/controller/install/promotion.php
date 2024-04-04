<?php
namespace Opencart\Install\Controller\Install;
/**
 * Class Promotion
 *
 * @package Opencart\Install\Controller\Install
 */
class Promotion extends \Opencart\System\Engine\Controller {
	/**
	 * @return string
	 */
	public function index(): string {

        $this->load->language('install/promotion');

        $data['title_featured'] = $this->language->get('title_featured');

		$curl = curl_init();

		curl_setopt($curl, CURLOPT_URL, 'https://ocstore.com/index.php?route=extension/json/extensions&version=' . urlencode(VERSION));
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_HEADER, false);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 30);
		curl_setopt($curl, CURLOPT_TIMEOUT, 30);

		$output = curl_exec($curl);

		if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 200) {
			$response = $output;
		} else {
			$response = '';
		}

        $extensions = json_decode($response, true);

        $data['extensions'] = $extensions['extensions'];

		curl_close($curl);

        return $this->load->view('install/promotion', $data);
	}
}