<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @mixin IdeHelperTip
 */
class Tip extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'content', 'icon', 'date_for'];
}
