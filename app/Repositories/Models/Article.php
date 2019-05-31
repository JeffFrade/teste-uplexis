<?php

namespace App\Repositories\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use SoftDeletes;

    protected $table = 'artigos';

    protected $fillable = [
        'titulo',
        'link',
        'id_usuario'
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'id_usuario');
    }
}