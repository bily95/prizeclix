<?php


namespace App\Models\Services;


use App\Models\User;
use App\Models\Deposit;
use App\Models\LiveChat;
use App\Models\UserLogin;
use App\Models\Withdrawal;
use App\Models\Transaction;
use App\Models\CommissionLog;
use App\Models\SupportTicket;
use App\Models\OfferLog;
use App\Models\User\UserProfile;

trait UserRelations
{

    public function profile()
    {
        return $this->hasOne(UserProfile::class,'user_id', 'id');
    }
    public function login_logs()
    {
        return $this->hasMany(UserLogin::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class)->orderBy('id', 'desc');
    }

    public function deposits()
    {
        return $this->hasMany(Deposit::class)->where('status', '!=', 0);
    }

    public function withdrawals()
    {
        return $this->hasMany(Withdrawal::class)->where('status', '!=', 0);
    }

    public function tickets()
    {
        return $this->hasMany(SupportTicket::class);
    }

    public function referral()
    {
        return $this->hasMany(User::class, 'ref_by');
    }

    public function commissions()
    {
        return $this->hasMany(CommissionLog::class, 'to_id');
    }

    public function offers()
    {
        return $this->hasMany(OfferLog::class, 'user_id', 'id');
    }


    public function chats()
    {
        return $this->hasMany(LiveChat::class, 'user_id', 'id');
    }

}
