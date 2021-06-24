<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Foundation\Foundation;

class Currency extends Model
{
    use HasFactory;

    protected $table = 'currencies';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'country',
        'title',
        'html_code',
        'img',
    ];


    /* Relationships */
     /**
     * Foundations
     */
    public function foundations()
    {
        return $this->belongsToMany(Foundation::class, 'foundations_currencies', 'currency_id', 'foundation_id');
    }
}
