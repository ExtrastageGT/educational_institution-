<?php

include 'template.php';
//include 'institute_class.php';

$template = new Template;
$template->assign('css_path', 'main.css');
$template->assign('js_path', '../js/script.js');
$template->assign('title', 'Главная');
$template->assign('aref_path', 'pg/');
$template->assign('rightside_content', '');
$template->render('template_html');