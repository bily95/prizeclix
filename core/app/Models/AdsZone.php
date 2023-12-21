<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdsZone extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function addAds($validated)
    {
        return self::create([
            'name' => $validated['name'],
            'contents' => $validated['contents'],
            'size' => $validated['size'],
            'isActive' => true,
        ]);
    }

    public static function updateAds($adsId, $validated)
    {
        return self::where('id', $adsId)->update([
            'name' => $validated['name'],
            'contents' => $validated['contents'],
            'size' => $validated['size'],
        ]);
    }

    public static function changeStatus($adsId, $status)
    {
        return self::where('id', $adsId)->update([
            'isActive' => $status,
        ]);
    }


    public function scopeActive($query)
    {
        return $query->where('isActive', true);
    }
}
