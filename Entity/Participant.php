<?php
namespace EdgarTebar\DrawTableBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\MappedSuperclass
 *
 * @author Edgar Tébar <etebar.trejo@gmail.com>
 */
class Participant
{
    /**
     * @ORM\Id
     * @ORM\Column(name="ID", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="Name", type="string", length=50)
     * @Assert\NotBlank(message="Este valor no debe estar vacío")
     */
    protected $name;

    /**
     * @ORM\OneToMany(targetEntity="Match", mappedBy="participant1", cascade={"persist"}, indexBy="id", fetch="EXTRA_LAZY")
     * @ORM\OrderBy({"id"="DESC"})
     *
     * @var ArrayCollection
     */
    protected $matches1;

    /**
     * @ORM\OneToMany(targetEntity="Match", mappedBy="participant2", cascade={"persist"}, indexBy="id", fetch="EXTRA_LAZY")
     * @ORM\OrderBy({"id"="DESC"})
     *
     * @var ArrayCollection
     */
    protected $matches2;

    /**
     * @ORM\OneToMany(targetEntity="Match", mappedBy="winner", cascade={"persist"}, indexBy="id", fetch="EXTRA_LAZY")
     * @ORM\OrderBy({"id"="DESC"})
     *
     * @var ArrayCollection
     */
    protected $winnerMatches;

    function __construct()
    {
        $this->matches1 = new ArrayCollection;
        $this->matches2 = new ArrayCollection;
        $this->winnerMatches = new ArrayCollection;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection $matches1
     */
    public function setMatches1($matches1)
    {
        $this->matches1 = $matches1;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getMatches1()
    {
        return $this->matches1;
    }

    public function getMatches()
    {
        return array_merge($this->matches1->toArray(), $this->matches2->toArray());
    }

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection $matches2
     */
    public function setMatches2($matches2)
    {
        $this->matches2 = $matches2;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getMatches2()
    {
        return $this->matches2;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection $winnerMatches
     */
    public function setWinnerMatches($winnerMatches)
    {
        $this->winnerMatches = $winnerMatches;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getWinnerMatches()
    {
        return $this->winnerMatches;
    }
}
