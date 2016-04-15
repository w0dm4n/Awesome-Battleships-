<?php
trait ShipVar
{
	private $_name = "Unknown ship";
	private $_size_x;
	private $_size_y;
	private $_life = 5;
	private $_PP = 10;
	private $_default_PP = 0;
	private $_case_per_tour = 15;
	private $_default_case_per_tour = 0;
	private $_shield_point = 0;
	private $_available_weapon = array();
	private $_current_position_x = 0;
	private $_current_position_y = 0;
	private $_activated = false;
	private $_already_played = false;

	public function GetName() { return ($this->_name); }
	public function GetSizeX() { return ($this->_size_x); }
	public function GetSizeY() { return ($this->_size_y); }
	public function GetCurrentPositionX() { return ($this->_current_position_x); }
	public function GetCurrentPositionY() { return ($this->_current_position_y); }
	public function GetLife() { return ($this->_life); }
	public function GetPP() { return ($this->_PP); }
	public function GetCasePerTour() { return ($this->_case_per_tour); }
	public function GetAvailableWeapon() { return ($this->_available_weapon); }
	public function AddWeapon($weapon) { array_push($this->_available_weapon, $weapon); }
	public function GetShieldPoint() { return ($this->_shield_point); }
	public function SetAlreadyPlayed() { $this->_already_played = true; $this->_activated = false;}
	public function CheckAlreadyPlayed() { if ($this->_already_played) return true; else return false;}

	public function ActivateShip() { $this->_activated = true; }
	public function DisableShip() { $this->_activated = false; }
	public function IsActivated() { if ($this->_activated) return true; else return false; }
	public function SetCurrentPositionX($position) { $this->_current_position_x = $position; }
	public function SetCurrentPositionY($position) { $this->_current_position_y = $position; }
	public function SubstractLife($life) { $this->_life = $this->_life - $life; }
	public function SetDefaultValue() { $this->_default_case_per_tour = $this->_case_per_tour; $this->_default_PP = $this->_PP; }
	public function ResetValue() {  $this->_case_per_tour = $this->_default_case_per_tour; $this->_PP = $this->_default_PP; $this->_already_played = 0;  $this->_activated = 0; }
	public static function GetAllDefaultShip()
	{
		/* P1 */
		$ship_1 = array(
				"name" => "Mastodonte",
				"x_size" => 8,
				"y_size" => 5,
				"life" => 15,
				"PP" => 15,
				"case_per_tour" => 5,
				"current_pos_x" => 225,
				"current_pos_y" => 105, 
				"shield" => 7);

		$ship_2 = array(
				"name" => "Regular",
				"x_size" => 5,
				"y_size" => 3,
				"life" => 10,
				"PP" => 10,
				"case_per_tour" => 10,
				"current_pos_x" => 405,
				"current_pos_y" => 105,
				"shield" => 4);

		$ship_3 = array(
				"name" => "Scout",
				"x_size" => 3,
				"y_size" => 2,
				"life" => 7,
				"PP" => 5,
				"case_per_tour" => 20,
				"current_pos_x" => 600,
				"current_pos_y" => 105,
				"shield" => 2);
		/* P1 */

		/*P2 */
		$ship_4 = array(
				"name" => "Mastodonte",
				"x_size" => 8,
				"y_size" => 5,
				"life" => 15,
				"PP" => 15,
				"case_per_tour" => 5,
				"current_pos_x" => 225,
				"current_pos_y" => 1635,
				"shield" => 7);

		$ship_5 = array(
				"name" => "Regular",
				"x_size" => 5,
				"y_size" => 3,
				"life" => 10,
				"PP" => 10,
				"case_per_tour" => 10,
				"current_pos_x" => 405,
				"current_pos_y" => 1635,
				"shield" => 4);

		$ship_6 = array(
				"name" => "Scout",
				"x_size" => 3,
				"y_size" => 2,
				"life" => 7,
				"PP" => 5,
				"case_per_tour" => 20,
				"current_pos_x" => 600,
				"current_pos_y" => 1635,
				"shield" => 2);
		/* P2 */
		foreach ($_SESSION["player_1"] as $value)
		{
			$value = unserialize($value);
			if ((get_class($value) == "Player"))
				$player_1 = $value;
		}
		foreach ($_SESSION["player_2"] as $value)
		{
			$value = unserialize($value);
			if ((get_class($value) == "Player"))
				$player_2 = $value;
		}
		$player_1->AddShip(new Ship($ship_1, new Weapon("Machine gun")));
		$player_1->AddShip(new Ship($ship_2, new Weapon("Regular gun")));
		$player_1->AddShip(new Ship($ship_3, new Weapon("Little gun")));

		$player_2->AddShip(new Ship($ship_4, new Weapon("Machine gun")));
		$player_2->AddShip(new Ship($ship_5, new Weapon("Regular gun")));
		$player_2->AddShip(new Ship($ship_6, new Weapon("Little gun")));
		$_SESSION["player_1"] = array();
		array_push($_SESSION["player_1"], serialize($player_1));
		$_SESSION["player_2"] = array();
		array_push($_SESSION["player_2"], serialize($player_2));
	}

	public function GetAllData() { echo 'GSD;'.$this->_name.';'.$this->_life.';'.$this->_shield_point.';'.$this->_PP.';'.$this->_case_per_tour.';'.$this->_current_position_x.';'.$this->_current_position_y.';';
	if (!$this->_activated)
		echo '0';
	else
		echo '1';
	 }
}
?>