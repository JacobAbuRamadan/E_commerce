<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded = [] ;

    public function parent()
    {
        return $this->belongsTo(Category::class,'parent_id')->withDefault();
    }
}
