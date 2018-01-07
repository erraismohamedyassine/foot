<?php
/**
 * Created by PhpStorm.
 * User: Er-rais
 * Date: 21/12/2017
 * Time: 03:51
 */

namespace AppBundle\Controller;
use FOS\RestBundle\Controller\FOSRestController;
use AppBundle\Exception\ResourceValidationException;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest; // alias pour toutes les annotations
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Validator\ConstraintViolationList;

use AppBundle\Entity\Acheteur;

class AcheteurController extends FOSRestController
{
    /**
     * @Rest\View()
     * @Rest\Get("/acheteurs")
     */
    public function getAcheteursAction(Request $request)
    {
        $acheteurs = $this->get('doctrine.orm.entity_manager')
            ->getRepository('AppBundle:Acheteur')
            ->findAll();
        /* @var $acheteurs Acheteur[] */

        return $acheteurs;

    }

    /**
     * @Rest\View()
     * @Rest\Post("/acheteurs/all")
     */
    public function postgetAcheteursAction(Request $request)
    {
        $acheteurs = $this->get('doctrine.orm.entity_manager')
            ->getRepository('AppBundle:Acheteur')
            ->findAll();
        /* @var $acheteurs Acheteur[] */

        return new JsonResponse(['message' => $request->get("name")], Response::HTTP_OK);;

    }

    /**
     * @Rest\View()
     * @Rest\Get("/acheteurs/{nom}")
     */
    public function getAcheteurAction(Request $request)
    {
        $acheteur = $this->get('doctrine.orm.entity_manager')
            ->getRepository('AppBundle:Acheteur')
            ->findOneByNom($request->get('nom')); // L'identifiant en tant que paramétre n'est plus nécessaire
        /* @var $acheteur Acheteur */

        if (empty($acheteur)) {
            return new JsonResponse(['message' => 'Acheteur not found'], Response::HTTP_NOT_FOUND);
        }

        return $acheteur;
    }



    /**
     * @Rest\View(statusCode=201)
     * @Rest\Post("/acheteurs")
     * @ParamConverter("acheteur", converter="fos_rest.request_body")
     */
    public function postAcheteursAction(Acheteur $acheteur, ConstraintViolationList $violations)
    {
        if (count($violations)) {
            $message = 'The JSON sent contains invalid data. Here are the errors you need to correct: ';
            foreach ($violations as $violation) {
                $message .= sprintf("Field %s: %s ", $violation->getPropertyPath(), $violation->getMessage());
            }

            throw new ResourceValidationException($message);
        }

        $em = $this->get('doctrine.orm.entity_manager');
        $em->persist($acheteur);
        $em->flush();

        return $acheteur;
    }

}