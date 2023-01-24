<?php
require_once '../config/const_queries.php';
session_start();
// Возращает пустую строку если числа нет
function only_num(array $arr, string $kay, string $empty = ''):string{
    return array_key_exists($kay, $arr) ? $arr[$kay] : $empty;
}
$num_1         = only_num($_SESSION, NUM_1);
$num_2         = only_num($_SESSION, NUM_2);
$operator      = only_num($_SESSION, OPERATOR,'addition');
$result        = only_num($_SESSION, RESULT);
$error_massage = only_num($_SESSION, ERROR_MASSAGE);
unset($_SESSION);
session_destroy();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Калькулятор</title>
</head>
<body>
    <form action="../vendor/Calculation2.php" method="post">
            <?="<input type=\"text\" name=\"".NUM_1."\" value=\"".$num_1."\">"?>

            <?="<select name=\"".OPERATOR."\" value=\"$operator\">"?>
                <option value="addition">+</option>
                <option value="subtraction">-</option>
                <option value="multiplication">*</option>
                <option value="division">/</option>
            </select>
            <?="<input type=\"text\" name=\"".NUM_2."\" value=\"$num_2\">"?>
        <button type="submit" class="button_calc"> = </button>

        <?= $result."<br/>".$error_massage?>
    </form>
</body>
</html>
