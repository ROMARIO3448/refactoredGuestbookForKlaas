<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class GuestbookMailer 
{
    static public function sendMail($email, $name): array
    {
        include_once "./vendor/phpmailer/phpmailer/src/PHPMailer.php";
        include_once "./vendor/phpmailer/phpmailer/src//SMTP.php";
        include_once "./vendor/phpmailer/phpmailer/src/Exception.php";

        $token = 'qwertzuiopasdfghjklyxcvbnmQWERTZUIOPASDFGHJKLYXCVBNM0123456789!$/()*';
        $token = str_shuffle($token);
        $token = substr($token, 0, 10);

        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = "smtp.gmail.com";
            $mail->SMTPAuth = true;
            $mail->Username= "romario344896@gmail.com";
            $mail->Password = "vjwpxwvuxpbyxfgn";
            $mail->SMTPSecure = "ssl";
            $mail->Port = 465;

            $mail->setFrom("romario344896@gmail.com");
            $mail->addAddress($_POST["email"]);
            $mail->isHTML(true);
            $mail->Subject = "Verify your email to create your Guestbook account";
            $mail->Body = "
            Hello $name,
            Thanks for your interest in creating an Guestbook account. To create your account, 
            please verify your email address by clicking below.<br><br>
            <a href='http://localhost/refactoredGuestbookForKlaas/confirm_email?email=$email&token=$token'>Click Here</a>
            <br><br>
            Thanks.
            ";

            if ($mail->send())
            {
                return array("token" => $token, "isMailSuccesfull" => true);
            }
            else
            {
                return array("token" => $token, "isMailSuccesfull" => false);
            }
        } 
        catch (Exception $e) {
            $problemDescription .= $e->getMessage()."\n";
        }
    }
}