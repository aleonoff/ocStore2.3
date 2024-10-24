<?php
class ControllerExtensionModuleCurrencies extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('extension/module/currencies');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('currencies', $this->request->post);
			$this->session->data['success'] = $this->language->get('text_success');
			$this->response->redirect($this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true));
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
        $data['text_yes'] = $this->language->get('text_yes');
        $data['text_no'] = $this->language->get('text_no');

		$data['entry_currencies_cache'] = $this->language->get('entry_currencies_cache');
		$data['entry_cache_time'] = $this->language->get('entry_cache_time');
		$data['entry_status'] = $this->language->get('entry_status');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=payment', true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/module/currencies', 'token=' . $this->session->data['token'], true)
		);

		$data['action'] = $this->url->link('extension/module/currencies', 'token=' . $this->session->data['token'], true);
		$data['cancel'] = $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=payment', true);

        $data['currencies_cache'] = isset($this->request->post['currencies_cache']) ? (int)$this->request->post['currencies_cache'] : (int)$this->config->get('currencies_cache');
        $data['currencies_status'] = isset($this->request->post['currencies_status']) ? (int)$this->request->post['currencies_status'] : (int)$this->config->get('currencies_status');

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/module/currencies', $data));
	}

    protected function validate() {
        if (!$this->user->hasPermission('modify', 'extension/payment/bank_transfer')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        return !$this->error;
    }

}
