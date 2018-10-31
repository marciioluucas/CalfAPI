<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 08/02/2018
 * Time: 16:09
 */

namespace CalfManager\Model\Repository\Entity;


use Illuminate\Database\Eloquent\Builder;

/**
 * @property string nome
 * @property string data_nascimento
 * @property bool primogenito
 * @property string codigo_brinco
 * @property string codigo_raca
 * @property string data_cadastro
 * @property string data_alteracao
 * @property int lotes_id
 * @property int fazendas_id
 * @property int usuario_alteracao
 * @property int usuario_cadastro
 * @property bool is_vivo
 * @property mixed id
 */
class AnimalEntity extends CalfEntity
{
    protected $table = "animais";
    protected $fillable = [
        'id',
        'nome',
        'data_nascimento',
        'codigo_brinco',
        'codigo_raca',
        'status',
        'sexo',
        'data_alteracao',
        'data_cadastro',
        'usuario_cadastro',
        'usuario_alteracao',
        'lotes_id',
        'is_vivo'
    ];
    protected $casts = [
        'data_nascimento' => 'date:d/m/Y'
    ];

    public function pesagens()
    {
        return $this->hasMany('CalfManager\Model\Repository\Entity\PesagemEntity', 'animais_id', 'id');
    }

    public function doencas()
    {
        return $this->belongsToMany('CalfManager\Model\Repository\Entity\DoencaEntity',
            'animais_has_doencas', 'animais_id', 'doencas_id');
    }

    public function lote()
    {
        return $this->belongsTo('CalfManager\Model\Repository\Entity\LoteEntity', 'lotes_id');
    }

    public function Hemogramas(){
        return $this->hasMany("CalfManager\Model\Repository\Entity\HemogramaEntity", 'animal_id');
    }

    public function scopeEstaMorto(Builder $query)
    {
        return $query->where('is_vivo', 0);
    }


}