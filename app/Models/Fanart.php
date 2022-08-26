<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fanart extends Model
{
    use HasFactory;

    protected $table ='fanarts';

    protected $fillable =[ 'id','title','description','image','mediaRating','id_users','id_fanartCategory'];

    public function user()
    {
        return $this->hasOne(User::class,'id_users');
    }


    public function fanartCategory()
    {
        return $this->hasOne(FanartCategory::class,'id_fanartCategory');
    }
}
