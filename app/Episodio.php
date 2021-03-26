<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episodio extends Model
{
    public $timestamps = false;
    protected $fillable = ['numero'];
    
    public function temporada(){
        return $this->belongsTO(Temporada::class);
    }
}
