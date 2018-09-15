<?php
require 'PHPMailer/PHPMailerAutoload.php';
try {
    if(isset($_POST['email_send'])) {
        $mail = new PHPMailer;
        $mail->FromName = $_POST['u_name'];
        $to_email = $_POST['u_email'];
        $mail->AddAddress($to_email);
        $mail->From = "admin@asdasd.com";
        $mail->Subject = "Test Email Send using PHP";
        $body = "<table>
<tr>
<th colspan='2'>This is a test email</th>
</tr>
<tr>
<td>Name :</td>
<td>".$_POST['u_name']."</td>
</tr>
<tr>
<td>E-mail : </td>
<td>".$_POST['u_email']."</td>
</tr>
<tr>
<td>Message : </td>
<td>".$_POST['message']."</td>
</tr>
<table>";
        $body = preg_replace('/\\\\/','', $body);
        $mail->MsgHTML($body);
        $mail->IsSendmail();
        $mail->AddReplyTo("admin@phpzag.com");
        $mail->AltBody = "To view the message, please use an HTML compatible email viewer!";
        $mail->WordWrap = 80;
        $mail->AddAttachment($_FILES['attach']['tmp_name'], $_FILES['attach']['name']);
        $mail->IsHTML(true);
        $mail->Send();
        echo 'The message has been sent.';
    }
} catch (phpmailerException $e) {
    echo $e->errorMessage();
}
?>