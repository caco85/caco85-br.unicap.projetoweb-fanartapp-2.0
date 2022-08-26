<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;

    protected $table ='evaluations';

    protected $fillable =['id','description','star','status','id_users','id_fanart'];

    public function user()
    {
        return $this->hasOne(User::class,'id_users');
    }


    public function fanart()
    {
        return $this->hasOne(Fanart::class,'id_fanart');
    }
}
