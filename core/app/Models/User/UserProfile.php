<?php

namespace App\Models\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserProfile extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function isUserLevelColumnExists()
    {
        $tableName = $this->getTable();

        if (!Schema::hasColumn($tableName, 'level')) {
            Schema::table($tableName, function (Blueprint $table) {
                $table->tinyInteger('level')->default(1);
            });
        }
    }


    public function user()
    {
        return $this->belongTo(User::class, 'user_id', 'id');
    }

    public  static function scopeLevel($query, $userId)
    {
        $self = new self();

        $self->isUserLevelColumnExists();

        return $query->where('user_id', $userId)->value('level');
    }

    public  static function upLevel($query, $userId)
    {
        $self = new self();

        $self->isUserLevelColumnExists();

        $user = $query->where('user_id', $userId)->first();
        $user->level += 1;
        $user->save();
    }
}
