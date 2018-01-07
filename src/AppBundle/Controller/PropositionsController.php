<?php
/**
 * Created by PhpStorm.
 * User: Er-rais
 * Date: 20/12/2017
 * Time: 16:52
 */

namespace AppBundle\Controller;
use AppBundle\Entity\Jouer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest; // alias pour toutes les annotations
use AppBundle\Entity\Propositions;
use AppBundle\Entity\Acheteur;
class PropositionsController extends Controller
{
    /**
     * @Rest\View()
     * @Rest\Get("/propositions")
     */
    public function getPropositionsAction(Request $request)
    {
        $propositions = $this->get('doctrine.orm.entity_manager')
            ->getRepository('AppBundle:Propositions')
            ->findAll();
        /* @var $propositions Propositions[] */

        return $propositions;
    }
    /**
     * @Rest\View()
     * @Rest\Get("/propositions/{idPlayer}")
     */
    public function afficherPropositionAction(Request $request)
    {
        $propositions = $this->get('doctrine.orm.entity_manager')
            ->getRepository('AppBundle:Propositions')
            ->findOneByIdPlayer($request->get('idPlayer')); // L'identifiant en tant que paramétre n'est plus nécessaire
        /* @var $propositions Propositions[] */


        return $propositions;

    }
    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/propositions")
     */
    public function postPropositionAction(Request $request)
    {

        $proposition = new Propositions();

        $proposition->setPropositionPrix($request->get('prix'));
        $acheteur = $this->get('doctrine.orm.entity_manager')
            ->getRepository('AppBundle:Acheteur')
            ->find($request->get('acheteur'));

        $proposition->setIdAcheteur($acheteur);
        $player = $this->get('doctrine.orm.entity_manager')
            ->getRepository('AppBundle:Player')
            ->find($request->get('player'));

        $proposition->setIdPlayer($player);
        $proposition->setPeriod($request->get('periode'));

        $em = $this->get('doctrine.orm.entity_manager');
        $em->persist($proposition);
        $em->flush();
        return $proposition;
    }
    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/propositions/accepter")
     */
    public function accepterPropositionAction(Request $request)
    {

        $jouer = new Jouer();
        if ($request->get('accepter')== true)
        {

            $player = $this->get('doctrine.orm.entity_manager')
                ->getRepository('AppBundle:Player')
                ->find($request->get('player'));

            $jouer->setIdPl($player); // insertion au table jouer

            $acheteur = $this->get('doctrine.orm.entity_manager')
                ->getRepository('AppBundle:Acheteur')
                ->find($request->get('acheteur'));
            $equipe = $this->get('doctrine.orm.entity_manager')
                ->getRepository('AppBundle:Equipes')
                ->find($acheteur);

            $jouer->setIdEq($equipe); // insertion au table jouer
            $jouer->setPeriod($request->get('periode'));

            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($jouer);
            $em->flush();
            return $jouer;
            /* return new JsonResponse(['message' => 'Vous avez refuser la proposition'], Response::HTTP_OK);*/
        }
    }
}
