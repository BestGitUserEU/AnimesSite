<?php

namespace AnimesBundle\Service;

use AnimesBundle\Entity\Anime;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\Form;

class AnimeService
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function Ajouter(Form $form, Anime $anime)
    {
        $this->em->persist($anime);
        $this->em->flush();

        return "L'anime a bien été ajouté.";
    }
}