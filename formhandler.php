<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){

    $firstname=htmlspecialchars($_POST['firstname']);
    $lastname=htmlspecialchars($_POST['LASTNAME']);
    $gender=htmlspecialchars($_POST['gender']);

if(empty($firstname)||empty($lastname)||$gender=="none"){
    echo"Please fill out all fields.";
}else{

echo"<h1>Form Submitted Successfully!</h1>";
echo"<p><strong>First Name:</strong>".$firstname."</p>";
echo"<p><strong>Last Name:</strong>".$lastname."</p>";
echo"<p><strong>Gender:</strong>".$gender."</p>";
}
}else{
    echo"Form was not submitted properly.";
}
?>
