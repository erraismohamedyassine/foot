<?php
/**
 * Created by PhpStorm.
 * User: Er-rais
 * Date: 21/12/2017
 * Time: 03:51
 */

namespace AppBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest; // alias pour toutes les annotations
use AppBundle\Entity\Equipes;

class EquipesController extends Controller
{
    /**
     * @Rest\View()
     * @Rest\Get("/equipes")
     */
    public function getEquipesAction(Request $request)
    {
        $equipes = $this->get('doctrine.orm.entity_manager')
            ->getRepository('AppBundle:Equipes')
            ->findAll();
        /* @var $equipes Equipes[] */

        return $equipes;

    }
    /**
     * @Rest\View()
     * @Rest\Get("/equipes/{id}")
     */
    public function getEquipeAction(Request $request)
    {
        $equipes = $this->get('doctrine.orm.entity_manager')
            ->getRepository('AppBundle:Equipes')
            ->find($request->get('id')); // L'identifiant en tant que paramétre n'est plus nécessaire
        /* @var $equipes Equipes[] */

        if (empty($equipes)) {
            return new JsonResponse(['message' => 'Acheteur not found'], Response::HTTP_NOT_FOUND);
        }

        return $equipes;
    }

}