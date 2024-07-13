<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerangkatLunak extends Model
{
    use HasFactory;

    public function Option(){
        return $this->belongsTo(Option::class);
    }

    public function Metode(){
        return $this->belongsTo(Metode::class); 
    }

    protected $guarded = [
        'id'
    ];
}
