<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Retu extends Model
{
    protected $table = 'returns';

    protected $fillable = [
        'board_id','text','flg'
    ];
}
