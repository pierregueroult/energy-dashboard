<?php 

function getAllKeysFromArray($array) {
    $keys = [];
    foreach ($array as $key => $value) {
        array_push($keys, $key);
    }
    return $keys;
}

?>