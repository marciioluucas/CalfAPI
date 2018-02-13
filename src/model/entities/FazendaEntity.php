<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 11/02/2018
 * Time: 17:47
 */

namespace src\model\entities;


use Illuminate\Database\Eloquent\Model;

class FazendaEntity extends Model
{
    protected $table = 'fazendas';
    protected $fillable = [
        'nome',
        'data_alteracao',
        'data_cadastro',
        'usuario_cadastro',
        'usuario_alteracao',
        'status',
    ];
    protected $guarded = ['id'];

    public function animais() {
        return $this->hasMany('\src\model\entities\AnimalEntity');
    }
}