<?php
if( isset($_POST['n']) && isset($_POST['e']) && isset($_POST['m']) ){
    $n = $_POST['n']; // HINT: use preg_replace() to filter the data
    $e = $_POST['e'];
    $m = nl2br($_POST['m']);

    $file = $_POST['f'];
    echo $file;
    echo basename($file);
    $content = file_get_contents("123.jpg", FILE_USE_INCLUDE_PATH);
    $content = chunk_split(base64_encode($content));

    $to = "suxarina1992@gmail.com";
    $from = $e;
    $subject = 'New Email from annalukiianchuk.com';
    $message = '<b>Name:</b> '.$n.' <br><b>Email:</b> '.$e.' <p>'.$m.'</p>';
    $headers = "From: $from\n";
    $headers .= "MIME-Version: 1.0\n";
    $headers .= "Content-type: text/html; charset=iso-8859-1\n";

    // a random hash will be necessary to send mixed content
    $separator = md5(time());

    // carriage return type (RFC)
    $eol = "\r\n";


    // message
    $body = "--" . $separator . $eol;
    $body .= "Content-Type: text/plain; charset=\"iso-8859-1\"" . $eol;
    $body .= "Content-Transfer-Encoding: 8bit" . $eol;
    $body .= $message . $eol;

    // attachment
    $body .= "--" . $separator . $eol;
    $body .= "Content-Type: application/octet-stream; name=\"" . basename($file) . "\"" . $eol;
    $body .= "Content-Transfer-Encoding: base64" . $eol;
    $body .= "Content-Disposition: attachment" . $eol;
    $body .= $content . $eol;
    $body .= "--" . $separator . "--";

    if( mail($to, $subject, $message, $headers) ){
        echo "success";
    } else {
        echo "The server failed to send the message. Please try again later.";
    }
}
?>