<?php

include_once '../template.php';
include_once '../institute_class.php';

if (isset($_POST['new_val']))
{
    $class = new iClass();
    $class->EditData();
    exit();
}

if (isset($_POST['delete_item']))
{
    $class = new iClass();
    $class->RemoveData('classes');
}

$template = new Template;
$template->assign('title', 'Список классов');
$template->assign('css_path', '../main.css');
$template->assign('js_path', '../js/script.js');
$template->assign('aref_path', '');
$template->assign('rightside_content', '<div class="rows">
                    <div class="table">
                        <h2>Список классов</h2>
                        <table align="center">
                            <tr>
                                <th>Номер</th>
                                <th>Литера</th>
                                <th>Удалить</th>
                            </tr>
                        <?php
                        $class = new iClass();
                        $class->GetOptionData(false);
                        ?>
                        </table>
                    </div>
                </div>');
$template->render('../template_html');