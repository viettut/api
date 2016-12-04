<?php
/**
 * Created by PhpStorm.
 * User: giangle
 * Date: 11/29/16
 * Time: 7:54 PM
 */

namespace Viettut\Bundle\UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Viettut\Exception\InvalidArgumentException;
use Viettut\Model\User\UserEntityInterface;

class User extends BaseUser implements UserEntityInterface
{
    const USER_ROLE_PREFIX = 'ROLE_';
    const MODULE_PREFIX = 'MODULE_';
    // we have to redefine the properties we wish to expose with JMS Serializer Bundle

    protected $id;
    protected $username;
    protected $email;
    protected $enabled;
    protected $lastLogin;
    protected $roles;
    protected $joinDate;

    /**
     * @var string
     */
    protected $facebookId;

    /**
     * @var string
     */
    protected $googleId;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $professional;

    /**
     * @var string
     */
    protected $company;

    /**
     * @var int
     */
    protected $gender;

    /**
     * @var string
     */
    protected $phone;

    /**
     * @var string
     */
    protected $city;

    /**
     * @var string
     */
    protected $address;

    /**
     * @var string
     */
    protected $country;

    /**
     * @var string
     */
    protected $avatar;

    /**
     * @var array
     */
    protected $settings;


    /**
     * @inheritdoc
     */
    public function setUserRoles(array $roles)
    {
        $this->replaceRoles(
            $this->getUserRoles(), // old roles
            $roles, // new roles
            static::USER_ROLE_PREFIX,
            $strict = false // this means we add the role prefix and convert to uppercase if it does not exist
        );
    }


    /**
     * @inheritdoc
     */
    public function getUserRoles()
    {
        $roles = $this->getRolesWithPrefix(static::USER_ROLE_PREFIX);

        $roles = array_filter($roles, function($role) {
            return $role !== static::ROLE_DEFAULT;
        });

        return $roles;
    }

    public function setEmail($email)
    {
        if (empty($email)) {
            $email = null;
        }

        $this->email = $email;

        return $this;
    }

    public function setEmailCanonical($emailCanonical)
    {
        if (empty($emailCanonical)) {
            $emailCanonical = null;
        }

        $this->emailCanonical = $emailCanonical;

        return $this;
    }

    /**
     * @param string $prefix i.e ROLE_ or FEATURE_
     * @return array
     */
    protected function getRolesWithPrefix($prefix)
    {
        $roles = array_filter($this->getRoles(), function($role) use($prefix) {
            return $this->checkRoleHasPrefix($role, $prefix);
        });

        return array_values($roles);
    }

    protected function checkRoleHasPrefix($role, $prefix)
    {
        return strpos($role, $prefix) === 0;
    }

    protected function addRoles(array $roles)
    {
        foreach($roles as $role) {
            $this->addRole($role);
        }
    }

    protected function removeRoles(array $roles)
    {
        foreach($roles as $role) {
            $this->removeRole($role);
        }
    }

    /**
     * @param array $oldRoles
     * @param array $newRoles
     * @param $requiredRolePrefix
     * @param bool $strict ensure that the roles have the prefix, don't try to add it
     */
    protected function replaceRoles(array $oldRoles, array $newRoles, $requiredRolePrefix, $strict = false)
    {
        $this->removeRoles($oldRoles);

        foreach($newRoles as $role) {
            // converts fraud_detection to FEATURE_FRAUD_DETECTION
            if (!$this->checkRoleHasPrefix($role, $requiredRolePrefix)) {
                if ($strict) {
                    throw new InvalidArgumentException("role '%s' does not have the required prefix '%s'", $role, $requiredRolePrefix);
                }

                $role = $requiredRolePrefix . strtoupper($role);
            }

            $this->addRole($role);
        }
    }

    /**
     * @return string
     */
    public function getFacebookId()
    {
        return $this->facebookId;
    }

    /**
     * @param string $facebookId
     * @return $this
     */
    public function setFacebookId($facebookId)
    {
        $this->facebookId = $facebookId;
        return $this;
    }

    /**
     * @return string
     */
    public function getGoogleId()
    {
        return $this->googleId;
    }

    /**
     * @param string $googleId
     * @return $this
     */
    public function setGoogleId($googleId)
    {
        $this->googleId = $googleId;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getProfessional()
    {
        return $this->professional;
    }

    /**
     * @param string $professional
     * @return $this
     */
    public function setProfessional($professional)
    {
        $this->professional = $professional;
        return $this;
    }

    /**
     * @return string
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param string $company
     * @return $this
     */
    public function setCompany($company)
    {
        $this->company = $company;
        return $this;
    }

    /**
     * @return int
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param int $gender
     * @return $this
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
        return $this;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     * @return $this
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $city
     * @return $this
     */
    public function setCity($city)
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $address
     * @return $this
     */
    public function setAddress($address)
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param string $country
     * @return $this
     */
    public function setCountry($country)
    {
        $this->country = $country;
        return $this;
    }

    /**
     * @return string
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * @param string $avatar
     * @return $this
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
        return $this;
    }

    /**
     * @return array
     */
    public function getSettings()
    {
        return $this->settings;
    }

    /**
     * @param array $settings
     * @return $this
     */
    public function setSettings($settings)
    {
        $this->settings = $settings;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getJoinDate()
    {
        return $this->joinDate;
    }
}