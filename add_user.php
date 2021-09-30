<?php
include('userModal.php');
$name = $_POST['name'];
$email = $_POST['email'];


$user = new user();
$total_user = (mysqli_fetch_array($user->getTotalUser())['total'] + 1);


switch(true) {
    case ($total_user > 14):
        $temp = ($total_user - 14 / 8);
        
        // Here we use block as user_id
        $block_id = ($temp == ceil($temp) ? ($temp + 2) : ceil($temp) + 1 );
        
        if(fmod($total_user-14, 8) == 0) {
            $user->incrementPoleByOne($block_id);
            // $user->incrementAmountByOne(1);
            if(fmod($total_user, 13*8) == 0) {
                $user->incrementPoleByOne(1);
                $user->incrementAmountByOne(1);
            }
        }
        $user->incrementAmountByOne($block_id);
        break;
    case ($total_user == 14):
        $user->incrementPoleByOne(1);
        break;
    case ($total_user < 14):
        $user->incrementAmountByOne(1);
}

$insertion_arr = [
    'name' => $name,
    'email' => $email,
    'pole' => 1,
    'amount' => 1
];
$result = $user->insertUser($insertion_arr);
header("Location: http://{$_SERVER['SERVER_NAME']}/assessment/add_user_form.php");
