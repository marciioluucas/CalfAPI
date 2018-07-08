<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 08/02/2018
 * Time: 16:09
 */

namespace src\model\repository\entities;


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
        'fazendas_id',
        'lotes_id',
        'is_vivo'
    ];
    protected $casts = [
        'data_nascimento' => 'date:d/m/Y'
    ];

    public function fazenda()
    {
        return $this->belongsTo('src\model\repository\entities\FazendaEntity', 'fazendas_id');
    }

    public function pesagens()
    {
        return $this->hasMany('src\model\repository\entities\PesagemEntity', 'animais_id', 'id');
    }

    public function doencas()
    {
        return $this->belongsToMany('src\model\repository\entities\DoencaEntity',
            'animais_has_doencas', 'animais_id', 'doencas_id');
    }

    public function lote()
    {
        return $this->belongsTo('src\model\repository\entities\LoteEntity', 'lotes_id');
    }

    public function scopeEstaMorto(Builder $query)
    {
        return $query->where('is_vivo', 0);
    }


}