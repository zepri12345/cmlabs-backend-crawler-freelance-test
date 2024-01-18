<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ModelCatatan extends Model
{
    use HasFactory;
    protected $table = 'model_catatan';
    protected $primaryKey = 'id';
    protected $fillable = [
        'description',
        'created_by',
        'updated_by',
    ];
    public $timestamps = true;
}
