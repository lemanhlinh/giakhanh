<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookTable extends Model
{
//    use HasFactory;
    protected $table = 'books_table';
    protected $guarded = ['id'];

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id', 'id');
    }
}
