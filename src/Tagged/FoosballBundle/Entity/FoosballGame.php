<?php

namespace MyCo\Bundle\BlogBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="game")
 */
class FoosballGame
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="integer")
     * @ORM\ManyToOne(targetEntity="Player", inversedBy="players")
     */
    protected $player1_id;
    /**
     * @ORM\Column(type="integer")
     * @ORM\ManyToOne(targetEntity="Player", inversedBy="players")
     */
    protected $player2_id;
    /**
     * @ORM\Column(type="integer")
     */
    protected $player1_score;
    /**
     * @ORM\Column(type="integer")
     */
    protected $player2_score;

}