<?php
class Player extends Utility implements iPlayer 
{
	private $_name = "Unknown";
	private $_all_ship = array();
	public function SetName($player_name) { $this->_name = $player_name; }
	public function GetName() { return ($this->_name); }
	public function AddShip($ins) { array_push($this->_all_ship, serialize($ins)); }
	public function UpdateShip($new) { $this->_all_ship = $new; }
	public function GetShip() { return ($this->_all_ship); }
	public static function doc() { return (file_get_contents('includes/documentation/Player.doc.txt')); }
	public static function SendAllShip($var)
	{
		foreach ($var as $value)
		{
			$value = unserialize($value);
			if (get_class($value) == 'Player')
			{
				$ships = $value->GetShip();
				foreach ($ships as $ship)
				{
					$ship = unserialize($ship);
					$ship->GetAllData();
					echo ';'.$value->getName().' '.PHP_EOL.'';
				}
			}
		}
	}
}
?>