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
    protected $table = 'fazenda';
    protected $fillable = [
        'nome',
        'limite'
    ];
    protected $guarded = ['id', 'created_at', 'update_at'];

    public function animais() {
        return $this->hasMany('\src\model\entities\AnimalEntity');
    }
}