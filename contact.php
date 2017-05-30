<?php

/*
 * Script for sending E-Mail messages.
 * 
 * Note: Please edit $sendTo variable value to your email address.
 * 
 */
require('./PHPMailer/PHPMailerAutoload.php');
$mail=new PHPMailer();
$mail->CharSet = 'UTF-8';
$mail->IsSMTP();
$mail->Host       = 'smtp.gmail.com';

$mail->SMTPSecure = 'tls';
$mail->Port       = 587;
$mail->SMTPDebug  = 1;
$mail->SMTPAuth   = true;

$mail->Username   = 'vitor.cominato@gmail.com';
$mail->Password   = 'c0cac0la';

$mail->SetFrom('contato@speedguerreiros.com', $name);
$mail->Subject    = 'Speed Guerreiros - Peça um orçamento';
$mail->AddAddress('contato@speedguerreiros.com', 'Pedido de orçamento');


$action = $_POST['action'];
if ($action == 'contact') {   
    $name = $_POST['form_data'][0]['name'];
    $lastname = $_POST['form_data'][0]['last_name'];
    $email = $_POST['form_data'][0]['email'];   
    $contact_message = $_POST['form_data'][0]['message'];
    $subject = "Speed Guerreiros - Peça um orçamento";

    if ($name == "" || $email == "" || $contact_message == "") {
        echo "Houve um problema enquanto mandávamos o e-mail. Por favor verifique os dados inseridos e tente novamente.";
        exit();
    }
    
    $message = "Nome: " . $name . "<br>"
                        . "Sobrenome: " . $lastname . "<br>"
                        . "Email: " . $email . "<br>"
                        . "Assunto: " . $subject . "<br>"
                        . "Mensagem: " . $contact_message . "<br>";
} else if ($action == 'newsletter') {
    $email = $_POST['form_data'][0]['Email'];
    $name = $email;

    if ($email == "") {
        echo "Houve um problema enquanto mandávamos o e-mail. Por favor verifique os dados inseridos e tente novamente.";
        exit();
    }
    $subject = 'Newsletter Subscribe!';
    $message = 'Newsletter Subscribe for User: ' . $email;
} else if ($action == 'comment') {
    $name = $_POST['form_data'][0]['Name'];
    $email = $_POST['form_data'][0]['Email'];
    $message = $_POST['form_data'][0]['Message'];
    // you can change default Subject for comment form here
    $subject = 'New comment!';
    
    if ($name == "" || $email == "" || $message == "") {
        echo "Houve um problema enquanto mandávamos o e-mail. Por favor verifique os dados inseridos e tente novamente.";
        exit();
    }
    
    $message = "Name: " . $name . "\r\n"
                . "Email: " . $email . "\r\n"
                . "Message: " . $message . "\r\n";
}else if ($action == 'driverApp'){
    $driver_name = $_POST['form_data'][0]['driver_name'];
    $driver_last_name = $_POST['form_data'][0]['driver_last_name'];
    $driver_birth_date = $_POST['form_data'][0]['date_of_birth'];
    $driver_type = $_POST['form_data'][0]['driver_type'];
    $licence_period = $_POST['form_data'][0]['licence_period'];
    $licence_type = $_POST['form_data'][0]['licence_type'];
    $phone_number = $_POST['form_data'][0]['phone_number'];
    $cell_number = $_POST['form_data'][0]['cell_number'];
    $driver_experience = $_POST['form_data'][0]['driver_experience'];

    if ($driver_name == "" || $driver_last_name == "" || $driver_experience == "") {
        echo "Houve um problema enquanto mandávamos o e-mail. Por favor verifique os dados inseridos e tente novamente.";
        exit();
    }
    
    $message = "Driver name: " . $driver_name . "\r\n"
            . "Driver last name: " . $driver_last_name . "\r\n"
            . "Date of birth: " . $driver_birth_date . "\r\n"
            . "You are: " . $driver_type . "\r\n"
            . "Licence period: " . $licence_period . "\r\n"
            . "licence_type: " . $licence_type . "\r\n"
            . "Phone number: " . $phone_number . "\r\n"
            . "Cell number: " . $cell_number . "\r\n"
            . "Driver experience: " . $driver_experience . "\r\n"; 
}
else if ($action == 'shipping') {
    $tracking_origin = $_POST['form_data'][0]['origin_zip'];
    $tracking_destination = $_POST['form_data'][0]['destination_zip'];
    $tracking_weight = $_POST['form_data'][0]['total_weight'];
    $tracking_packages = $_POST['form_data'][0]['number_of_packages'];
    $tracking_email = $_POST['form_data'][0]['email'];
    
    if ($tracking_origin == "" || $tracking_destination == "" || $tracking_email == "") {
        echo "There was problem while sending E-Mail. Please verify entered data and try again!";
        exit();
    }
    
    $message = "Origin ZIP: " . $tracking_origin . "\r\n"
            . "Destination ZIP: " . $tracking_destination . "\r\n"
            . "Total weight: " . $tracking_weight . "\r\n"
            . "Number of packages: " . $tracking_packages . "\r\n"
            . "Email: " . $tracking_email . "\r\n"; 
}
$body = $message;
$mail->MsgHTML($body);

$headers = 'From: ' . $name . '<' . $email . ">\r\n" .
        'Reply-To: ' . $email . "\r\n" .
        'X-Mailer: PHP/' . phpversion();


if(!$mail->send())
{
   echo "Message could not be sent. <p>";
   echo "Mailer Error: " . $mail->ErrorInfo;
   exit;
}else{
    echo "Mensagem enviada com sucesso.";
}

?>
