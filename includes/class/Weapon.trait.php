<?php
trait WeaponVar
{
	private $_PP_cost;
	private $_damage;
	private $_name;
	private $_PO;

	public function GetPPCost() { return ($this->_PP_cost); }
	public function GetDamage() { return ($this->_damage); }
	public function GetName() { return ($this->_name); }
	public function GetPo() { return ($this->_po); }
	public function GetData() { echo 'GW;'.$this->_name.';'.$this->_damage.';'.$this->_PP_cost.';'.$this->_PO.''; }
}
?>