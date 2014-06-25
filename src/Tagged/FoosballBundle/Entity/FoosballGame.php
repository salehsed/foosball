<?php

namespace Tagged\FoosballBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Tagged\FoosballBundle\Repository\FoosballGameRepository")
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
     * @ORM\Column(type="string")
     */
    protected $player1;
    /**
     * @ORM\Column(type="string")
     */
    protected $player2;
    /**
     * @ORM\Column(type="string")
     */
    protected $player1_score;
    /**
     * @ORM\Column(type="integer")
     */
    protected $player2_score;




    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set player1
     *
     * @param string $player1
     * @return FoosballGame
     */
    public function setPlayer1($player1)
    {
        $this->player1 = $player1;

        return $this;
    }

    /**
     * Get player1
     *
     * @return string 
     */
    public function getPlayer1()
    {
        return $this->player1;
    }

    /**
     * Set player2
     *
     * @param string $player2
     * @return FoosballGame
     */
    public function setPlayer2($player2)
    {
        $this->player2 = $player2;

        return $this;
    }

    /**
     * Get player2
     *
     * @return string 
     */
    public function getPlayer2()
    {
        return $this->player2;
    }

    /**
     * Set player1_score
     *
     * @param string $player1Score
     * @return FoosballGame
     */
    public function setPlayer1Score($player1Score)
    {
        $this->player1_score = $player1Score;

        return $this;
    }

    /**
     * Get player1_score
     *
     * @return string 
     */
    public function getPlayer1Score()
    {
        return $this->player1_score;
    }

    /**
     * Set player2_score
     *
     * @param integer $player2Score
     * @return FoosballGame
     */
    public function setPlayer2Score($player2Score)
    {
        $this->player2_score = $player2Score;

        return $this;
    }

    /**
     * Get player2_score
     *
     * @return integer 
     */
    public function getPlayer2Score()
    {
        return $this->player2_score;
    }
}
