<?php
interface iPlayer
{
	public function SetName($player_name);
	public function GetName();
	public function AddShip($class);
	public function UpdateShip($new);
	public function GetShip();
	public static function doc();
}
?>