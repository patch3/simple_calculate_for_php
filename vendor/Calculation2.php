<?php
require_once '../config/const_queries.php';
session_start();

try {
    if(!isset($_POST[NUM_1], $_POST[NUM_2], $_POST[OPERATOR])){
        throw new Exception("Не определены запросы");
    }
    $_SESSION[NUM_1]    = $num_1    = $_POST[NUM_1];
    $_SESSION[NUM_2]    = $num_2    = $_POST[NUM_2];
    $_SESSION[OPERATOR] = $operator = $_POST[OPERATOR];

    $error_fields=[];
    if(empty($num_1)){
        $error_fields[]=$num_1;
    }
    if(empty($num_2)){
        $error_fields[]=$num_2;
    }
    if(empty($operator)){
        $error_fields[]=$operator;
    }
    if(!empty($error_fields)){
        $_SESSION['fields'] = $error_fields;
        throw new Exception("Ошибка в пустых полях ". print_r($error_fields));
    }
    
    if(!is_numeric($num_1)){
        $error_fields[]=$num_1;
    } if (!is_numeric($num_2)){
        $error_fields[]=$num_2;
    }
    if(!empty($error_fields)){
        $_SESSION['fields'] = $error_fields;
        throw new Exception("Поля не являются числом");
    }

    switch($operator){
        case 'addition':
            $result = $num_1 + $num_2;
            break;
        case 'subtraction':
            $result = $num_1 - $num_2;
            break;
        case 'multiplication':
            $result = $num_1 * $num_2;
            break;
        case 'division':
            if ($num_2 == 0) $result = '∞';
            else $result = $num_1 / $num_2;
            break;
        default:
            throw new Exception("Не опреденнён оператор");
    }
    $_SESSION[STATUS] = true;
    $_SESSION[RESULT] = $result;
}catch(Exception $ex){
    $_SESSION[STATUS] = false;
    $_SESSION[ERROR_MASSAGE] = 'Error: '.$ex->getMessage();
}
header('Location: ../markup/calc.php');