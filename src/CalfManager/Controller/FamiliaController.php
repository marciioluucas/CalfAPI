<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 10/03/2018
 * Time: 18:23
 */

namespace CalfManager\Controller;

use CalfManager\Utils\TokenApp;
use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use CalfManager\Model\Familia;
use CalfManager\View\View;

class FamiliaController implements IController
{
    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function post(Request $request, Response $response): Response
    {
        // TODO: Implement post() method.
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response
     */
    public function get(

        Request $request,
        Response $response,
        array $args
    ): Response {
        if(TokenApp::validaToken()) {
            $familia = new Familia();
            if ($request->getQueryParam('id-filho')) {
                return View::render(
                    $response,
                    $familia->encapsular($request->getQueryParam('id-filho')),
                    200
                );
            }
        }
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function put(Request $request, Response $response): Response
    {
        // TODO: Implement put() method.
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function delete(Request $request, Response $response): Response
    {
        // TODO: Implement delete() method.
    }
}
