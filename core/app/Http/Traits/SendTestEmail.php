<?php

namespace App\Http\Traits;


use App\Models\GeneralSetting;

trait SendTestEmail
{


    public function sendEmail($email)
    {
        $config = GENERAL_SETTING['mail_config'];
        $receiver_name = explode('@', $email)[0];
        $subject = 'Testing ' . strtoupper($config->name) . ' Mail';
        $message = 'This is a test email, please ignore it if you are not meant to get this email.';

        try {
            sendGeneralEmail($email, $subject, $message, $receiver_name);
        } catch (\Exception $exp) {
            return $exp->getMessage();
        }
        return true;
    }

}
