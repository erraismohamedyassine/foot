<?php
/**
 * Created by PhpStorm.
 * User: Er-rais
 * Date: 21/12/2017
 * Time: 03:50
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

use AppBundle\Entity\Player;


class PlayerController extends FOSRestController
{



    /**
     * @Rest\View()
     * @Rest\Get("/players")
     */
    public function getPlayersAction(Request $request)
    {
        $players = $this->get('doctrine.orm.entity_manager')
            ->getRepository('AppBundle:Player')
            ->findAll();
        /* @var $Players Player[] */

        return $players;
    }
    /**
     * @Rest\View()
     * @Rest\Get("/players/{nom}")
     */
    public function getPlayerAction(Request $request)
    {
        $player = $this->get('doctrine.orm.entity_manager')
            ->getRepository('AppBundle:Player')
            ->findOneByNom($request->get('nom')); // L'identifiant en tant que paramétre n'est plus nécessaire
        /* @var $player Player */

        if (empty($player)) {
            return new JsonResponse(['message' => 'Player not found'], Response::HTTP_NOT_FOUND);
        }

        return $player;
    }
    /**
     * @Rest\View(statusCode=201)
     * @Rest\Post("/players")
     * @ParamConverter("player", converter="fos_rest.request_body")
     */
    public function postPlayersAction(Player $player, ConstraintViolationList $violations)
    {
        if (count($violations)) {
            $message = 'The JSON sent contains invalid data. Here are the errors you need to correct: ';
            foreach ($violations as $violation) {
                $message .= sprintf("Field %s: %s ", $violation->getPropertyPath(), $violation->getMessage());
            }

            throw new ResourceValidationException($message);
        }

        $em = $this->get('doctrine.orm.entity_manager');
        $em->persist($player);
        $em->flush();

        return $player;
    }
    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/playerss")
     */
    public function postPlayerssAction(Request $request)
    {

        $player = new Player();
        $player->setNom($request->get('nom'));
        $player->setPrenom($request->get('prenom'));
        $player->setPrixPlayer($request->get('prix'));


        $em = $this->get('doctrine.orm.entity_manager');
        $em->persist($player);
        $em->flush();

        return $player;
    }


}