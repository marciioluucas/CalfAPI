<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 14/02/2018
 * Time: 17:09
 */

namespace src\model\repository\entities;


use Illuminate\Database\Eloquent\Model;

class CalfEntity extends Model
{
    const CREATED_AT = 'data_cadastro';
    const UPDATED_AT = 'data_alteracao';
    protected $guarded = ['id'];
    protected $primaryKey = 'id';
}