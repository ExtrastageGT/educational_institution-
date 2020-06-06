<?php

include_once '../template.php';
include_once '../institute_class.php';

if (isset($_POST['delete_item']))
{
    $student = new iStudent();
    $student->RemoveData('students');
}

$template = new Template;
$template->assign('title', 'Список учеников');
$template->assign('css_path', '../main.css');
$template->assign('js_path', '../js/script.js');
$template->assign('aref_path', '');
$template->assign('rightside_content', '<div class="rows">
                    <div class="table">
                        <h2>Список учеников
                                                                        <form action="student_list.php" method="post">
<p><input name="class" class="form_field blue" placeholder="Введите класс">
<button type="submit" name="submit" class="button search" value="insert">Найти</button>
</p>
</form>
</h2>
                        <table>
                            <tr>
                                <th>Фамилия</th>
                                <th>Имя</th>
                                <th>Отчество</th>
                                <th>Пол</th>
                                <th>Дата рождения</th>
                                <th>Класс</th>
                                <th>Удалить</th>
                            </tr>
                        <?php
                            $Student = new iStudent();
                            $Student->GetData(!empty($_POST));
                        ?>
                        </table>
                    </div>
                </div>');
$template->render('../template_html');
$Student = new iStudent();
$Student->GetData(empty($_POST));