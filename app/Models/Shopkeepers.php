<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shopkeepers extends Model
{
    use HasFactory;
    protected $table = "shopkeepers";
    protected $primary = "shopkeeperId";
    protected $fillable = [
        "UserName",
        "Password"
    ];
}
