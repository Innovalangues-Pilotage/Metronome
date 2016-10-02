<?php

namespace Innova\MetronomeBundle\Transfer;

use Claroline\CoreBundle\Entity\Workspace\Workspace;
use Innova\MetronomeBundle\Entity\Metronome;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\Processor;
use Claroline\CoreBundle\Library\Transfert\Importer;

class MetronomeImporter extends Importer implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'innova_metronome';
    }

    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('data');

        $rootNode
            ->children()
                ->scalarNode('name')->end()
                ->booleanNode('published')->end()
                ->booleanNode('modified')->end()
            ->end()
        ;

        return $treeBuilder;
    }

    /**
     * {@inheritdoc}
     */
    public function validate(array $data)
    {
        $processor = new Processor();
        $processor->processConfiguration($this, $data);
    }

    public function import(array $data, $name, $created)
    {
        $entity = new Metronome();

        $entity->setName($data['data']['name']);
        $entity->setPublished($data['data']['published']);
        $entity->setModified($data['data']['modified']);

        return $entity;
    }

    public function export(Workspace $workspace, array &$files, $object)
    {
        $data = array ();

        $data['name']      = $object->getName();
        $data['published'] = $object->isPublished();
        $data['modified']  = $object->isModified();

        return $data;
    }
}