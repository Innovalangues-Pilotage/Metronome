<?php

namespace Innova\MetronomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Claroline\CoreBundle\Entity\Resource\AbstractResource;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * MediaResource Entity
 *
 * @ORM\Table(name="innova_metronome")
 * @ORM\Entity
 */
class Metronome extends AbstractResource {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     * @Assert\NotBlank
     */
    protected $name;

    /**
     * @var boolean
     *
     * @ORM\Column(name="published", type="boolean")
     */
    protected $published;

    /**
     * @var boolean
     *
     * @ORM\Column(name="modified", type="boolean")
     */
    protected $modified;

   

    public function __construct() {
        $this->published = true;
        $this->modified = false;
    }   

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return \Innova\MetronomeBundle\Entity\Metronome
     */
    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set published
     * @param boolean $published
     * @return \Innova\MetronomeBundle\Entity\Metronome
     */
    public function setPublished($published) {
        $this->published = $published;
        return $this;
    }

    /**
     * Is media resource already published
     * @return boolean
     */
    public function isPublished() {
        return $this->published;
    }

    /**
     * Set modified
     * @param boolean $modified
     * @return \Innova\MetronomeBundle\Entity\Metronome
     */
    public function setModified($modified) {
        $this->modified = $modified;
        return $this;
    }

    /**
     *
     * @return boolean
     */
    public function isModified() {
        return $this->modified;
    }

    /**
     * Wrapper to access Metronome's workspace
     * @return \Claroline\CoreBundle\Entity\Workspace\Workspace
     */
    public function getWorkspace() {
        $workspace = null;
        if (!empty($this->resourceNode)) {
            $workspace = $this->resourceNode->getWorkspace();
        }
        return $workspace;
    }

}
