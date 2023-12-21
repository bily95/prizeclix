<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CronJob;
use App\Models\Language;
use App\Models\OfferLog;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\AdminNotification;
use App\Http\Controllers\Controller;
use Modules\OffersNetwork\Entities\Category;
use Modules\OffersNetwork\Entities\OffersStorage;
use Modules\OffersNetwork\Http\Services\Providers\Monlix;
use Modules\OffersNetwork\Http\Services\Providers\Wannads;
use Modules\OffersNetwork\Http\Services\Providers\Kiwiwall;
use Modules\OffersNetwork\Http\Services\Providers\CPXResearch;



class SiteController extends Controller
{

    public function notifications()
    {
        $notifications = AdminNotification::orderBy('id', 'desc')->with('user')->paginate();
        return view('admin.notifications', compact('notifications'));
    }

    public function notificationRead($id)
    {
        $notification = AdminNotification::findOrFail($id);
        $notification->read_status = 1;
        $notification->save();
        return redirect($notification->click_url);
    }

    public function notificationReadAll()
    {
        AdminNotification::where('read_status', 0)->update([
            'read_status' => 1
        ]);
        $notify[] = ['success', 'Notifications read successfully'];
        return back()->withNotify($notify);
    }

    public function deleteNotify($id)
    {
        AdminNotification::where('id', $id)->delete();
        $notify[] = ['success', 'Notifications deleted successfully'];
        return back()->withNotify($notify);
    }



    public function changeLanguage($lang = null)
    {
        $language = Language::where('code', $lang)->first();
        if (!$language)
            $lang = 'en';
        session()->put('lang', $lang);
        return redirect()->back();
    }

    /**
     * @param null $size
     */
    public function placeholderImage($size = '')
    {
        $imgWidth = explode('x', $size)[0];
        $imgHeight = explode('x', $size)[1];
        $text = $imgWidth . '×' . $imgHeight;
        $fontFile = dirname(__DIR__, 4) . '/asset/static/app/fonts/Ubuntu/Ubuntu-Bold.ttf';
        $fontSize = round(($imgWidth - 50) / 8);
        if ($fontSize <= 9) {
            $fontSize = 9;
        }
        if ($imgHeight < 100 && $fontSize > 30) {
            $fontSize = 30;
        }

        $image = imagecreatetruecolor($imgWidth, $imgHeight);
        $colorFill = imagecolorallocate($image, 100, 100, 100);
        $bgFill = imagecolorallocate($image, 175, 175, 175);
        imagefill($image, 0, 0, $bgFill);
        $textBox = imagettfbbox($fontSize, 0, $fontFile, $text);
        $textWidth = abs($textBox[4] - $textBox[0]);
        $textHeight = abs($textBox[5] - $textBox[1]);
        $textX = ($imgWidth - $textWidth) / 2;
        $textY = ($imgHeight + $textHeight) / 2;
        header('Content-Type: image/jpeg');
        imagettftext($image, $fontSize, 0, $textX, $textY, $colorFill, $fontFile, $text);
        imagejpeg($image);
        imagedestroy($image);
    }


    public function loadOffers()
    {
        if (session()->get('loading_offers_api_' . getUserIP()) == null) {
            CPXResearch::get();
            Monlix::get();
            Wannads::get();
            Kiwiwall::get();
            session()->put('loading_offers_api_' . getUserIP(), "set");
            return response()->json(['success' => 'offers init']);
        }

        return response()->json(['success' => 'offers init']);
    }

    public function getSidebarCategory()
    {
        $categories = Category::select('id', 'name')->active()->limit(15)->get();

        $finalCategories = [];

        foreach ($categories as $category) {

            $cate = Str::limit($category->name, 3, '');

            $finalCategories[] = [
                'id' => $category->id,
                'name' => $category->name,
                'count' => OffersStorage::where('category', 'like', "%" . $cate . "%")->count(),
            ];
        }
        return response()->json([
            'html' => view(SETTING['site_theme'] . 'partial.sidebar-category', [
                'categories' => $finalCategories,
            ])->render()
        ]);
    }


    public function userPublicProfile(Request $request)
    {
        $user = User::with(
            'profile:id,user_id,image,level,isPublic',
            'transactions:id,user_id,amount,trx_type,from',
            'offers:id,user_id,offer_name,amount,status',
        )->where('id', $request->userId)->firstOrFail();

        $userImage = getUserImage($user);
        $isPublic = $user->profile->isPublic;
        $userLevel = $user->profile->level;

        $totalEarnings = $user->transactions->where('trx_type', '+')->sum('amount');
        $totalEarningsLastMonth = $user->transactions->where('trx_type', '+')->where('created_at', '<=', today()->subMonth())->sum('amount');

        $totalCompletedOffers = $user->offers->where('status', 1)->count();

        $totalReferral = User::where('ref_by', $user->id)->count();

        $userOffers = OfferLog::with('users:id,username')->paginate(10,['*'], $request->input('page'));


        return view(
            SETTING['site_theme'] . 'addons.user-modal',
            compact(
                'userImage',
                'userLevel',
                'totalEarnings',
                'totalEarningsLastMonth',
                'totalCompletedOffers',
                'totalReferral',
                'userOffers'
            )
        );
    }

    public function upUserLevel()
    {
        $threshold = 100;
        $status = 1;

        try {
            // Get users with their total earnings
            $users = User::with('transactions', 'profile')->get();

            foreach ($users as $user) {
                // Calculate total earnings for the user
                $totalEarnings = $user->transactions->sum('amount');

                // Calculate the new level based on total earnings
                $newLevel = floor($totalEarnings / $threshold);

                // Update the user's level
                $user->profile->update(['level' => $newLevel]);
            }
        } catch (\Throwable $th) {
            $status = 0;
        }

        CronJob::create([
            'url' => route('site.upUserLevel'),
            'status' => $status,
        ]);
    }
}
