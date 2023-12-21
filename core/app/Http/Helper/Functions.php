<?php


use App\Models\User;
use App\Models\Setting;
use Jenssegers\Agent\Agent;
use App\Models\GeneralSetting;
use Illuminate\Support\Carbon;
use App\Lib\GoogleAuthenticator;

function is_local()
{
    return in_array(getUserIP(), ['::1', '127.0.0.0'])
        || app()->isLocal();
}

//load one setting
function set($name, $default = 'First Insert')
{
    try {
        $value = Setting::where('name', $name)
            ->firstOrFail();
    } catch (\Exception $e) {
        $value = Setting::create([
            'name' => $name,
            'value' => $default
        ]);
    }
    return $value->value;
}


function userProfile($users = null)
{
    $user = $users !== null ? $users : auth()->user();

    $profile = User::with('profile')
        ->findOrFail($user->id)
        ->toArray();

    return $profile['profile'];
}

function userAddress()
{
    return json_decode(userProfile()['address'], true);
}

function getUserImage($users = null)
{   
    $user = $users !== null ? $users : auth()->user();

    $userImage = userProfile($user)['image'];

    if ($user->google_id)
        $image = $userImage;
    elseif ($user->profile->image)
        $image = getImage(imagePath()['users']['path'] . '/' . $userImage);
    else
        $image = "https://ui-avatars.com/api/?name=" . $user->username;


    return $image;
}

function getCountries()
{
    $countries = json_decode(file_get_contents(resource_path('js/country.json')), true);

    return array_column($countries, 'country');
}

function urlPath($routeName, $routeParam = null)
{
    if ($routeParam == null) {
        $url = route($routeName);
    } else {
        $url = route($routeName, $routeParam);
    }
    $basePath = route('user.home');
    $path = str_replace($basePath, '', $url);
    return $path;
}

//work with time
function diffForHumans($date)
{
    $lang = session()->get('lang');
    Carbon::setlocale($lang);
    return Carbon::parse($date)->diffForHumans();
}

function showDateTime($date, $format = 'Y-m-d h:i A')
{
    $lang = session()->get('lang');
    Carbon::setlocale($lang);
    return Carbon::parse($date)->translatedFormat($format);
}


//for securities
function verificationCode($length)
{
    if ($length == 0) return 0;
    $min = pow(10, $length - 1);
    $max = 0;
    while ($length > 0 && $length--) {
        $max = ($max * 10) + 9;
    }
    return random_int($min, $max);
}


//work with input fields
function inputTitle($text)
{
    return ucfirst(preg_replace("/[^A-Za-z0-9 ]/", ' ', $text));
}

