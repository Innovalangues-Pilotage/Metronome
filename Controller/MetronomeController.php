<?php

namespace Innova\MetronomeBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration as EXT;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Claroline\CoreBundle\Entity\Workspace\Workspace;
use Innova\MetronomeBundle\Entity\Metronome;

/**
 * Class MetronomeController
 *
 * @Route("workspaces/{workspaceId}")
 * @ParamConverter("workspace", class="ClarolineCoreBundle:Workspace\Workspace", options={"mapping": {"workspaceId": "id"}})
 *
 */
class MetronomeController extends Controller {

    /**
     * display a metronome
     * @Route("/view/{id}", requirements={"id" = "\d+"}, name="innova_metronome_open")
     * @Method("GET")
     * @ParamConverter("Metronome", class="InnovaMetronomeBundle:Metronome")
     */
    public function openAction(Workspace $workspace, Metronome $m) {
        if (false === $this->container->get('security.context')->isGranted('OPEN', $m->getResourceNode())) {
            throw new AccessDeniedException();
        }

        return $this->render('InnovaMetronomeBundle:Metronome:metronome.html.twig', array(
                    '_resource' => $m,
                    'workspace' => $workspace
                        )
        );
    }

    /**
     * administrate a metronome
     * @Route("/edit/{id}", requirements={"id" = "\d+"}, name="innova_metronome_administrate")
     * @Method("GET")
     * @ParamConverter("Metronome", class="InnovaMetronomeBundle:Metronome")
     */
    public function administrateAction(Workspace $workspace, Metronome $m) {

        if (false === $this->container->get('security.context')->isGranted('ADMINISTRATE', $m->getResourceNode())) {
            throw new AccessDeniedException();
        }

        return $this->render('InnovaMetronomeBundle:Metronome:metronome.html.twig', array(
                    '_resource' => $m,
                    'workspace' => $workspace
                        )
        );
    }

}
