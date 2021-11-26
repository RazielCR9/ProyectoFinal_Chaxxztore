<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Persona extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'user_id',
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'identificador',
        'correo',
        'telefono',
        'archivo_original',
        'archivo_ruta',
        'mime',
    ];


    //Relaciones
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function areas()
    {
        return $this->belongsToMany(Area::class);
    }
}
