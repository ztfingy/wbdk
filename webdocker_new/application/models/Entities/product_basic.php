<?php
namespace Entities;
class Product_basic {
	protected $id='';
	protected $name;
	protected $type='';
	protected $preview='';
	protected $validation='0';
	protected $excuteat='';
	protected $excuteby='0';
	protected $cdrfulllink='';
	protected $pdffulllink='';
	/**
	 * @return the $id
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @return the $name
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @return the $type
	 */
	public function getType() {
		return $this->type;
	}

	/**
	 * @return the $preview
	 */
	public function getPreview() {
		return $this->preview;
	}

	/**
	 * @return the $validation
	 */
	public function getValidation() {
		return $this->validation;
	}

	/**
	 * @return the $excuteat
	 */
	public function getExcuteat() {
		return $this->excuteat;
	}

	/**
	 * @return the $excuteby
	 */
	public function getExcuteby() {
		return $this->excuteby;
	}

	/**
	 * @return the $cdrfulllink
	 */
	public function getCdrfulllink() {
		return $this->cdrfulllink;
	}

	/**
	 * @return the $pdffulllink
	 */
	public function getPdffulllink() {
		return $this->pdffulllink;
	}

	/**
	 * @param field_type $id
	 */
	public function setId($id) {
		$this->id = $id;
	}

	/**
	 * @param field_type $name
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * @param field_type $type
	 */
	public function setType($type) {
		$this->type = $type;
	}

	/**
	 * @param field_type $preview
	 */
	public function setPreview($preview) {
		$this->preview = $preview;
	}

	/**
	 * @param field_type $validation
	 */
	public function setValidation($validation) {
		$this->validation = $validation;
	}

	/**
	 * @param field_type $excuteat
	 */
	public function setExcuteat($excuteat) {
		$this->excuteat = $excuteat;
	}

	/**
	 * @param field_type $excuteby
	 */
	public function setExcuteby($excuteby) {
		$this->excuteby = $excuteby;
	}

	/**
	 * @param field_type $cdrfulllink
	 */
	public function setCdrfulllink($cdrfulllink) {
		$this->cdrfulllink = $cdrfulllink;
	}

	/**
	 * @param field_type $pdffulllink
	 */
	public function setPdffulllink($pdffulllink) {
		$this->pdffulllink = $pdffulllink;
	}

	
	
	
}

?>