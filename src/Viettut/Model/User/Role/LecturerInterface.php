<?php

namespace Viettut\Model\User\Role;

interface LecturerInterface extends UserRoleInterface
{
    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $name
     * @return self
     */
    public function setName($name);

    /**
     * @return string
     */
    public function getProfessional();

    /**
     * @param string $professional
     * @return self
     */
    public function setProfessional($professional);

    /**
     * @return string
     */
    public function getActive();

    /**
     * @param string $active
     * @return self
     */
    public function setActive($active);

    /**
     * @return string
     */
    public function getActiveCode();

    /**
     * @param mixed $activeCode
     * @return self
     */
    public function setActiveCode($activeCode);

    /**
     * @return string
     */
    public function getCompany();

    /**
     * @param string $company
     * @return self
     */
    public function setCompany($company);

    /**
     * @return string
     */
    public function getPhone();

    /**
     * @param string $phone
     * @return self
     */
    public function setPhone($phone);

    /**
     * @return string
     */
    public function getCity();

    /**
     * @param string $city
     * @return self
     */
    public function setCity($city);

    /**
     * @return string
     */
    public function getState();

    /**
     * @param string $state
     * @return self
     */
    public function setState($state);

    /**
     * @return string
     */
    public function getAddress();

    /**
     * @param string $address
     * @return self
     */
    public function setAddress($address);

    /**
     * @return string
     */
    public function getPostalCode();

    /**
     * @param string $postalCode
     * @return self
     */
    public function setPostalCode($postalCode);

    /**
     * @return string
     */
    public function getCountry();

    /**
     * @param string $country
     * @return self
     */
    public function setCountry($country);

    /**
     * @return string
     */
    public function getEmail();

    /**
     * @return string
     */
    public function getAvatar();

    /**
     * @param $avatar
     * @return self
     */
    public function setAvatar($avatar);

    /**
     * @return mixed
     */
    public function getSettings();

    /**
     * @param mixed $settings
     */
    public function setSettings($settings);
}