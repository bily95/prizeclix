<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['name', 'value'];


    public  static function getAll()
    {
        $settings = self::all();

        $set = [];
        foreach ($settings as $key) {
            $set[$key->name] = $key->value;
        }

        return $set;
    }
}
