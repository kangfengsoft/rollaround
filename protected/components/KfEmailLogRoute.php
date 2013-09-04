<?php
class KfEmailLogRoute extends CEmailLogRoute {
	protected function sendEmail($email, $subject, $message) {
// 		$mail = new phpmailer ();
// 		$mail->IsSMTP ();
// 		$mail->Host = "smtp.163.com";
// 		$mail->SMTPAuth = true;
// 		$mail->SMTPSecure = "tls";
// 		$mail->Port = 587;
// 		$mail->Username = "kangfeng_soft@163.com";
// 		$mail->Password = "works123"; // best to keep this in your config file
// 		$mail->Subject = $subject;
// 		$mail->Body = $message;
// 		$mail->addAddress ( $email );
// 		$mail->send ();
		
		
		$mailer = Yii::createComponent ( 'application.extensions.mailer.EMailer' );
		$mailer->Host = 'smtp.163.com';
		$mailer->IsSMTP ();
		$mailer->SMTPAuth = true;
		$mailer->From = 'kangfeng_soft@163.com'; // 设置发件地址
		$mailer->AddReplyTo ( 'kangfeng_soft@163.com' );
		$mailer->AddAddress ( $email ); // 设置收件件地址
		$mailer->FromName = 'kf'; // 这里设置发件人姓名
		$mailer->Username = 'kangfeng_soft@163.com'; // 这里输入发件地址的用户名
		$mailer->Password = 'works123'; // 这里输入发件地址的密码
// 		$mailer->SMTPDebug = true; // 设置SMTPDebug为true，就可以打开Debug功能，根据提示去修改配置
		$mailer->CharSet = 'UTF-8';
		$mailer->Subject = $subject; // 设置邮件的主题
		$mailer->Body = $message;
		$mailer->Send ();
	}
}
?>