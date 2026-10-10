<?php
/**
 * Created by PhpStorm.
 * User: Zamzam
 * Date: 13/11/2018
 * Time: 07:07
 */
   $email_to = "direction@seatopusglobal.com";
    $name = htmlentities($_POST['nom']);
    $email_from ="direction@seatopusglobal.com";
    $message = htmlentities($_POST['message']);
    $subject = htmlentities($_POST['objet']);


// Validate the email address entered by the user
   /* if(!filter_var($email_from, FILTER_VALIDATE_EMAIL)) {
    // Invalid email address
    die("L'adresse email entrée est invalide");
    }*/

    $message = "Name: ".$name."\r\nMessage: ".$message;

    ini_set("sendmail_from",$email_from);
    $email_from=$_POST["email"];
    $sent = mail($email_to, $subject, $message,"-f".$email_from);
    if ($sent)
    {
        header("location: success.php");
     } else {
        header("location: error.php");
    }

?>
