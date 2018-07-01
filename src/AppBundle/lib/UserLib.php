<?php
/**
 * Created by PhpStorm.
 * User: raul
 * Date: 2/12/16
 * Time: 12:55 PM
 */
namespace AppBundle\lib;


use AppBundle\Entity\Users;
use AppBundle\Entity\Locations;
use Doctrine\DBAL\Query\QueryException;
use Doctrine\Bundle\DoctrineBundle\Registry;

class UserLib
{
    /**
    ($id, $username, $date_create, $date_login, $email, $email_confirmed, $fname,
    $lname,$gender, $location, $age, $primary_lang, $race, $origin,$status,$group,
    $authentication)
     *
     */
    static function addUserArray(Registry $db,array $user_info)
    {
        return self::addUser($db,$user_info['username'],$user_info['password'],$user_info['date_create'],$user_info['date_login'],$user_info['email'],$user_info['fname'],
            $user_info['lname'],$user_info['gender'],$user_info['city'],$user_info['state'],$user_info['country'],$user_info['age']);

    }
    static function addUser(Registry $db,$username,$password, $date_create, $date_login, $email,$fname = null, $lname = null,
                            $gender = null,$city = null,$state = null,$country = null, $age = null,
                            $status = ACTIVE,$email_confirmed = EMAIL_NOT_CONFIRMED)
    {
        if(($user = self::getUser($db,$username))!=null){
            return $user;
        }
        $man  = $db->getManager();
        $fid = password_hash($password,PASSWORD_DEFAULT);
        $location = LocationsLib::createLocation($db,$country,$state,$city);
        $man->persist($location);
        $user = new Users($username,$fid,$date_create,$date_login,$email,$email_confirmed,$fname,
            $lname,$gender,$location,$age,$status);
        $man->persist($user);
        $man->flush();
    }
    /**
     * @param $db
     * @param $username
     * @param $pass
     * @return Users
     * @throws QueryException
     */
    static function getUser(Registry $db, $username){
        if(!isset($db))
            throw new QueryException("No database");
        $user = $db->getRepository('AppBundle:Users')->findByUsername($username);
        if(array_key_exists(0,$user)){
            $user = $user[0];
            if( !$user->getEmailConfirmed() ==  EMAIL_NOT_CONFIRMED)
                throw new QueryException("Email not confirmed");
        }else{
            return null;
        }
        return $user;
    }
    static function deleteUser(Registry $db,$username){
        self::changeData($db,"status",DELETED,$username);
    }
    static function getUserInfo(Registry $db,$username,$viewer){
        if($viewer == "user") {
            $user = self::getUser($db, $username);
            $username = $user->getUsername();
            $userStatus = $user->getUserStatus();
            $date_login = $user->getDateLogin();
            $date_create = $user->getDateCreate();

            $email = $user>getEmail();
            $email_confirmed = $user->getEmailConfirmed();
            $fname = $user->getFname();
            $lname = $user->getLname();
            $gender = $user->getGender();
            $location = $user->getLocation();
            $age = $user->getAge();

            $array = array(
                "username" => $username,
                "userStatus" => $userStatus,
                "date_login" => $date_login,
                "date_create" => $date_create,
                "email" => $email,
                "email_confirmed" => $email_confirmed,
                "fname" => $fname,
                "lname" => $lname,
                "gender" => $gender,
                "location" => $location,
                "age" => $age,
            );
            return $array;
        }
        if($viewer == "public"){
            $user = self::getUser($db, $username);
            $username = $user->getUsername();
            $date_login = $user->getDateLogin();
            $array = array(
                "username" => $username,
                "date_login" => $date_login
            );
            return $array;
        }
        return null;
    }
    static function  changeData(Registry $db, $data,$dataObj, $username){
        $user = self::getUser($db,$username);
        switch($data){
            case "date_login":
                $time = time();
                $user->setDateLogin($time);
                break;
            case "gender":
                $user->setGender($dataObj);
                break;
            case "email":
                $user->setEmail($dataObj);
                break;
            case "email_confirmed":
                $email = $user->getEmail();
                if(isset($email))
                    $user->setEmailConfirmed($dataObj);
                else
                    throw new QueryException("Email was not set please type the email");
                break;
            case "fname":
                $user->setFname($dataObj);
                break;
            case "lname":
                $user->setFname($dataObj);
                break;
            //will need an array.  Format {country, State, City}
            case "location":
                $location = new Locations($dataObj[0],$dataObj[1],$dataObj[2]);
                $user->setLocation($location);
                $man = $db->getManager();
                $man->persist($location);
                $man>flush();
                break;
            case "status":
                $user.setStatus($dataObj);
                break;
            default:
                new Exception("Wrong dataObj sent");
        }
        $user->flush();
    }
}