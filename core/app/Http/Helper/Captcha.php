<?php


namespace App\Http\Helper;

use App\Models\Setting;

/**
 * Class Captcha
 * @package App\Helper
 */
class Captcha
{
  
    /**
     *
     * @return string
     */

    public function create()
    {

        $captcha = '';
        switch (SETTING['default_captcha']) {
            case 'Recaptcha':
                $captcha = '
        <div class="g-recaptcha" data-sitekey="' . SETTING['re_public_key'] .
                    '" id="recaptcha"></div><script src="https://www.google.com/recaptcha/api.js"></script>';
                break;
            case 'hcaptcha':
                $captcha = '<script src="https://hcaptcha.com/1/api.js" async defer></script>'
                    . '<div class="h-captcha" data-sitekey="' . SETTING['hc_public_key'] . '"></div>';
                break;
            case 'raincaptcha':
                $captcha = '<div id="rain-captcha" data-key="' .
                    SETTING['rain_public_key'] .
                    '"></div><script src="https://raincaptcha.com/base.js" type="application/javascript"></script>';
                break;
        }

        return $captcha;
    }

    public function token()
    {
        switch (SETTING['default_captcha']) {
            case 'Recaptcha':
                $token = 'g-recaptcha-response';
                break;
            case 'hcaptcha':
                $token = 'h-captcha-response';
                break;
            case 'raincaptcha':
                $token = 'rain-captcha-response';
                break;
        }

        return $token;
    }

    //check Recaptcha function

    public function check($token = null)
    {
        switch (SETTING['default_captcha']) {
            case 'Recaptcha':
                $captcha = $this->recaptcha($token['g-recaptcha-response']);
                if (!$captcha) {
                    return FALSE;
                }
                else{
                    return TRUE;
                }
                break;

            case 'hcaptcha':
                $captcha = $this->hcaptcha($token);
                if (!$captcha) {
                    return FALSE;
                }
                break;
            case 'raincaptcha':
                $captcha = $this->rainCaptcha(($token));
                if (!$captcha) {
                    return FALSE;
                }
                break;
        }

        return TRUE;
    }

    // check hcaptcha Functions

    public function recaptcha($response)
    {
           $data = array('secret' =>  SETTING['re_secret_key'],
            'response' => $response);
  
        try {
            $verify = curl_init();
            curl_setopt($verify, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
            curl_setopt($verify, CURLOPT_POST, true);
            curl_setopt($verify, CURLOPT_POSTFIELDS, 
                        http_build_query($data));
            curl_setopt($verify, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($verify);
            $response = json_decode($response);
            return $response->success;
        }
        catch (\Exception $e) {
            return false;
        }
    }

    public function hcaptcha($response)
    {
        if ($ch = curl_init()) {
            $post_data = array('response' => $response, 'secret' => SETTING['hc_secret_key']);
            curl_setopt($ch, CURLOPT_URL, 'https://hcaptcha.com/siteverify');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            // Execute the cURL request.
            $result_json = curl_exec($ch);
            curl_close($ch);
            $result = @json_decode($result_json, true);
            if ((!empty($result['success'])) && ($result['success'] == true)) {
                return true;
            }
        }
        return false;
    }

    public function rainCaptcha($post)
    {

        if (!extension_loaded('soap'))
            die('Soap Extension is require for verify Rain Captcha');

        $client = new \SoapClient('https://raincaptcha.com/captcha.wsdl');
        $response = $client->send(SETTING['rain_secret_key'], $post, $_SERVER['REMOTE_ADDR']);

        if ($response->status === 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}
