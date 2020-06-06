<?php

include_once '../template.php';
include_once '../institute_class.php';

if (!empty($_POST))
{
    if ($_POST['submit'] == 'insert')
    {
        $Class = new iClass();
        $Class->InsertData();
    }
}

$template = new Template;
$template->assign('title', 'Создать класс');
$template->assign('css_path', '../main.css');
$template->assign('js_path', '../js/script.js');
$template->assign('aref_path', '');
$template->assign('rightside_content', '
<form action="" method="post">
<p><input name="number" class="form_field" placeholder="Введите номер" size="10"></p>
<p><input name="litera" class="form_field" placeholder="Введите литеру" size="10"></p>
<p><button type="submit" name="submit" class="button" value="insert">Создать</button>
</form></p>
');
$template->render('../template_html');
