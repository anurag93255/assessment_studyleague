<?php

// include('database.php');
class user {
    var $db;
    var $conn;
    function __construct() {
        
        // Create connection
        $conn = new mysqli("localhost", "root", "", "assessment");

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $this->db = $conn;
        
    }


    function getTotalUser() {
        return mysqli_query($this->db, "SELECT count(1) as total FROM user");
        // $res = $this->db->query("SELECT count(1) as total FROM user");
        // return $res;
    }

    function getUserPole($user_id) {
        $res = mysqli_query($this->db, "SELECT pole_no from pole WHERE user_id = {$user_id} ");
        // $res = $this->db->query("SELECT pole_no from pole WHERE user_id = {$user_id} ");
        return $res;
    }

    function getUserAmount($user_id) {
        $res = mysqli_query($this->db, "SELECT amount from user_amount WHERE user_id = {$user_id} ");
        // $res = $this->db->query("SELECT amount from user_amount WHERE user_id = {$user_id} ");
        return $res;
    }

    function incrementPoleByOne($user_id) {
        $user_pole = (mysqli_fetch_array($this->getUserPole($user_id))['pole_no'] + 1);
        return $this->db->query("UPDATE pole SET pole_no = {$user_pole} WHERE user_id = {$user_id}");
    }

    function incrementAmountByOne($user_id) {
        $user_amount = (mysqli_fetch_array($this->getUserAmount($user_id))['amount'] + 1);
        return $this->db->query("UPDATE user_amount SET amount = {$user_amount} WHERE user_id = {$user_id}");
    }

    function insertUser($arr) {
        $name = $arr['name'];
        $email = $arr['email'];
        $pole_no = $arr['pole'];
        $amount = $arr['amount'];

        $user_res = mysqli_query($this->db, "INSERT INTO user (name, email) VALUES('{$name}', '{$email}')");
        $inserted_user_id = mysqli_insert_id($this->db);
        $pole_res = $this->db->query("INSERT INTO pole (user_id, pole_no) VALUES('{$inserted_user_id}', '{$pole_no}')");
        $amount_res = $this->db->query("INSERT INTO user_amount (user_id, amount) VALUES('{$inserted_user_id}', '{$amount}')");

        if($user_res && $pole_res && $amount_res) {
            return $inserted_user_id;
        }
    }

    function getUserDetail() {
        $query = "
                SELECT u.name as 'Name',u.email as 'Email', m.amount as 'Amount', p.pole_no as 'Pole'   
                FROM user as u
                INNER JOIN pole as p ON u.id = p.user_id
                INNER JOIN user_amount as m ON u.id = m.user_id
        ";
        return mysqli_query($this->db, $query);
    }
}


/**
 * user_table{
 *  id,
 *  name,
 *  email
 * }
 * 
 * pole {
 *  user_id,
 *  pole_no
 * }
 * 
 * user_amount {
 *  user_id,
 *  amount
 * }
 */