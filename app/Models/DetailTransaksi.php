<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function Fasilitas()
    {
        return $this->belongsTo(Fasilitas::class);
    }
    public function Guest()
    {
        return $this->belongsTo(Guest::class);
    }
    public function Order()
    {
        return $this->belongsTo(Order::class);
    }
}
