<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Menu extends Model
{
    use HasFactory;
    use NodeTrait;
    public $table = "menu";
    protected $fillable = ['name', 'link', 'parent_id','category_id','name_url','name_att'];
    protected $guarded = ['id'];
    protected $appends = ['url'];

    public function category()
    {
        return $this->belongsTo(MenuCategory::class,'category_id','id')->where('id',1);
    }

    public function translations()
    {
        return $this->hasOne(MenuTranslation::class, 'menu_id','id');
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
