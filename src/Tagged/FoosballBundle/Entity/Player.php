<?php
/**
 * Created by IntelliJ IDEA.
 * User: saleh.sedighi
 * Date: 6/25/14
 * Time: 12:46 PM
 */

namespace MyCo\Bundle\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="player")
 */
class Player {
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $name;

} 