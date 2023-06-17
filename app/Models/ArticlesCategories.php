<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticlesCategories extends Model
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;
    protected $fillable = ['title','slug','image','active'];
    protected $guarded = ['id'];
}
