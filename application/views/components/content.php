<?php

$page_path ? $this->load->view($page_path) : redirect(404);

if ($type == 'list') {
    $this->load->view('core/foot-core');
}

$this->load->view('components/modal');
$this->load->view('components/toast');
