<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';


    if(isset($_POST["sendMail"]) && isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["mailSubject"]) && isset($_POST["mailBody"])){

        $name = $_POST["name"];
        $email = $_POST["email"];
        $subject = $_POST["mailSubject"];
        $mailBody = $_POST["mailBody"];

        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->SMTPDebug = 0;
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';

        $mail->Username = 'test.fyntune@gmail.com';
        $mail->Password = 'yxslyimbjggdokzr';
        $mail->setFrom('test.fyntune@gmail.com', 'Test');
        $mail->addReplyTo('test.fyntune@gmail.com', 'Test');
        $mail->addAddress('test.fyntune@gmail.com', $name);
        $mail->isHTML(true);

        $mail->Subject = $subject;
        $mail->Body = $mailBody;

        if ($mail->send()) {                    
            $response['status'] = "success";
            $response['message'] = "Mail Send Successfully!!!";
            echo json_encode($response, JSON_PRETTY_PRINT);
        } else {
            $response['status'] = "error";
            $response['message'] = "Unable to send email!!!";
            echo json_encode($response, JSON_PRETTY_PRINT);
        }
    }
    else {
        $response['status'] = "error";
        $response['message'] = "Failed while sending email!!!";
        echo json_encode($response, JSON_PRETTY_PRINT);
    }
?>