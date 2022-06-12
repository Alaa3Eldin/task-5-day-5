<?php

$file = fopen('info.txt', 'r') or die('dasddasd');

while (!feof($file)) {
    $data = explode("||", fgets($file));
    foreach ($data as $key => $value) {
        echo $value;


    }
}
fclose($file);

?>

