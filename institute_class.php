<?php
class iStudent
{
    private $second_name;
    private $first_name;
    private $middle_name;
    private $gender;
    private $birth_date;
    private $class;

    protected $con;

    function __construct()
    {
        $servername = "localhost";
        $username = "root";
        $password = "root";
        $dbname = "educational_institution";

        $this->con = mysqli_connect($servername, $username, $password, $dbname);

        if (!$this->con) {
            die("Connect failed:" . mysqli_connect_error());
        }
    }

    protected function TextBox_value($value)
    {
        return mysqli_real_escape_string($this->con, htmlspecialchars($_POST[$value]));
    }

    private function SetData()
    {
        $this->second_name   = $this->TextBox_value('second_name');
        $this->first_name    = $this->TextBox_value('first_name');
        $this->middle_name   = $this->TextBox_value('middle_name');
        $this->gender        = $this->TextBox_value('gender');
        $this->birth_date    = $this->TextBox_value('birth_date');
        $this->class         = $this->TextBox_value('class');
    }

    protected function msg($classname, $msg)
    {
        echo "<h5 class='$classname'>$msg</h5>";
    }

    private function GetIsset()
    {
        return isset($_POST['second_name'], $_POST['first_name'], $_POST['middle_name'], $_POST['gender'], $_POST['birth_date'], $_POST['class']);
    }

    private function NoEmpty()
    {
        return !(empty($_POST['second_name']) || empty($_POST['first_name']) || empty($_POST['middle_name']) || empty($_POST['gender']) || empty($_POST['birth_date']) || empty($_POST['class']));
    }

    protected function EditableDIV_TD($id, $row, $name)
    {
        echo '<td><div class="edit" data-id='.$id.' data-name='.$name.' contenteditable>'.$row.'</div></td>';
    }

    protected function IMGButtonTD($class, $id, $row)
    {
        echo '<td><button type="button" class='.$class.' data-id='.$id.'><img src='.$row.' class="icon"></button></td>';
    }

    function InsertData()
    {
        if($this->GetIsset())
        {
            if($this->NoEmpty())
            {
                $this->SetData();
                $insert = mysqli_query($this->con,"INSERT INTO `students`(second_name, first_name, middle_name, gender, birth_date, class) 
VALUES('$this->second_name','$this->first_name', '$this->middle_name', '$this->gender', '$this->birth_date', '$this->class')");

               if($insert)
                   $this->msg("success", "Данные успешно добавлены в базу данных.");
               else
                   $this->msg("failed", "Добавление данных в базу данных провалено.");

            }
            else
                $this->msg("failed", "Пожалуйста заполните все поля!");
        }
        else
        {
            http_response_code(404);
            echo "404 Page Not Found!";
        }
    }

    function GetData($class_check)
    {
        if ($class_check)
        {
            $class = $this->TextBox_value('class');
            $get_data = mysqli_query($this->con, "SELECT * FROM students WHERE class LIKE '%$class%'");
        }
        else
        {
            $get_data = mysqli_query($this->con, "SELECT * FROM students");
        }

        if(mysqli_num_rows($get_data) > 0)
        {
            while($row = mysqli_fetch_assoc($get_data))
            {
                echo '<tr>';

                    $this->EditableDIV_TD($row['id'], $row['second_name'], 'second_name');
                    $this->EditableDIV_TD($row['id'], $row['first_name'], 'first_name');
                    $this->EditableDIV_TD($row['id'], $row['middle_name'], 'middle_name');
                    $this->EditableDIV_TD($row['id'], $row['gender'], 'gender');
                    $this->EditableDIV_TD($row['id'], $row['birth_date'], 'birth_date');
                    $this->EditableDIV_TD($row['id'], $row['class'], 'class');
                    $this->IMGButtonTD('img-button-del-student', $row['id'],'../img/minus-square-regular.png');

                echo '</tr>';
            }
        }
    }

    function RemoveData($from)
    {
        $id = $_POST['id'];
        $delete_string = mysqli_query($this->con,"DELETE FROM $from WHERE id='$id'");
        if ($delete_string) exit("Элемент успешно удален.");
        else exit("Ошибка удаления.");
    }

    function EditData()
    {
        $fields = array('number', 'litera');
        $field = isset($_POST['filed']) ? $_POST['filed'] : '';
        print_r($_POST);
        if (!in_array($field, $fields)) return false;
        print_r($_POST);
        $value = $this->TextBox_value('val');
        $id = $_POST['id'];
        mysqli_query($this->con, "UPDATE classes SET $field = '$value' WHERE id = $id");
        if (mysqli_affected_rows($this->con)) return true;
            else return false;
    }
}

class iClass extends iStudent
{
    private $number;
    private $litera;

    function __construct()
    {
        parent::__construct();
    }

    private function SetData()
    {
        $this->number   = $this->TextBox_value('number');
        $this->litera   = $this->TextBox_value('litera');
    }

    private function GetIsset()
    {
        return isset($_POST['number'], $_POST['litera']);
    }

    private function NoEmpty()
    {
        return !(empty($_POST['number']) || empty($_POST['litera']));
    }

    function InsertData()
    {
        if($this->GetIsset())
        {
            if($this->NoEmpty())
            {
                $this->SetData();
                $insert = mysqli_query($this->con,"INSERT INTO `classes`(number, litera) 
VALUES('$this->number','$this->litera')");

                if($insert)
                    $this->msg("success", "Данные успешно добавлены в базу данных.");
                else
                    $this->msg("failed", "Добавление данных в базу данных провалено.");

            }
            else
                $this->msg("failed", "Пожалуйста заполните все поля!");
        }
        else
        {
            http_response_code(404);
            echo "404 Page Not Found!";
        }
    }

    function GetOptionData($option)
    {
        $get_data = mysqli_query($this->con, "SELECT * FROM classes");

        if(mysqli_num_rows($get_data) > 0)
        {
            while($row = mysqli_fetch_assoc($get_data))
            {
                if ($option)
                {
                    echo "<option>" . $row['number'] . $row['litera'] . "</option>";
                }
                else
                {
                    echo '<tr>';

                          $this->EditableDIV_TD($row['id'], $row['number'], 'number');
                          $this->EditableDIV_TD($row['id'], $row['litera'], 'litera');
                          $this->IMGButtonTD('img-button-del-class', $row['id'],'../img/minus-square-regular.png');

                    echo '</tr>';
                }
            }
        }
    }
}