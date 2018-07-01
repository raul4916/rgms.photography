<?php
/**
 * Created by PhpStorm.
 * User: raul
 * Date: 2/11/16
 * Time: 5:04 PM
 */

namespace AppBundle\Entity;


use Doctrine\ORM\Query\QueryException;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * @ORM\Entity
 * @ORM\Table(name="Picture")
 */
class Picture
{
	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy = "AUTO")
	 * @ORM\Column(type="bigint")
	 */
	protected $id;
	/**
	 * @ORM\Column(type="string")
	 */
	protected $dir;
	/**
	 * @ORM\Column(type="string")
	 */
	protected $imageName;
	/**
	 * @ORM\Column(type="string")
	 */
	protected $date;
	/**
	 * @ORM\Column(type="string")
	 */
	protected $client;
	/**
	 * @ORM\Column(type="string")
	 */
	protected $category;
    /**
     * @ORM\Column(type="string")
     */
    protected $highlight;
	/**
	 * @ORM\ManyToOne(targetEntity = "Users", inversedBy="surveys");
	 */
	protected $user;
	/**
	 * @ORM\ManyToMany(targetEntity = "Categories", mappedBy="pictures")
	 */
	protected $categories;

	/**
	 * Picture constructor.
	 * @param $filepath
	 * @param $date
	 * @param $client
	 * @param $category
	 * @param $highlight
 	 * @param $user
	 */
	public function __construct($dir,$imageName,$date = NONE,$category=NONE,$client=NONE, $highlight = 'false', $user = null,$categories = null){

		$this->dir = $dir;
		$this->imageName = $imageName;
		if($date==NONE){
			$this->date= date('Y-m-d');
		}else {
            $this->date = $date;
        }
		$this->client = $client;
		$this->category = $category;
		$this->highlight = $highlight;
		$this->user = $user;
		$this->categories = $categories;
	}


	/**
	 * Get id
	 *
	 * @return integer
	 */
	public function getId(){
		return $this->id;
	}

	/**
	 * Set filepath
	 *
	 * @param string $filepath
	 *
	 * @return Picture
	 */
	public function setFilepath($filepath){
		$this->filepath = $filepath;

		return $this;
	}

	/**
	 * Get filepath
	 *
	 * @return string
	 */
	public function getFilepath(){
		return $this->filepath;
	}

	/**
	 * Set date
	 *
	 * @param string $date
	 *
	 * @return Picture
	 */
	public function setDate($date){
		$this->date = $date;

		return $this;
	}

	/**
	 * Get date
	 *
	 * @return string
	 */
	public function getDate(){
		return $this->date;
	}

	/**
	 * Set client
	 *
	 * @param string $client
	 *
	 * @return Picture
	 */
	public function setClient($client){
		$this->client = $client;

		return $this;
	}

	/**
	 * Get client
	 *
	 * @return string
	 */
	public function getClient(){
		return $this->client;
	}

	/**
	 * Set category
	 *
	 * @param string $category
	 *
	 * @return Picture
	 */
	public function setCategory($category){
		$this->category = $category;

		return $this;
	}

	/**
	 * Get category
	 *
	 * @return string
	 */
	public function getCategory(){
		return $this->category;
	}


    /**
     * Set dir
     *
     * @param string $dir
     *
     * @return Picture
     */
    public function setDir($dir)
    {
        $this->dir = $dir;

        return $this;
    }

    /**
     * Get dir
     *
     * @return string
     */
    public function getDir()
    {
        return $this->dir;
    }

    /**
     * Set imageName
     *
     * @param string $imageName
     *
     * @return Picture
     */
    public function setImageName($imageName)
    {
        $this->imageName = $imageName;

        return $this;
    }

    /**
     * Get imageName
     *
     * @return string
     */
    public function getImageName()
    {
        return $this->imageName;
    }

    /**
     * Set highlight
     *
     * @param string $highlight
     *
     * @return Picture
     */
    public function setHighlight($highlight)
    {
        $this->highlight = $highlight;

        return $this;
    }

    /**
     * Get highlight
     *
     * @return string
     */
    public function getHighlight()
    {
        return $this->highlight;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\Users $user
     *
     * @return Picture
     */
    public function setUser(\AppBundle\Entity\Users $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\Users
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Add category
     *
     * @param \AppBundle\Entity\Categories $category
     *
     * @return Picture
     */
    public function addCategory(\AppBundle\Entity\Categories $category)
    {
        $this->categories[] = $category;

        return $this;
    }

    /**
     * Remove category
     *
     * @param \AppBundle\Entity\Categories $category
     */
    public function removeCategory(\AppBundle\Entity\Categories $category)
    {
        $this->categories->removeElement($category);
    }

    /**
     * Get categories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCategories()
    {
        return $this->categories;
    }
}
