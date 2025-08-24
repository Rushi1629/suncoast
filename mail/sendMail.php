<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';


    if(isset($_POST["sendMail"]) && isset($_POST["mailBody"])){

        $mailBody = $_POST["mailBody"];

        $mail = new PHPMailer();
        $mail->IsSMTP(); // Using SMTP.
        $mail->SMTPDebug = 0;
        $mail->SMTPAuth = false; // Enables SMTP authentication.
        $mail->Host = "localhost";
        $mail->Port = 25;
        $mail->SMTPSecure = 'none';

        //havent read yet, but this made it work just fine
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => false
            )
        );

        $mail->Username = 'info@suncoastship.com';
        $mail->Password = '@nothing#true#86#86#';
        $mail->setFrom('info@suncoastship.com', 'SUNCOAST');
        $mail->addReplyTo('info@suncoastship.com', 'SUNCOAST');
        $mail->addAddress('shipsuncoast0@gmail.com', 'SUNCOAST');
        $mail->isHTML(true);

        $mail->Subject = "SUNCOAST FORM DATA";
        $mail->Body = $mailBody;

        if ($mail->send()) {                    
            $response['status'] = "success";
            $response['message'] = "Message Send Successfully!!!";
            echo json_encode($response, JSON_PRETTY_PRINT);
        } else {
            $response['status'] = "error";
            $response['message'] = "Something went wrong! Unable to send message!!!";
            echo json_encode($response, JSON_PRETTY_PRINT);
            //echo $mail->ErrorInfo;
        }
    }
    else {
        $response['status'] = "error";
        $response['message'] = "Failed while sending email!!!";
        echo json_encode($response, JSON_PRETTY_PRINT);
    }
?>