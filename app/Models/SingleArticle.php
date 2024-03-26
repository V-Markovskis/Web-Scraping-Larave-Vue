<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SingleArticle extends Model
{
    use HasFactory;

    public mixed $title;
    public mixed $link;
    public mixed $points;
    public mixed $date_created;

    protected $table = 'articles';
    protected $fillable = [
        'title',
        'link',
        'points',
        'date_created',
    ];
}
