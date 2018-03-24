<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 10/03/2018
 * Time: 18:33
 */

namespace src\model;


use ArrayObject;
use Exception;
use src\model\repository\FamiliaDAO;

class Familia extends Modelo
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var Animal
     */
    private $pai;
    /**
     * @var Animal
     */
    private $mae;
    /**
     * @var Animal
     */
    private $filho;


    public function __construct()
    {
        $this->pai = new Animal();
        $this->mae = new Animal();
        $this->filho = new Animal();
    }


    /**
     * @return bool
     * @throws Exception
     */
    public function cadastrar(): bool
    {
        // TODO: Implement cadastrar() method.
    }

    /**
     * @return bool
     * @throws Exception
     */
    public function alterar(): bool
    {
        // TODO: Implement alterar() method.
    }

    /**
     * @param int $page
     * @return array
     * @throws Exception
     */
    public function pesquisar(int $page): array
    {
        // TODO: Implement pesquisar() method.
    }

    /**
     * @return bool
     * @throws Exception
     */
    public function deletar(): bool
    {
        // TODO: Implement deletar() method.
    }

    public function pesquisaFamiliaByIdAnimal($id)
    {
        if ($id != null) {
            $obj = (new FamiliaDAO())->retreaveFamiliaByIdAnimal($id);
            return $obj;
        }
        return false;
    }

    /**
     * @param object $familia
     * @return array
     */
    public function fazerArvoreGenealogica($familia)
    {
        $arrayToReturn = [];
        if (!$familia) {
            return $arrayToReturn;
        }

        $arrayToReturn['name'] = $familia->filho->codigo_brinco;
        $arrayToReturn['id'] = $familia->filho->id;
        $objFamiliaMae = $this->pesquisaFamiliaByIdAnimal($familia->mae->id);
        $objFamiliaPai = $this->pesquisaFamiliaByIdAnimal($familia->pai->id);

        $arrayToReturn['children']['0'] = $this->fazerArvoreGenealogica($objFamiliaMae);
        $arrayToReturn['children']['0']['id'] = $familia->mae->id;
        $arrayToReturn['children']['0']['name'] = $familia->mae->codigo_brinco;
        $arrayToReturn['children']['0']['value'] = 1;

        $arrayToReturn['children']['1'] = $this->fazerArvoreGenealogica($objFamiliaPai);
        $arrayToReturn['children']['1']['id'] = $familia->pai->id;
        $arrayToReturn['children']['1']['name'] = $familia->pai->codigo_brinco;
        $arrayToReturn['children']['1']['value'] = 1;
        return $arrayToReturn;
    }

    /**
     * @param $idAnimal
     * @return array
     */
    public function graphArvoreGenealogica($idAnimal)
    {
        $obj = $this->pesquisaFamiliaByIdAnimal($idAnimal);
        return $this->fazerArvoreGenealogica($obj);
    }

    public function graph(string $whatChart, array $params)
    {
        return $this->$whatChart($params['id-filho']);
    }

    /**
     * @return mixed
     */
    public
    function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public
    function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return Animal
     */
    public
    function getPai(): Animal
    {
        return $this->pai;
    }

    /**
     * @param Animal $pai
     */
    public
    function setPai(Animal $pai): void
    {
        $this->pai = $pai;
    }

    /**
     * @return Animal
     */
    public
    function getMae(): Animal
    {
        return $this->mae;
    }

    /**
     * @param Animal $mae
     */
    public
    function setMae(Animal $mae): void
    {
        $this->mae = $mae;
    }

    /**
     * @return Animal
     */
    public
    function getFilho(): Animal
    {
        return $this->filho;
    }

    /**
     * @param Animal $filho
     */
    public
    function setFilho(Animal $filho): void
    {
        $this->filho = $filho;
    }


}