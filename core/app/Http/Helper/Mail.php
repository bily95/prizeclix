<?php


use App\Models\EmailLog;
use App\Models\EmailTemplate;
use PHPMailer\PHPMailer\PHPMailer;

function notify($user, $type, $shortCodes = null)
{
    try {
        sendEmail($user, $type, $shortCodes);
    } catch (\Throwable $th) {
    }
}


function sendEmail($user, $type = null, $shortCodes = [])
{
    

    $emailTemplate = EmailTemplate::where('act', $type)->where('email_status', 1)->first();
    if (!$emailTemplate) {
        return;
    }

    $message = str_replace("{{fullname}}", $user->fullname, GENERAL_SETTING['email_template']);
    $message = str_replace("{{username}}", $user->username, $message);
    $message = str_replace("{{message}}", $emailTemplate->email_body, $message);

    if (empty($message)) {
        $message = $emailTemplate->email_body;
    }

    foreach ($shortCodes as $code => $value) {
        $message = str_replace('{{' . $code . '}}', $value, $message);
    }

    $config = GENERAL_SETTING['mail_config'];

    $emailLog = new EmailLog();
    $emailLog->user_id = $user->id;
    $emailLog->mail_sender = $config->name;
    $emailLog->email_from = SETTING['siteName'] . ' ' . SETTING['siteEmail'];
    $emailLog->email_to = $user->email;
    $emailLog->subject = $emailTemplate->subj;
    $emailLog->message = $message;
    $emailLog->save();


    if ($config->name == 'php') {
        sendPhpMail($user->email, $user->username, $emailTemplate->subj, $message);
    } else if ($config->name == 'smtp') {
        sendSmtpMail($config, $user->email, $user->username, $emailTemplate->subj, $message);
    } else if ($config->name == 'sendgrid') {
        sendSendGridMail($config, $user->email, $user->username, $emailTemplate->subj, $message);
    } else if ($config->name == 'mailjet') {
        sendMailjetMail($config, $user->email, $user->username, $emailTemplate->subj, $message);
    }
}


function sendPhpMail($receiver_email, $receiver_name, $subject, $message)
{
    $headers = "From: " . SETTING['siteName'] . " <" . SETTING['siteEmail'] . "> \r\n";
    $headers .= "Reply-To: " . SETTING['siteName'] . " <" . SETTING['siteEmail'] . "> \r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=utf-8\r\n";
    @mail($receiver_email, $subject, $message, $headers);
}


function sendSmtpMail($config, $receiver_email, $receiver_name, $subject, $message)
{
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();
        //  $mail->SMTPDebug = true;
        $mail->Host = $config->host;
        $mail->isSMTP();

        $mail->SMTPAuth = false;
        $mail->Username = $config->username;
        $mail->Password = $config->password;
        if ($config->enc == 'ssl') {
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        } else {
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        }
        $mail->Port = $config->port;
        $mail->CharSet = 'UTF-8';
        //Recipients
        $mail->setFrom(SETTING['siteEmail'], SETTING['siteName']);
        $mail->addAddress($receiver_email, $receiver_name);
        $mail->addReplyTo(SETTING['siteEmail'], SETTING['siteName']);
        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $message;
        $mail->send();
    } catch (Exception $e) {
        //dd($e->getMessage());
        logger($e->getMessage());
    }
}


function sendSendGridMail($config, $receiver_email, $receiver_name, $subject, $message)
{
    $sendgridMail = new \SendGrid\Mail\Mail();
    $sendgridMail->setFrom(SETTING['siteEmail'], SETTING['siteName']);
    $sendgridMail->setSubject($subject);
    $sendgridMail->addTo($receiver_email, $receiver_name);
    $sendgridMail->addContent("text/html", $message);
    $sendgrid = new \SendGrid($config->appkey);
    try {
        $response = $sendgrid->send($sendgridMail);
    } catch (Exception $e) {
        throw new Exception($e);
    }
}


function sendMailjetMail($config, $receiver_email, $receiver_name, $subject, $message)
{
    $mj = new \Mailjet\Client($config->public_key, $config->secret_key, true, ['version' => 'v3.1']);
    $body = [
        'Messages' => [
            [
                'From' => [
                    'Email' => SETTING['siteEmail'],
                    'Name' => SETTING['siteName'],
                ],
                'To' => [
                    [
                        'Email' => $receiver_email,
                        'Name' => $receiver_name,
                    ]
                ],
                'Subject' => $subject,
                'TextPart' => "",
                'HTMLPart' => $message,
            ]
        ]
    ];
    $response = $mj->post(\Mailjet\Resources::$Email, ['body' => $body]);
}


//moveable
function sendGeneralEmail($email, $subject, $message, $receiver_name = '')
{

    if (GENERAL_SETTING['en'] != 1 || !SETTING['siteEmail']) {
        return;
    }


    $message = str_replace("{{message}}", $message, GENERAL_SETTING['email_template']);
    $message = str_replace("{{fullname}}", $receiver_name, $message);
    $message = str_replace("{{username}}", $email, $message);

    $config = GENERAL_SETTING['mail_config'];

    if ($config->name == 'php') {
        sendPhpMail($email, $receiver_name, $subject, $message);
    } else if ($config->name == 'smtp') {
        sendSmtpMail($config, $email, $receiver_name, $subject, $message);
    } else if ($config->name == 'sendgrid') {
        sendSendGridMail($config, $email, $receiver_name, $subject, $message);
    } else if ($config->name == 'mailjet') {
        sendMailjetMail($config, $email, $receiver_name, $subject, $message);
    }
}
