<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SliderModel extends Model
{
    use HasFactory;
    protected $table = 'slider';
    protected $primaryKey = 'slider_id';
    public $incrementing = true;
    protected $keyType = 'int';
}
