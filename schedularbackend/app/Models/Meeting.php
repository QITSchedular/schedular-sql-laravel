<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    use HasFactory;

    protected $table = 'meetings';

    protected $fillable = [
        'email',
        'name',
        'companyName',
        'website',
        'token',
        'subject',
        "isVerified"
    ];
    public $timestamps = false;
}
