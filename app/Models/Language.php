<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Foundation\Foundation;

class Language extends Model
{
    use HasFactory;

    protected $table = 'languages';
    public $timestamps = false;
    protected $primaryKey = 'lang';
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'lang', 'title', 'img',
    ];


    /* Relationships */
     /**
     * Foundations
     */
    public function foundations()
    {
        return $this->belongsToMany(Foundation::class, 'foundations_languages', 'language_id', 'foundation_id');
    }
}
