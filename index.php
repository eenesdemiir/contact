<?php
if(isset($_POST['ad']) && isset($_POST['eposta']) && isset($_POST['konu']) && isset($_POST['mesaj'])) {
                function epostakontrol($email){if (filter_var($email, FILTER_VALIDATE_EMAIL)){return 1;}
 else {return 0;}}
                $gelen_mail = $_POST['eposta']; $mail_kontol=epostakontrol($gelen_mail);
               
   if(empty($_POST['ad']) || empty($_POST['eposta']) || empty($_POST['konu']) || empty($_POST['mesaj'])) {
      echo 'Lütfen boş yer bırakmayın.';
   } else if($mail_kontol == "0"){echo 'Lütfen e-posta adresini doğru girin.';} else{
      include 'class.phpmailer.php';
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->Host = 'enes.demir@anzera.com.tr';
$mail->Port = 587;
$mail->Username = 'mail@adresi.com';
$mail->Password = 'Mail Şifresi';
$mail->SetFrom($mail->Username, $_POST['ad']);
$mail->AddAddress('mail@site.com', 'İsim Soyisim');
$mail->CharSet = 'UTF-8';
$mail->Subject = $_POST["konu"];
$mail->MsgHTML('İsim:'.$_POST["ad"].'<br/>
Konu:'.$_POST["konu"].'<br/>
E-Posta:'.$_POST["eposta"].'<br/>
 Mesaj:'.$_POST["mesaj"].'<br/>');
if($mail->Send()) { echo 'Mesajınız başarıyla gönderildi.';}
else { echo 'Mesaj gönderirken bir hata oluştu ve girmiş olduğunuz bilgiler alınamadı.' . $mail->ErrorInfo;}
   }}
?>