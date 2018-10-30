<?php
/**
 * Created by PhpStorm.
 * User: Brunno
 * Date: 05/09/2018
 * Time: 21:30
 */

namespace CalfManager\Controller;


use CalfManager\Model\Laboratorio;
use CalfManager\Utils\Validate\LaboratorioValidate;
use CalfManager\View\View;
use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Exception;

class LaboratorioController implements IController
{
    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function post(Request $request, Response $response): Response
    {

    }

    /**
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response
     */
    public function get(Request $request, Response $response, array $args): Response
    {

    }

    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function put(Request $request, Response $response): Response
    {
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function delete(Request $request, Response $response): Response
    {

    }

}