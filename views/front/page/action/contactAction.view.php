<?php
include ('assets/PHPMailer/PHPMailerAutoload.php');
session_start("");

if(!empty($_POST['mail']) && !empty($_POST['name'])  && !empty($_POST['subject']) && isset($_POST["content"])) {

$mailFrom = htmlentities(trim($_POST['mail']));
$nameFrom = htmlentities(trim($_POST['name']));
$subject = htmlentities(trim($_POST['subject']));
$content = htmlentities(trim($_POST['content']));

$mail = new PHPMailer();
$mail ->IsSmtp();
$mail ->SMTPDebug = 0;
$mail ->SMTPAuth = true;
$mail ->SMTPSecure = 'ssl';
$mail ->Host = "smtp.gmail.com";
$mail ->Port = 465; // or 587
$mail ->IsHTML(true);

// Authentification
$mail->Username = "esgi.aire@gmail.com";
$mail->Password = "3iw1Esgi%75013";

// Expéditeur
$mail->SetFrom($mailFrom, $nameFrom);
// Destinataire
$mail->AddAddress(MAIN_ADMIN_ADRESS, MAIN_ADMIN_NOM);
// Objet
$mail->Subject = $subject;

// Votre message
$mail->MsgHTML('from'.$mailFrom.
    '<br>
    Name'.$nameFrom.
    '<br>
    Content :'.$content
);
?>

<div>
    <?php
    // Envoi du mail avec gestion des erreurs
    if(!$mail->Send()) {
        echo 'Erreur : ' . $mail->ErrorInfo;
    } else {
        echo 'Message envoyé !';
    }
    ?>
</div>

<?php }
?>