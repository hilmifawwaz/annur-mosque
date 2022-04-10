<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    protected $fillable = [
        'judul',
        'nama_pembuat',
        'isi'
    ];

    public function agreement()
    {
        return $this->hasMany(NewsAgreement::class, 'news_id', 'id');
    }
}
