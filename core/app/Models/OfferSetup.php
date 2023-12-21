<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class OfferSetup extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'offer_keys' => 'object',
        'offer_params' => 'object',
    ];


    public function checkEnableAPIColumn()
    {
        $tableName = $this->getTable();

        if(!Schema::hasColumn($tableName, 'user_level')){
            Schema::table($tableName, function(Blueprint $table){
                $table->tinyInteger('user_level')->default(1);
            });
        }
    }

    public function log()
    {
        return $this->hasMany(OfferLog::class, 'offer_id', 'id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
