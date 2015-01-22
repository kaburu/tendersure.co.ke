<?php

$msg = "thank2.php";

$to =  "info@tendersure.co.ke";

$subject = $_POST['form_name'];

$from = $_POST['email'];

$from_header = "FROM: $from";

$contents = "\nFORM NAME:= ".$_POST['form_name'];

$contents .=  "\nFULL NAME : = ".$_POST['fullname'];

$contents .=  "\nCOUNTRY OF ORIGIN : = ".$_POST['country'];

$contents .= "\nORGANIZATION= ".$_POST['company'];

$contents .= "\nPOSTAL ADRESS := ".$_POST['postal'];

$contents .= "\nTELEPHONE := ".$_POST['telephone'];

$contents .= "\nMOBILE : = ".$_POST['mobile'];

$contents .= "\nEMAIL ADRESS : = ".$_POST['email'];

$contents .= "\nENQUIRY SUBJECT : = ".$_POST['subject'];

$contents .= "\nADDITIONAL DETAILS := ".$_POST['details'];

mail($to, $subject, $contents, $from_header);

header("Location: $msg");

?>