function getTrx($length = 12)
{
    $characters = 'ABCDEFGHJKM123456789NOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function generateToken($length = 12)
{
    $capital = 'AZXCVBNMLKJHGFDSAQWERTYUIOP';
    $small = 'qwertyuioplkjhgfdsazxcvbnm';
    $number = '1234567890';

    $token = '';

    for ($i = 0; $i < floor($length / 3); $i++) {
        $token .= $capital[rand(0, strlen($capital) - 1)];
        $token .= $small[rand(0, strlen($small) - 1)];
        $token .= $number[rand(0, strlen($number) - 1)];
    }

    return $token;
}


function getAmount($amount, $length = 2)
{
    $amount = round($amount, $length);
    return $amount + 0;
}

function showAmount($amount, $decimal = 2, $separate = true, $exceptZeros = false)
{
    $separator = '';
    if ($separate) {
        $separator = ',';
    }
    $printAmount = number_format($amount, $decimal, '.', $separator);
    if ($exceptZeros) {
        $exp = explode('.', $printAmount);
        if ($exp[1] * 1 == 0) {
            $printAmount = $exp[0];
        }
    }
    return $printAmount;
}


//moveable
function curlContent($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

//moveable
function curlPostContent($url, $arr = null)
{
    if ($arr) {
        $params = http_build_query($arr);
    } else {
        $params = '';
    }
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}



function verifyG2fa($user, $code, $secret = null)
{
    $ga = new GoogleAuthenticator();
    if (!$secret) {
        $secret = $user->tsc;
    }
    
    $oneCode = $ga->getCode($secret);
    
    $userCode = $code;
    
    if ($oneCode == $userCode) {
        $user->tv = 1;
        $user->save();
        return true;
    } else {
        return false;
    }
}



function getUserIP()
{
    // Get real visitor IP behind CloudFlare network
    if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
        $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
        $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
    }
    $client = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote = @$_SERVER['REMOTE_ADDR'];

    if (filter_var($client, FILTER_VALIDATE_IP)) {
        $ip = $client;
    } elseif (filter_var($forward, FILTER_VALIDATE_IP)) {
        $ip = $forward;
    } else {
        $ip = $remote;
    }

    return $ip;
}


//moveable
/**
 * @return mixed
 */
function getIpInfo()
{

    $ip = getUserIP();

    $request = curlContent('http://ip-api.com/json/' . $ip);

    $response = json_decode($request, true);

    $data['country'] = @$response['country'] ?? '';
    $data['code'] = @$response['countryCode'] ?? '';
    $data['city'] = @$response['city'] ?? '';
    $data['region'] = @$response['regionName'] ?? '';
    $data['area'] = '';
    $data['long'] = '';
    $data['lat'] = @$response['lat'] ?? '';

    $data['ip'] = request()->ip();
    $data['time'] = date('d-m-Y h:i:s A');

    return $data;
}

//moveable
/**
 * @return mixed
 */
function osBrowser()
{
    $userAgent = $_SERVER['HTTP_USER_AGENT'];
    $osPlatform = "Unknown OS Platform";
    $osArray = array(
        '/windows nt 10/i' => 'Windows 10',
        '/windows nt 6.3/i' => 'Windows 8.1',
        '/windows nt 6.2/i' => 'Windows 8',
        '/windows nt 6.1/i' => 'Windows 7',
        '/windows nt 6.0/i' => 'Windows Vista',
        '/windows nt 5.2/i' => 'Windows Server 2003/XP x64',
        '/windows nt 5.1/i' => 'Windows XP',
        '/windows xp/i' => 'Windows XP',
        '/windows nt 5.0/i' => 'Windows 2000',
        '/windows me/i' => 'Windows ME',
        '/win98/i' => 'Windows 98',
        '/win95/i' => 'Windows 95',
        '/win16/i' => 'Windows 3.11',
        '/macintosh|mac os x/i' => 'Mac OS X',
        '/mac_powerpc/i' => 'Mac OS 9',
        '/linux/i' => 'Linux',
        '/ubuntu/i' => 'Ubuntu',
        '/iphone/i' => 'iPhone',
        '/ipod/i' => 'iPod',
        '/ipad/i' => 'iPad',
        '/android/i' => 'Android',
        '/blackberry/i' => 'BlackBerry',
        '/webos/i' => 'Mobile'
    );
    foreach ($osArray as $regex => $value) {
        if (preg_match($regex, $userAgent)) {
            $osPlatform = $value;
        }
    }
    $browser = "Unknown Browser";
    $browserArray = array(
        '/msie/i' => 'Internet Explorer',
        '/firefox/i' => 'Firefox',
        '/safari/i' => 'Safari',
        '/chrome/i' => 'Chrome',
        '/edge/i' => 'Edge',
        '/opera/i' => 'Opera',
        '/netscape/i' => 'Netscape',
        '/maxthon/i' => 'Maxthon',
        '/konqueror/i' => 'Konqueror',
        '/mobile/i' => 'Handheld Browser'
    );
    foreach ($browserArray as $regex => $value) {
        if (preg_match($regex, $userAgent)) {
            $browser = $value;
        }
    }

    $data['os_platform'] = $osPlatform;
    $data['browser'] = $browser;

    return $data;
}


function getDeviceType()
{
    $agent = new Agent();

    if ($agent->isDesktop()) {
        return 'windows';
    } elseif ($agent->isAndroidOS()) {
        return 'android';
    } elseif ($agent->isiPhone()) {
        return 'iphone';
    } elseif ($agent->isiPad()) {
        return 'ipad';
    } elseif ($agent->isTablet()) {
        return 'tablet';
    } else {
        return 'unknown';
    }
}


/**
 * @param $id
 * @param $amount
 * @param string $commissionType
 * @return int
 */
function rewardReferral($id, $amount, $commissionType = '')
{
    $usr = $id;
    $i = 1;
    $gnl = GeneralSetting::first();
    $level = \App\Models\Referral::where('commission_type', $commissionType)->count();
    while ($usr != "" || $usr != "0" || $i < $level) {
        $me = \App\Models\User::find($usr);
        $refer = \App\Models\User::find($me->ref_by);
        if ($refer == "") {
            break;
        }
        $comission = \App\Models\Referral::where('commission_type', $commissionType)->where('level', $i)->first();
        if ($comission == null) {
            break;
        }
        $com = ($amount * $comission->percent) / 100;
        $referWallet = \App\Models\User::where('id', $refer->id)->first();
        $new_bal = getAmount($referWallet->balance + $com);
        $referWallet->balance = $new_bal;
        $referWallet->save();
        $trx = getTrx();

        $comLog = \App\Models\CommissionLog::create([
            'to_id' => $refer->id,
            'from_id' => $id,
            'level' => $i,
            'amount' => getAmount($com),
            'main_amo' => $new_bal,
            'commission_type' => $commissionType,
            'title' => 'level ' . $i . ' Referral Commission From ' . $me->username,
            'percent' => $comission->percent,
            'trx' => $trx,
        ]);

        //save transactions
        \App\Models\Transaction::store([
            'user' => $referWallet,
            'amount' => getAmount($com),
            'from' => 'REFERRAL_COMMISSION',
            'source_id' => $comLog->id,
            'details' => 'Referral Commission'
        ]);

        notify($refer, 'REFERRAL_COMMISSION', [
            'amount' => getAmount($com),
            'post_balance' => $new_bal,
            'trx' => $trx,
            'level' => 'level ' . $i . ' Referral Commission',
            'currency' => $gnl->cur_text
        ]);
        $usr = $refer->id;
        $i++;
    }
    return 0;
}


//work the boolean value in database
function bolToText($value, $html = false, ...$txt)
{
    switch ($value) {
        case 0:
            $line = $html ? "<span class='text-white rounded bg-danger px-1'>{$txt[0]}</span>" : $txt[0];
            break;
        case 1:
            $line = $html ? "<span class='text-white rounded bg-success px-1'>{$txt[1]}</span>" : $txt[1];
            break;
        case 2:
            $line = $html ? "<span class='text-white rounded bg-info px-1'>{$txt[2]}</span>" : $txt[2];
            break;
        case 4:
            $line = $html ? "<span class='text-white rounded bg-warning px-1'>{$txt[3]}</span>" : $txt[3];
            break;
        default:
            $line = $html ? "<span class='text-white rounded bg-danger px-1'>Undefined</span>" : 'UnDefined';
            break;
    }

    return $line;
}
