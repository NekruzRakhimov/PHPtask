<?php
     if($_POST["done"])
     {
          $input = fopen("input.txt", 'r');
          $positive = fopen("positive.txt", 'w+t');
          $negative = fopen("negative.txt", 'w+t');

          $op = $_POST["operation"];
          if(strpos("*/+-xX", $op) === false)
               require_once "error.php";
          else
               require_once "success.php";
          $positiveResult = "";
          $negativeResult = "";

          while(!feof($input)){
               $str = htmlentities(fgets($input));
               if($str == "") 
                    continue;
               $arr = explode(" ", $str);
               $num1 = $arr[0];
               $num2 = $arr[1];

               if($op == "*" || $op == "x" || $op == "X") {
                    if($num1 * $num2 >= 0)
                         $positiveResult .= $num1 * $num2."\n";
                    else
                         $negativeResult .= $num1 * $num2."\n";
               }
               else if($op == "/") {
                    if($num2 == 0)
                    $positiveResult .= "Division by zero is impossible"."\n"; 
                    else if($num1 / $num2 >= 0)
                         $positiveResult .= $num1 / $num2."\n";
                    else
                         $negativeResult .= $num1 / $num2."\n";
               }
               else if($op == "+") {
                    if($num1 + $num2 >= 0)
                         $positiveResult .= $num1 + $num2."\n";
                    else
                         $negativeResult .= $num1 + $num2."\n";
               }
               else if($op == "-") {
                    if($num1 - $num2 >= 0)
                         $positiveResult .= $num1 - $num2."\n";
                    else
                         $negativeResult .= $num1 - $num2."\n";
               }
          }


          fwrite($negative, $negativeResult);
          fwrite($positive, $positiveResult);

          fclose($input);
          fclose($positive);
          fclose($negative);
     }
     
?>

<!DOCTYPE html>
<html lang="en">
     <head>
          <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <link rel="stylesheet" href="/css/style.css">
          <title>Работа с Файлами</title>
     </head>
     <body>
          <div class="wrapper">
               <div class="title">Введите один из данных оппераций</div>
               <div class="options">(*, /, +, -)</div>
               <form name="test" action="" method="POST">  
                    <input type="text" name="operation" maxlength="1" class="operation" required autocomplete="off"></input>
                    <input type="submit" name="done" value="ГОТОВО" class="btn">
               </form>
          </div>
     </body>
</html>