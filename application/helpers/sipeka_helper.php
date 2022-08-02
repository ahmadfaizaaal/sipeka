<?php

$GLOBALS['CI'] = &get_instance();

if (!function_exists('setResponse')) {
	function setResponse($result, $type)
	{
		$msg['type'] = $type;
		$msg['success'] = false;
		if ($result) {
			$msg['success'] = true;
		}
		echo json_encode($msg);
	}
}

if (!function_exists('is_login')) {
	function is_login($type = null)
	{
		global $CI;
		$CI->load->library('session');

		if (!is_null($type)) {
			if ($CI->session->userdata('logged_in_' . $type))
				return true;
		} else {
			if ($CI->session->userdata('logged_in'))
				return true;
		}
	}
}

if (!function_exists('do_login')) {
	function do_login($sessionId, $sessionData)
	{
		global $CI;
		$CI->load->library('session');

		$sessions = [
			'sessionId'   => $sessionId,
			'sessionData' => $sessionData
		];

		if ($CI->session->set_userdata('logged_in', $sessions)) {
			return true;
		}

		return false;
	}
}

if (!function_exists('do_logout')) {
	function do_logout()
	{
		global $CI;
		$CI->load->library('session');

		if ($CI->session->unset_userdata('logged_in')) {
			return true;
		}

		return false;
	}
}


if (!function_exists('assetsDir')) {
	function assetsDir($path = null)
	{
		return $path ? base_url('assets/' . $path) : base_url("assets/");
	}
}

if (!function_exists('d')) {
	function d($var, $echo = TRUE)
	{

		ob_start();
		var_dump($var);
		$output = ob_get_clean();

		$output = preg_replace("/\]\=\>\n(\s+)/m", "] => ", $output);
		$output = '<pre style="background: #FFFEEF; color: #000; border: 1px dotted #000; padding: 10px; margin: 10px 0; text-align: left;"> Dump => ' . $output . '</pre>';

		if ($echo == TRUE) {
			echo $output;
		} else {
			return $output;
		}
	}
}

if (!function_exists('load_page')) {
	function load_page($page_path = null,  $page_title = '', $data = [])
	{

		global $CI;

		$data['title'] = $page_title;
		$data['page_path'] = $page_path;

		$CI->load->view('core/head-core', $data);
		$CI->load->view('components/topbar', $data);
		$CI->load->view('components/sidebar', $data);
		$CI->load->view('components/content', $data);
		$CI->load->view('components/footer', $data);
		// $CI->load->view('core/foot-core', $data);
	}
}

if (!function_exists('export_pdf')) {
	function export_pdf($template, $filename, $paper_size = 'A4', $orientation = 'potrait', $is_download = true)
	{
		global $CI;
		$CI->load->library('dompdf_lib');
		$CI->dompdf_lib->loadHtml($template);
		$CI->dompdf_lib->setPaper($paper_size, $orientation);
		$CI->dompdf_lib->render();
		if ($is_download) {
			$CI->dompdf_lib->stream($filename . '.pdf');
		} else {
			$output = $CI->dompdf_lib->output();
			file_put_contents('./assets/pengajuan/temp/pdf/' . $filename . '.pdf', $output);
			return './assets/pengajuan/temp/pdf/' . $filename . '.pdf';
		}
	}
}

if (!function_exists('tgl_indo')) {
	function tgl_indo($tanggal, $cetak_hari = false)
	{
		$hari = array(
			1 =>    'Senin',
			'Selasa',
			'Rabu',
			'Kamis',
			'Jumat',
			'Sabtu',
			'Minggu'
		);

		$bulan = array(
			1 =>   'Januari',
			'Februari',
			'Maret',
			'April',
			'Mei',
			'Juni',
			'Juli',
			'Agustus',
			'September',
			'Oktober',
			'November',
			'Desember'
		);
		$split 	  = explode('-', $tanggal);
		$tgl_indo = $split[0] . ' ' . $bulan[(int)$split[1]] . ' ' . $split[2];

		if ($cetak_hari) {
			$num = date('N', strtotime($tanggal));
			return $hari[$num] . ', ' . $tgl_indo;
		}
		return $tgl_indo;
	}
}

