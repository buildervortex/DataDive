<?php

function getMainCategoryData(){
    $data = array(
        0=>"It",
        1=>"Science",
        2=>"Maths",
        3=>"Graphic Design",
        4=>"Digital Marketing",
        5=>"Life style",
        6=>"Buisness",
        7=>"Languages",
        8=>"Art",
        9=>"Music"
    );

    return json_encode($data,JSON_FORCE_OBJECT);
}

echo getMainCategoryData();

?>