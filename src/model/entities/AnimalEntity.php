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
    protected $table = "users";
    protected $fillable = ['name','email','password'];
    const CREATED_AT = 'creation_date';
    const UPDATED_AT = 'last_update';
}