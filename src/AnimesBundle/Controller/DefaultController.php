<?php

namespace AnimesBundle\Controller;

use AnimesBundle\Entity\Anime;
use AnimesBundle\Form\AnimeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="animes/accueil")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $animes = $em->getRepository('AnimesBundle:Anime')->findAll();

        return $this->render('AnimesBundle:Default:index.html.twig', array(
            'animes' => $animes,
        ));
    }

    /**
     * @Route("/ajouter", name="animes/ajouter")
     */
    public function ajouterAction(Request $request)
    {
        // créer le formulaire
        $anime = new Anime();
        $form = $this->createForm(AnimeType::class, $anime);
        $form->handleRequest($request);

        // traite le formulaire
        if ($form->isSubmitted() && $form->isValid()) {

            $message = $this->get('animes_anime_service')->ajouter($form, $anime);
            $this->addFlash('success', $message);

            return $this->redirectToRoute('animes/accueil');
        }


        return $this->render('AnimesBundle:Default:ajouter.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/liste", name="animes/liste")
     */
    public function listeAction()
    {
        return $this->render('AnimesBundle:Default:liste.html.twig');
    }

    /**
     * @Route("/", name="animes/calendrier")
     */
    public function calendrierAction()
    {
        $em = $this->getDoctrine()->getManager();
        $animes = $em->getRepository('AnimesBundle:Anime')->findAll();

        return $this->render('AnimesBundle:Default:calendrier.html.twig', array(
            'animes' => $animes,
        ));
    }
}
