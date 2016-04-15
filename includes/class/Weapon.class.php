<?php
class Weapon
{
	use WeaponVar;
	public static function doc() { return (file_get_contents('includes/documentation/Weapon.doc.txt')); }
	public function __construct($weapon_name)
	{
		switch ($weapon_name)
		{
			case "Machine gun":
				$this->_name = $weapon_name;
				$this->_PP_cost = 4;
				$this->_damage = 4;
				$this->_PO = 20;
			break;

			case "Regular gun":
				$this->_name = $weapon_name;
				$this->_PP_cost = 4;
				$this->_damage = 2;
				$this->_PO = 10;
			break ;

			case "Little gun":
				$this->_name = $weapon_name;
				$this->_PP_cost = 4;
				$this->_damage = 1;
				$this->_PO = 6;
			break ;
		}
	}
}
?>