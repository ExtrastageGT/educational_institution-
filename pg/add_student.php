<?php

include_once '../template.php';
include_once '../institute_class.php';

if (!empty($_POST))
{
    if ($_POST['submit'] == 'insert')
    {
        $Student = new iStudent();
        $Student->InsertData();
    }
}
$template = new Template;
$template->assign('title', 'Добавить ученика');
$template->assign('css_path', '../main.css');
$template->assign('js_path', '../js/script.js');
$template->assign('aref_path', '');
$template->assign('rightside_content', '
<form action="add_student.php" method="post">
<?php?>
<p><input name="second_name" class="form_field" placeholder="Введите фамилию" size="30"></p>
<p><input name="first_name" class="form_field" placeholder="Введите имя" size="30"></p>
<p><input name="middle_name" class="form_field" placeholder="Введите отчество" size="30"></p>
<p><select name="gender" class="form_field">
    <option hidden value="">Выберите пол</option>
    <option value="мужской">мужской</option>
    <option value="женский">женский</option>
</select></p>
<p><input type="date" name="birth_date" class="form_field" placeholder="Введите дату рождения" size="10"></p>
<p><select name="class" class="form_field">
    <option hidden>Выберите класс</option>
    <?php $class = new iClass(); $class->GetOptionData(true);?>
</select></p>
</p>
<p><button type="submit" name="submit" class="button" value="insert">Добавить</button></p>
</form>
');
$template->render('../template_html');