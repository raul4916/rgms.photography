<?php
/**
 * Created by PhpStorm.
 * User: raul4916
 * Date: 3/25/16
 * Time: 3:48 PM
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Query\QueryException;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="categories")
 */
class Categories
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type = "integer")
     */
    protected $id;
    /**
     * @ORM\Column(type = "string", unique = true)
     */
    protected $name;
    /**
     * @ORM\Column(type = "string")
     */
    protected $description;
    /**
     * @ORM\ManyToMany(targetEntity = "Picture", mappedBy="categories")
     */
    protected $pictures;
    /**
     * @ORM\ManyToMany(targetEntity = "Users", inversedBy="favoriteCategories")
     * @ORM\JoinTable(name="favorite_categories_users")
     */
    protected $favoriteByUsers;


    /**
     * Constructor
     */
    public function __construct($name,$description){
        $this->name = $name;
        $this->description = $description;
        $this->channels = new \Doctrine\Common\Collections\ArrayCollection();
        $this->surveys = new \Doctrine\Common\Collections\ArrayCollection();
        $this->favoriteByUsers = new \Doctrine\Common\Collections\ArrayCollection();

    }

    /**
     * Get id
     * @return integer
     */
    public function getId(){
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Categories
     */
    public function setName($name){
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName(){
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Categories
     */
    public function setDescription($description){
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription(){
        return $this->description;
    }

    /**
     * Add picture
     *
     * @param \AppBundle\Entity\Picture $picture
     *
     * @return Categories
     */
    public function addPicture(\AppBundle\Entity\Picture $picture)
    {
        $this->pictures[] = $picture;

        return $this;
    }

    /**
     * Remove picture
     *
     * @param \AppBundle\Entity\Picture $picture
     */
    public function removePicture(\AppBundle\Entity\Picture $picture)
    {
        $this->pictures->removeElement($picture);
    }

    /**
     * Get pictures
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPictures()
    {
        return $this->pictures;
    }

    /**
     * Add favoriteByUser
     *
     * @param \AppBundle\Entity\Users $favoriteByUser
     *
     * @return Categories
     */
    public function addFavoriteByUser(\AppBundle\Entity\Users $favoriteByUser)
    {
        $this->favoriteByUsers[] = $favoriteByUser;

        return $this;
    }

    /**
     * Remove favoriteByUser
     *
     * @param \AppBundle\Entity\Users $favoriteByUser
     */
    public function removeFavoriteByUser(\AppBundle\Entity\Users $favoriteByUser)
    {
        $this->favoriteByUsers->removeElement($favoriteByUser);
    }

    /**
     * Get favoriteByUsers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFavoriteByUsers()
    {
        return $this->favoriteByUsers;
    }
}
