<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;
    protected $fillable = ['file'];

    public function questionnaire(){
        return $this->belongsTo(Questionnaire::class);
    }

}