if (!function_exists('formBuilder')) {
	function formBuilder($data = [])
	{
		if ($data) {

			$formElement = "";

			$formElement .= "<form autocomplete='off' data-form-type='" . ($data['formType']) . "' id='" . ($data['formId'] ?? 'current-form') . "' action='" . ($data['formAction'] ?? '#') . "' method='" . ($data['formMethod'] ?? 'POST') . "' enctype='" . ($data['formEnctype'] ?? '#') . "' classs='" . ($data['formClasses'] ?? '#') . "'>";

			if ($data['formFields']) {
				$formElement .= "<div class='row'>";
				foreach ($data['formFields'] as $fieldsColIndex => $fieldsCol) {
					$formElement .= "<div class='col-12 col-md-" . floor(12 / ($data['formColumns'] ?? 1)) . "'>";

					foreach ($fieldsCol as $fieldsIndex => $fields) {
						$formElement .= "<div class='form-group'>";
						$formElement .= "<label class='control-label' for='" . str_replace('_', '-', $fields['name']) . "-field'>" . $fields['label'] . ($fields['required'] ? " <span class='text-danger'>*</span>" : "") . "</label>";
						switch ($fields['type']) {

							case "select":
								$formElement .= "<select class='form-control' name='" . $fields['name'] . "' id='" . str_replace('_', '-', $fields['name']) . "-field' " . ($fields['required'] ? 'required' : '') . " " . ($fields['disabled'] ? 'disabled' : '') . ">";
								$formElement .= "<option class='text-muted' selected disabled>" . $fields['optionLabel'] . "</option>";
								foreach ($fields['options'] as $optionIndex => $optionItem) {
									$objOptVal = $fields['optionValues'];
									$objOptTxt = $fields['optionText'];
									$formElement .= "<option value='" . (is_array($optionItem) ? $optionItem[$fields['optionValues']] : $optionItem->{"$objOptVal"}) . "' " . ($fields['selectedOpt'] == (is_array($optionItem) ? $optionItem[$fields['optionValues']] : $optionItem->{"$objOptVal"}) ? "selected" : "") . ">" . (is_array($optionItem) ? $optionItem[$fields['optionText']] : $optionItem->{"$objOptTxt"}) . "</option>";
								}
								$formElement .= "</select>";
								break;

							default:
								$formElement .= "<input " . ($data['formType'] == "new" ? "role='presentation' autocomplete='new-password'" : "") . " type='" . $fields['type'] . "' class='form-control' value='" . $fields['value'] . "' name='" . $fields['name'] . "' id='" . str_replace('_', '-', $fields['name']) . "-field' placeholder='" . $fields['description'] . "' " . ($fields['required'] ? 'required' : '') . " " . ($fields['disabled'] ? 'disabled' : '') . ">";
								break;
						}
						$formElement .= "</div>";
					}

					$formElement .= "</div>";
				}
				$formElement .= "</div>";
			}

			$formElement .= "</form>";

			return $formElement;
		} else {
			return false;
		}
	}
}

if (!function_exists('http_request')) {
	function http_request($url = null, $data = [])
	{
		$output = [];
		if ($url) {
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_FAILONERROR, false);

			if (!empty($data)) {
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
				curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
			}

			$output = curl_exec($ch);
			$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

			if (curl_errno($ch)) {
				$error_msg = curl_error($ch);
				return ["message" => $error_msg, "status" => $httpcode, "response" => json_decode($output, true)];
			} else {
				return ["status" => $httpcode, "response" => json_decode($output, true)];
			}
			curl_close($ch);
		} else {
			return $output;
		}
	}
}
