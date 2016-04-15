<?php
class Utility
{
	public static function doc() { return (file_get_contents('includes/documentation/Utility.doc.txt')); }
	public static function GetCurrentPlayer($name)
	{
		$array_1 = $_SESSION["player_1"];
		$array_2 = $_SESSION["player_2"];
		foreach ($array_1 as $value)
		{
			$value = unserialize($value);
			if (get_class($value) == "Player")
				if ($value->GetName() == $name)
					return (1);
		}
		foreach ($array_2 as $value)
		{
			$value = unserialize($value);
			if (get_class($value) == "Player")
				if ($value->GetName() == $name)
					return (2);
		}
		return (-1);
	}
	public static function GetPlayerName($player)
	{
		if ($player == 1)
			$array = $_SESSION["player_1"];
		else if ($player == 2)
			$array = $_SESSION["player_2"];
		foreach ($array as $value)
		{
			$value = unserialize($value);
			if (get_class($value) == "Player")
				return ($value->GetName());
		}
	}
	public static function ResetShip($player, $id)
	{
		foreach ($player as $value)
		{
			$value = unserialize($value);
			if (get_class($value) == 'Player')
			{
				$ships = $value->GetShip();
				foreach ($ships as $ship)
				{
					$ship = unserialize($ship);
					$ship->ResetValue();
					if ($ship->GetName() == "Mastodonte")
						$ships[0] = serialize($ship);
					else if ($ship->GetName() == "Regular")
						$ships[1] = serialize($ship);
					else if ($ship->GetName() == "Scout")
						$ships[2] = serialize($ship);
				}
			}
		}
		$value->UpdateShip($ships);
		$_SESSION['player_'.$id.''][0] = serialize($value);
	}
}
?>