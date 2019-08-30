<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = ['categoryId','blogTitle','blogShortDescription','blogLongDescription','blogImage','publicationStatus'];
    
}
