<?php
require_once("../admin/db_connect/config.php");
require_once('../admin/controllers/datachecker.class.php');

class User {

    public $id;
    public $username;
    public $password;
    public $db;

    function __construct(){																// Создание юзера из базы данных
        $this->db = Db_connect::gI();
    }

    function logout(){																	// Выход юзера, удаление сессии, и объекта
        session_unset();
        session_destroy();
        return NULL;
    }

    function login(){

        unset($_SESSION['user_id']);
        unset($_SESSION['customer_id']);
        unset($_SESSION['error']);

        $username = DataChecker::checkLatinText($_POST['username']);
        $password = DataChecker::checkPassword(md5($_POST['password']));
        $query = "SELECT id, customer_id FROM users WHERE user_login = '".$username."' AND user_password = '".$password."' LIMIT 1";
        $result=$this->db->query($query);
        if($result){
            $user_data = $result->fetch();
        }
        if(!empty($user_data)){
            $_SESSION['user_id'] = $user_data['id'];
            $_SESSION['customer_id'] = $user_data['customer_id'];
            unset($_SESSION['error']);
        } else {
            $_SESSION['error'] = true;
        }
        return true;
    }

    function CheckIfUsernameExists($username){													// Проверяем, занято ли имя
        $username = mysql_real_escape_string($username);
        $query = "SELECT user_login FROM users WHERE user_login = '".$username."'";
        $result=$this->db->query($query);
        $user_data = $result->fetch();
        if(!empty($user_data)){
            return false;
        } else {
            return true;
        }
    }

    function CheckIfEmailExists($email){															// Проверяем, занята ли почта
        $email = mysql_real_escape_string($email);
        $query = "SELECT email FROM users WHERE email = '".$email."'";
        $result=$this->db->query($query);
        $user_data = $result->fetch();
        if(!empty($user_data)){
            return false;
        } else {
            return true;
        }
    }

    function RegisterNew(){																	// Если при регистрации не возникло ошибок, добавляем юзера в БД
        $email = mysql_real_escape_string($_POST['email']);
        $username = mysql_real_escape_string($_POST['username']);
        $password = mysql_real_escape_string($_POST['password']);
        $name = mysql_real_escape_string($_POST['name']);
        $surname = mysql_real_escape_string($_POST['surname']);

        if ($this->db->query("INSERT INTO users SET email = '".$email."', user_login = '".$username."', password = '".$password."', name = '".$name."', surname = '".$surname."'")){
            return true;
        } else {
            return false;
        }
    }

}