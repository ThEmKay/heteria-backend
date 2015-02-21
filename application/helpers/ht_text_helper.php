<?php

function umlaute($string){
    
    $string = str_replace('ä', 'a', $string);
    $string = str_replace('Ä', 'A', $string);    
    $string = str_replace('ö', 'o', $string);
    $string = str_replace('Ö', 'O', $string);    
    $string = str_replace('ü', 'u', $string);
    $string = str_replace('Ü', 'U', $string);
    $string = str_replace('/', '-', $string);
    
    return $string;
}


?>
