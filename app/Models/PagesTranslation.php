<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PagesTranslation extends Model
{
    protected $table = 'pages_translation';
    protected $guarded = ['id'];

    public function page()
    {
        return $this->belongsTo(Menu::class, 'page_id');
    }
}
