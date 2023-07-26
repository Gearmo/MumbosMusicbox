<?php

    $filenameee =  $_FILES['file']['name'];
    $fileName = $_FILES['file']['tmp_name']; 

    $contactname = $_POST['contactname'];
    $contactinfo = $_POST['contactinfo'];

    $songname = $_POST['songname'];
    $seriesname = $_POST['seriesname'];
    $looppoint = $_POST['looppoint'];

    
    $message = 
    "Name = " . $contactname . 
    "\r\nContact = " . $contactinfo . 
    "\r\n \r\nSong = " . $songname . 
    "\r\nSeries = " . $seriesname . 
    "\r\nLoop Point = " . $looppoint;
    
    $subject ="New MMB Submission!";
    $fromname = $contactname;
    $fromemail = 'noreply@mumbosmusicbox.com'; 
     
    $mailto = 'admin@mumbosmusicbox.com'; 

    $content = file_get_contents($fileName);
    $content = chunk_split(base64_encode($content));

    // a random hash will be necessary to send mixed content
    $separator = md5(time());

    // carriage return type (RFC)
    $eol = "\r\n";

    // main header (multipart mandatory)
    $headers = "From: ".$fromname." <".$fromemail.">" . $eol;
    $headers .= "MIME-Version: 1.0" . $eol;
    $headers .= "Content-Type: multipart/mixed; boundary=\"" . $separator . "\"" . $eol;
    $headers .= "Content-Transfer-Encoding: 7bit" . $eol;
    $headers .= "This is a MIME encoded message." . $eol;

    // message
    $body = "--" . $separator . $eol;
    $body .= "Content-Type: text/plain; charset=\"iso-8859-1\"" . $eol;
    $body .= "Content-Transfer-Encoding: 8bit" . $eol;
    $body .= $message . $eol;

    // attachment
    $body .= "--" . $separator . $eol;
    $body .= "Content-Type: application/octet-stream; name=\"" . $filenameee . "\"" . $eol;
    $body .= "Content-Transfer-Encoding: base64" . $eol;
    $body .= "Content-Disposition: attachment" . $eol;
    $body .= $content . $eol;
    $body .= "--" . $separator . "--";

    //SEND Mail
    if (mail($mailto, $subject, $body, $headers)) {
        header("Location:Submit-Success.html");
        exit();
        
    } else {
        header("Location:Submit-Error.html");
        exit();
    }
?>