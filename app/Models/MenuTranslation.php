<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class MenuTranslation extends Model
{
//    use HasFactory;
    use NodeTrait;
    protected $table = 'menu_translation';
    protected $guarded = ['id','_lft','_rgt'];

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }
}
