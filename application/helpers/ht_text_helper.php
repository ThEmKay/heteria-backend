<?php

function umlaute($string){
    
    $string = str_replace('�', 'a', $string);
    $string = str_replace('�', 'A', $string);    
    $string = str_replace('�', 'o', $string);
    $string = str_replace('�', 'O', $string);    
    $string = str_replace('�', 'u', $string);
    $string = str_replace('�', 'U', $string);
    $string = str_replace('/', '-', $string);
    
    return $string;
}


?>
