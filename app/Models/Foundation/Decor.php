<?php

namespace App\Models\Foundation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Decor extends Model
{
    use HasFactory;

    protected $table = 'decors';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'title', 'by', 'value', 'decorable_id', 'decorable_type', 'foundation_id'
    ];

    /**
     * Get Decorable Item.
     */
    public function decorable()
    {
        return $this->morphTo();
    }
}
