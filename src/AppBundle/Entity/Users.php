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

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class Users {
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy = "AUTO")
     * @ORM\Column(type="bigint")
     */
    protected $id;
    /**
     * @ORM\Column(type="string")
     */
    protected $fid; // this will be hash with the user pass
    /**
     * @ORM\Column(type="string", unique=true)
     */
    protected $username;
    /**
     * @ORM\Column(type="string", nullable = true)
     */
    protected $authentication= null;

    /**
     * @ORM\Column(type="bigint")
     */
    protected $date_create;
    /**
     * @ORM\Column(type="bigint")
     */
    protected $date_login;
    /**
     * @ORM\Column(type="string")
     */
    protected $email;
    /**
     * @ORM\Column(type="integer")
     */
    protected $email_confirmed;
    /**
     * @ORM\Column(type="string", nullable = true)
     */
    protected $fname= null;
    /**
     * @ORM\Column(type="string", nullable = true)
     */
    protected $lname= null;
    /**
     * @ORM\ManyToOne(targetEntity="Locations", inversedBy="users")
     */
    protected $location= null;
    /**
     * @ORM\Column(type="integer", nullable = true)
     */
    protected $age= null;
    /**
     * @ORM\Column(type="string", nullable = true)
     */
    protected $userStatus= null;
    /**
     * @ORM\Column(type = "integer", nullable = true)
     */
    protected $gender= null;
	/**
	 * @ORM\OneToMany(targetEntity = "Picture", mappedBy = "users")
	 */
	protected $pictures = null;

    /**
     * Constructor
     */
    public function __construct($username,$password, $date_create, $date_login, $email, $email_confirmed, $fname,
                                $lname,$age,$gender, $location, $status)
    {
        $this->fid = $password;
        $this->gender = $gender;
        $this->username = $username;
        $this->date_create = $date_create;
        $this->date_login = $date_login;
        $this->email = $email;
        $this->email_confirmed = $email_confirmed;
        $this->fname = $fname;
        $this->lname = $lname;
        $this->location = $location;
        $this->age = $age;
        $this->userStatus = $status;
        $this->pictures = new \Doctrine\Common\Collections\ArrayCollection();
    }
    // Custom Functions


    //Functions generated


    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        if(preg_match("/^[A-Za-z]([A-Za-z]|\d)*/", $username)) {
            $this->username = $username;
        }
        throw new QueryException("Problem with the username");
    }



    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        // preg_match for email raul4916@gmail.com is an example.
        if(preg_match("/^[A-Za-z]([A-Za-z]|\d)*@([A-Za-z]|\d)+\.([A-Za-z])+/", $email)) {
            $this->email = $email;
        }
        return new QueryException("Error on the Email");
    }


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
     * Set fid
     *
     * @param string $fid
     *
     * @return Users
     */
    public function setFid($fid)
    {
        $this->fid = $fid;

        return $this;
    }

    /**
     * Get fid
     *
     * @return string
     */
    public function getFid()
    {
        return $this->fid;
    }

    /**
     * Set authentication
     *
     * @param string $authentication
     *
     * @return Users
     */
    public function setAuthentication($authentication)
    {
        $this->authentication = $authentication;

        return $this;
    }

    /**
     * Get authentication
     *
     * @return string
     */
    public function getAuthentication()
    {
        return $this->authentication;
    }

    /**
     * Set dateCreate
     *
     * @param integer $dateCreate
     *
     * @return Users
     */
    public function setDateCreate($dateCreate)
    {
        $this->date_create = $dateCreate;

        return $this;
    }

    /**
     * Get dateCreate
     *
     * @return integer
     */
    public function getDateCreate()
    {
        return $this->date_create;
    }

    /**
     * Set dateLogin
     *
     * @param integer $dateLogin
     *
     * @return Users
     */
    public function setDateLogin($dateLogin)
    {
        $this->date_login = $dateLogin;

        return $this;
    }

    /**
     * Get dateLogin
     *
     * @return integer
     */
    public function getDateLogin()
    {
        return $this->date_login;
    }

    /**
     * Set emailConfirmed
     *
     * @param integer $emailConfirmed
     *
     * @return Users
     */
    public function setEmailConfirmed($emailConfirmed)
    {
        $this->email_confirmed = $emailConfirmed;

        return $this;
    }

    /**
     * Get emailConfirmed
     *
     * @return integer
     */
    public function getEmailConfirmed()
    {
        return $this->email_confirmed;
    }

    /**
     * Set fname
     *
     * @param string $fname
     *
     * @return Users
     */
    public function setFname($fname)
    {
        $this->fname = $fname;

        return $this;
    }

    /**
     * Get fname
     *
     * @return string
     */
    public function getFname()
    {
        return $this->fname;
    }

    /**
     * Set lname
     *
     * @param string $lname
     *
     * @return Users
     */
    public function setLname($lname)
    {
        $this->lname = $lname;

        return $this;
    }

    /**
     * Get lname
     *
     * @return string
     */
    public function getLname()
    {
        return $this->lname;
    }

    /**
     * Set age
     *
     * @param integer $age
     *
     * @return Users
     */
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get age
     *
     * @return integer
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set userStatus
     *
     * @param string $userStatus
     *
     * @return Users
     */
    public function setUserStatus($userStatus)
    {
        $this->userStatus = $userStatus;

        return $this;
    }

    /**
     * Get userStatus
     *
     * @return string
     */
    public function getUserStatus()
    {
        return $this->userStatus;
    }

    /**
     * Set gender
     *
     * @param integer $gender
     *
     * @return Users
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender
     *
     * @return integer
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set location
     *
     * @param \AppBundle\Entity\Locations $location
     *
     * @return Users
     */
    public function setLocation(\AppBundle\Entity\Locations $location = null)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return \AppBundle\Entity\Locations
     */
    public function getLocation()
    {
        return $this->location;
    }


    /**
     * Add picture
     *
     * @param \AppBundle\Entity\Picture $picture
     *
     * @return Users
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
}
