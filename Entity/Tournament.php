<?php

/*
 * Copyright (c) 2012 Arulu Inversiones SL
 * Todos los derechos reservados
 */

namespace EdgarTebar\DrawTableBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="tournaments")
 */
class Tournament
{
    const TYPE_KNOCKOUT = 1;
    const TYPE_LEAGUE = 2;
    const TYPE_GROUPS_AND_KNOCKOUT = 3;

    const PARTICIPANT_SINGLE_PLAYER = 1;
    const PARTICIPANT_TYPE_TEAM = 2;

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
     * @ORM\Column(name="Participants_Number", type="integer")
     * @Assert\Type(type="integer")
     */
    protected $participantsNumber;

    /**
     * @ORM\Column(name="Participants_Type", type="integer")
     * @Assert\Choice(callback = "getAvailableParticipantsTypes")
     */
    protected $participantsType;

    /**
     * @ORM\Column(name="Type", type="integer")
     * @Assert\Choice(callback = "getAvailableTypes")
     */
    protected $type;

    /**
     * @ORM\Column(name="Matches_In_Final", type="integer")
     * @Assert\Type(type="integer")
     */
    protected $matchesInFinal = 1;

    /**
     * @ORM\Column(name="Matches_Per_Group", type="integer")
     * @Assert\Type(type="integer")
     */
    protected $matchesPerGroup = 1;

    /**
     * @ORM\Column(name="Teams_Pass", type="integer")
     * @Assert\Type(type="integer")
     */
    protected $teamsPass = 2;

    /**
     * @ORM\Column(name="Teams_Per_Group", type="integer")
     * @Assert\Type(type="integer")
     */
    protected $teamsPerGroup = 4;

    /**
     * @ORM\OneToMany(targetEntity="Match", mappedBy="tournament", cascade={"persist"}, indexBy="id", fetch="EXTRA_LAZY")
     * @ORM\OrderBy({"id"="DESC"})
     *
     * @var ArrayCollection
     */
    protected $matches;

    function __construct()
    {
        $this->matches = new ArrayCollection;
    }

    public static function getAvailableTypes($justKeys = true)
    {
        $options = array(
            self::TYPE_LEAGUE => "Liga",
            self::TYPE_GROUPS_AND_KNOCKOUT => "Liga y eliminatoria",
            self::TYPE_KNOCKOUT => "Eliminatoria",
        );

        return $justKeys ? array_keys($options) : $options;
    }

    public static function getAvailableParticipantsTypes($justKeys = true)
    {
        $options = array(
            self::PARTICIPANT_SINGLE_PLAYER => "Jugador",
            self::PARTICIPANT_TYPE_TEAM => "Equipos"
        );

        return $justKeys ? array_keys($options) : $options;
    }

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection $matches
     */
    public function setMatches($matches)
    {
        $this->matches = $matches;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getMatches()
    {
        return $this->matches;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setMatchesInFinal($matchesInFinal)
    {
        $this->matchesInFinal = $matchesInFinal;
    }

    public function getMatchesInFinal()
    {
        return $this->matchesInFinal;
    }

    public function setMatchesPerGroup($matchesPerGroup)
    {
        $this->matchesPerGroup = $matchesPerGroup;
    }

    public function getMatchesPerGroup()
    {
        return $this->matchesPerGroup;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setParticipantsNumber($participantsNumber)
    {
        $this->participantsNumber = $participantsNumber;
    }

    public function getParticipantsNumber()
    {
        return $this->participantsNumber;
    }

    public function setParticipantsType($participantsType)
    {
        $this->participantsType = $participantsType;
    }

    public function getParticipantsType()
    {
        return $this->participantsType;
    }

    public function setTeamsPass($teamsPass)
    {
        $this->teamsPass = $teamsPass;
    }

    public function getTeamsPass()
    {
        return $this->teamsPass;
    }

    public function setTeamsPerGroup($teamsPerGroup)
    {
        $this->teamsPerGroup = $teamsPerGroup;
    }

    public function getTeamsPerGroup()
    {
        return $this->teamsPerGroup;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function getType()
    {
        return $this->type;
    }
}
