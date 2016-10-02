<?php

namespace Innova\MetronomeBundle\Manager;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Translation\TranslatorInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Innova\MetronomeBundle\Entity\Metronome;

/**
 * MediaResource Manager
 */
class MetronomeManager {

    protected $em;
    protected $translator;

    public function __construct(EntityManager $em, TranslatorInterface $translator) {
        $this->em = $em;
        $this->translator = $translator;
    }

    public function getRepository() {
        return $this->em->getRepository('InnovaMetronomeBundle:Metronome');
    }

    /**
     * Delete a metronome
     * @param Metronome $m
     * @return \Innova\MetronomeBundle\Manager\MetronomeManager
     */
    public function delete(Metronome $m) {        
        $this->em->remove($m);
        $this->em->flush();
        return $this;
    }
    
}
