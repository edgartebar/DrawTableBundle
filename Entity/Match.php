<?php

namespace EdgarTebar\DrawTableBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="matches")
 */
class Match
{
    /**
     * @ORM\Id
     * @ORM\Column(name="ID", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="Created", type="datetime")
     * @Assert\DateTime()
     *
     * @var \DateTime
     */
    protected $created;

    /**
     * @ORM\Column(name="Played", type="datetime")
     * @Assert\DateTime()
     *
     * @var \DateTime
     */
    protected $played;

    /**
     * @ORM\Column(name="Result", type="string", length=150, nullable=true)
     */
    protected $name;

    /**
     * @ORM\ManyToOne(targetEntity="Tournament", cascade={"persist"}, inversedBy="matches")
     * @ORM\JoinColumn(name="Tournament_ID", referencedColumnName="ID", nullable=false)
     *
     * @Assert\NotBlank
     */
    protected $tournament;

    /**
     * @ORM\ManyToOne(targetEntity="SinglePlayer", cascade={"persist"}, inversedBy="matches")
     * @ORM\JoinColumn(name="Participant1_ID", referencedColumnName="ID", nullable=false)
     */
    protected $participant1;

    /**
     * @ORM\ManyToOne(targetEntity="SinglePlayer", cascade={"persist"}, inversedBy="matches")
     * @ORM\JoinColumn(name="Participant2_ID", referencedColumnName="ID", nullable=false)
     */
    protected $participant2;

    /**
     * @ORM\ManyToOne(targetEntity="SinglePlayer", cascade={"persist"}, inversedBy="matches")
     * @ORM\JoinColumn(name="Winner_ID", referencedColumnName="ID", nullable=false)
     */
    protected $winner;

    /**
     * @param \DateTime $created
     */
    public function setCreated($created)
    {
        $this->created = $created;
    }

    public function setTournament($tournament)
    {
        $this->tournament = $tournament;
    }

    public function getTournament()
    {
        return $this->tournament;
    }

    /**
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
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
     * @param \DateTime $played
     */
    public function setPlayed($played)
    {
        $this->played = $played;
    }

    /**
     * @return \DateTime
     */
    public function getPlayed()
    {
        return $this->played;
    }
}
