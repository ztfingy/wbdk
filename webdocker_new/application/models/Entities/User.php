<?php
namespace Entities;

class User {
	protected $id = '';
	protected $username;
	protected $password;
	protected $lastname;
	protected $firstname;
	protected $address;
	protected $email;
	protected $telephone;
	protected $job;
	protected $idTeam;
	protected $idGroup;
	protected $creationDate;
	protected $lastLoginDate;
	protected $expireDate;
	protected $ipAddress;
	protected $isLogged;
	protected $isValid;
	
	public function getId() {
		return $this->id;
	}
	
	/**
	 * @return the $username
	 */
	public function getUsername() {
		return $this->username;
	}

	/**
	 * @return the $password
	 */
	public function getPassword() {
		return $this->password;
	}

	/**
	 * @return the $lastname
	 */
	public function getLastname() {
		return $this->lastname;
	}

	/**
	 * @return the $firstname
	 */
	public function getFirstname() {
		return $this->firstname;
	}

	/**
	 * @return the $address
	 */
	public function getAddress() {
		return $this->address;
	}

	/**
	 * @return the $email
	 */
	public function getEmail() {
		return $this->email;
	}

	/**
	 * @return the $telephone
	 */
	public function getTelephone() {
		return $this->telephone;
	}

	/**
	 * @return the $job
	 */
	public function getJob() {
		return $this->job;
	}

	/**
	 * @return the $idTeam
	 */
	public function getIdTeam() {
		return $this->idTeam;
	}

	/**
	 * @return the $idGroup
	 */
	public function getIdGroup() {
		return $this->idGroup;
	}

	/**
	 * @return the $creationDate
	 */
	public function getCreationDate() {
		return $this->creationDate;
	}

	/**
	 * @return the $lastLoginDate
	 */
	public function getLastLoginDate() {
		return $this->lastLoginDate;
	}

	/**
	 * @return the $expireDate
	 */
	public function getExpireDate() {
		return $this->expireDate;
	}

	/**
	 * @return the $ipAddress
	 */
	public function getIpAddress() {
		return $this->ipAddress;
	}

	/**
	 * @return the $isLogged
	 */
	public function getIsLogged() {
		return $this->isLogged;
	}

	/**
	 * @return the $isValid
	 */
	public function getIsValid() {
		return $this->isValid;
	}

	/**
	 * @param field_type $username
	 */
	public function setUsername($username) {
		$this->username = $username;
	}

	/**
	 * @param field_type $password
	 */
	public function setPassword($password) {
		$this->password = $password;
	}

	/**
	 * @param field_type $lastname
	 */
	public function setLastname($lastname) {
		$this->lastname = $lastname;
	}

	/**
	 * @param field_type $firstname
	 */
	public function setFirstname($firstname) {
		$this->firstname = $firstname;
	}

	/**
	 * @param field_type $address
	 */
	public function setAddress($address) {
		$this->address = $address;
	}

	/**
	 * @param field_type $email
	 */
	public function setEmail($email) {
		$this->email = $email;
	}

	/**
	 * @param field_type $telephone
	 */
	public function setTelephone($telephone) {
		$this->telephone = $telephone;
	}

	/**
	 * @param field_type $job
	 */
	public function setJob($job) {
		$this->job = $job;
	}

	/**
	 * @param field_type $idTeam
	 */
	public function setIdTeam($idTeam) {
		$this->idTeam = $idTeam;
	}

	/**
	 * @param field_type $idGroup
	 */
	public function setIdGroup($idGroup) {
		$this->idGroup = $idGroup;
	}

	/**
	 * @param field_type $creationDate
	 */
	public function setCreationDate($creationDate) {
		$this->creationDate = $creationDate;
	}

	/**
	 * @param field_type $lastLoginDate
	 */
	public function setLastLoginDate($lastLoginDate) {
		$this->lastLoginDate = $lastLoginDate;
	}

	/**
	 * @param field_type $expireDate
	 */
	public function setExpireDate($expireDate) {
		$this->expireDate = $expireDate;
	}

	/**
	 * @param field_type $ipAddress
	 */
	public function setIpAddress($ipAddress) {
		$this->ipAddress = $ipAddress;
	}

	/**
	 * @param field_type $isLogged
	 */
	public function setIsLogged($isLogged) {
		$this->isLogged = $isLogged;
	}

	/**
	 * @param field_type $isValid
	 */
	public function setIsValid($isValid) {
		$this->isValid = $isValid;
	}

	
	
	
}
