<?php

namespace Innova\MetronomeBundle\EventListener\Resource;

use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Claroline\CoreBundle\Event\OpenResourceEvent;
use Claroline\CoreBundle\Event\DeleteResourceEvent;
use Claroline\CoreBundle\Event\CreateFormResourceEvent;
use Claroline\CoreBundle\Event\CreateResourceEvent;
use Claroline\CoreBundle\Event\CopyResourceEvent;
use Claroline\CoreBundle\Event\CustomActionResourceEvent;
use Innova\MetronomeBundle\Entity\Metronome;

/**
 * Media Resource Event Listener
 * Used to integrate Path to Claroline resource manager
 */
class MetronomeListener extends ContainerAware {

    /**
     * Fired when a new ResourceNode of type Metronome is edited
     * @param  \Claroline\CoreBundle\Event\CustomActionResourceEvent $event
     * @throws \Exception
     */
    public function onAdministrate(CustomActionResourceEvent $event) {
        $metronome = $event->getResource();
        $route = $this->container
                ->get('router')
                ->generate('innova_metronome_administrate', array(
            'id' => $metronome->getId(),
            'workspaceId' => $metronome->getWorkspace()->getId()
                )
        );
        $event->setResponse(new RedirectResponse($route));
        $event->stopPropagation();
    }

    /**
     * Fired when a ResourceNode of type metronome is opened
     * @param \Claroline\CoreBundle\Event\OpenResourceEvent $event
     * @throws \Exception
     */
    public function onOpen(OpenResourceEvent $event) {
        $metronome = $event->getResource();
        $route = $this->container
                ->get('router')
                ->generate('innova_metronome_open', array(
            'id' => $metronome->getId(),
            'workspaceId' => $metronome->getWorkspace()->getId()
                )
        );
        $event->setResponse(new RedirectResponse($route));
        $event->stopPropagation();
    }

    /**
     * 
     * @param CreateResourceEvent $event
     * @throws \Exception
     */
    public function onCreate(CreateResourceEvent $event) {
        // Create form
        $form = $this->container->get('form.factory')->create('metronome', new Metronome());
        // Try to process form
        $request = $this->container->get('request');
        $form->submit($request);
        if ($form->isValid()) {
            $metronome = $form->getData(); 
            // Send new metronome to dispatcher through event object
            $event->setResources(array($metronome));
        } else {
            $content = $this->container->get('templating')->render(
                    'ClarolineCoreBundle:Resource:createForm.html.twig', array(
                'form' => $form->createView(),
                'resourceType' => 'innova_metronome'
            ));
            $event->setErrorFormContent($content);
        }
        $event->stopPropagation();
        return;
    }

    /**
     * 
     * @param CreateFormResourceEvent $event
     */
    public function onCreateForm(CreateFormResourceEvent $event) {
        // Create form
        $form = $this->container->get('form.factory')->create('metronome', new Metronome());
        $content = $this->container->get('templating')->render(
                'ClarolineCoreBundle:Resource:createForm.html.twig', array(
            'form' => $form->createView(),
            'resourceType' => 'innova_metronome'
        ));
        $event->setResponseContent($content);
        $event->stopPropagation();
    }

    public function onDelete(DeleteResourceEvent $event) {

        $resource = $event->getResource();
        $manager = $this->container->get('innova_metronome.manager.metronome');
        $manager->delete($resource);

        $event->stopPropagation();
    }

    /**
     * Fired when a ResourceNode of type metronome is duplicated
     * @param \Claroline\CoreBundle\Event\CopyResourceEvent $event
     * @throws \Exception
     */
    public function onCopy(CopyResourceEvent $event) {        
        $toCopy = $event->getResource();        
        $new = new Metronome();
        $new->setName($toCopy->getName());      
        $event->setCopy($new);
        $event->stopPropagation();
    }
}
