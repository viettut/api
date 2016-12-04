<?php

namespace Viettut\Model\User;

use Viettut\Model\ModelInterface;

interface UserEntityInterface extends ModelInterface
{
    public function getId();

    public function getUsername();

    /**
     * Returns the roles granted to the user.
     *
     * <code>
     * public function getRoles()
     * {
     *     return array('ROLE_USER');
     * }
     * </code>
     *
     * @return []
     */
    public function getRoles();

    public function hasRole($role);

    /**
     * Adds a role to the user.
     *
     * @param string $role
     *
     * @return self
     */
    public function addRole($role);

    /**
     * @param array $roles
     * @return void
     */
    public function setUserRoles(array $roles);

    /**
     * @return array
     */
    public function getUserRoles();

    /**
     * @return string
     */
    public function getFacebookId();

    /**
     * @param string $facebookId
     * @return $this
     */
    public function setFacebookId($facebookId);

    /**
     * @return string
     */
    public function getGoogleId();

    /**
     * @param string $googleId
     * @return $this
     */
    public function setGoogleId($googleId);

    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $name
     * @return $this
     */
    public function setName($name);

    /**
     * @return string
     */
    public function getProfessional();

    /**
     * @param string $professional
     * @return $this
     */
    public function setProfessional($professional);

    /**
     * @return string
     */
    public function getCompany();

    /**
     * @param string $company
     * @return $this
     */
    public function setCompany($company);

    /**
     * @return int
     */
    public function getGender();

    /**
     * @param int $gender
     * @return $this
     */
    public function setGender($gender);

    /**
     * @return string
     */
    public function getPhone();

    /**
     * @param string $phone
     * @return $this
     */
    public function setPhone($phone);

    /**
     * @return string
     */
    public function getCity();

    /**
     * @param string $city
     * @return $this
     */
    public function setCity($city);

    /**
     * @return string
     */
    public function getAddress();

    /**
     * @param string $address
     * @return $this
     */
    public function setAddress($address);

    /**
     * @return string
     */
    public function getCountry();

    /**
     * @param string $country
     * @return $this
     */
    public function setCountry($country);

    /**
     * @return string
     */
    public function getAvatar();

    /**
     * @param string $avatar
     * @return $this
     */
    public function setAvatar($avatar);

    /**
     * @return array
     */
    public function getSettings();

    /**
     * @param array $settings
     * @return $this
     */
    public function setSettings($settings);

    /**
     * @return mixed
     */
    public function getJoinDate();
}