<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 08/02/2018
 * Time: 16:09
 */

namespace src\model\entities;


use Illuminate\Database\Eloquent\Model;

class AnimalEntity extends Model
{
    protected $table = "animais";
    protected $fillable = ['nomes','numero_brinco'];

    public function fazenda() {
        return $this->belongsTo('src\model\entities\FazendaEntity');
    }
}