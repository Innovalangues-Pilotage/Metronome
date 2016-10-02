<?php

namespace Innova\MetronomeBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
/**
 * Description of MediaResourceType
 *
 */
class MetronomeType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('name', 'text', array('required' => true));
    }

    public function getDefaultOptions() {
        return array(
            'data_class' => 'Innova\MetronomeBundle\Entity\Metronome',
            'translation_domain' => 'resource',
        );
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {

        $resolver->setDefaults($this->getDefaultOptions());
        return $this;
    }

    public function getName() {
        return 'metronome';
    }

}
