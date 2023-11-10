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
    protected $appends = ['url'];

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }

    public function getUrlAttribute()
    {
        $link = '';
        if ($this->name_url && $this->name_att){
            $parts = explode(",", $this->name_att);
            $result = [];
            foreach ($parts as $part) {
                list($key, $value) = explode(":", $part);
                $result[$key] = $value;
            }
            $link = route($this->name_url,$result);
        }elseif ($this->name_url){
            $link = route($this->name_url);
        }else{
            $link = $this->link;
        }
        return $link;
    }
}
