<?php

$id = $_REQUEST['id'];
$column=$_REQUEST['column'];
$value=$_REQUEST['value'];

$query=mysqli_query("UPDATE main_class_tbl
SET
$column='$value'
WHERE    main_class_id = '$id'");
//print_r($column);


if($query)
{
    echo "sucess";
}

else
    die(mysqli_error());
?>