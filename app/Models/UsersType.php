<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersType extends Model
{
    use HasFactory;

    protected $table ='usersTypes';

    protected $fillable =[ 'id','nameType'];
}
