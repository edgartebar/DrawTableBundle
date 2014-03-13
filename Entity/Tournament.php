<?php

/*
 * Copyright (c) 2012 Arulu Inversiones SL
 * Todos los derechos reservados
 */

namespace DrawTableBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="tournaments")
 */
class Tournament
{
    const TYPE_KNOCKOUT = 1;
    const TYPE_LEAGUE = 2;
    const TYPE_GROUPS_AND_KNOCKOUT = 3;

    const PARTICIPANT_SINGLE_PLAYER = 2;
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
     * @ORM\Column(name="Teams_PerGroup", type="integer")
     * @Assert\Type(type="integer")
     */
    protected $teamsPerGroup = 4;





    /**
     * @ORM\Column(name="Participants", type="integer")
     *
     * @return array
     */

    public static function getAvailableTypes($justKeys = true)
    {
        $options = array(
            self::TYPE_LEAGUE => "Liga",
            self::TYPE_GROUPS_AND_KNOCKOUT => "Liga y eliminatoria",
            self::TYPE_KNOCKOUT => "Eliminatoria",
        );

        return $justKeys ? array_keys($options) : $options;
    }
}
