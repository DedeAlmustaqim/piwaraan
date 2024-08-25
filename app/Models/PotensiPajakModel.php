<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PotensiPajakModel extends Model
{
    use HasFactory;
    protected $table = 'potensi_pajak';
    protected $guarded = [];
}
