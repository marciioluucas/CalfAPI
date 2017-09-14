<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 13/09/2017
 * Time: 01:36
 */

namespace util;

use ReflectionClass;
use ReflectionProperty;

class ClassToArray
{
    public function classToArray($obj)
    {
        $val = [];
        $reflectionClass = new ReflectionClass($obj);
        $pro = $reflectionClass->getProperties(ReflectionProperty::IS_PUBLIC | ReflectionProperty::IS_PRIVATE);

        for ($i = 0; $i < count($pro); $i++) {
            $reflectionProperty = $reflectionClass->getProperty($pro[$i]->name);
            $reflectionProperty->setAccessible(true);
            if ($reflectionProperty->getValue($obj) === null) {

            } else {
                $val[$reflectionProperty->getName()] = $reflectionProperty->getValue($obj);
            }
        }
        return $val;
    }
}