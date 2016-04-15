<?php
session_start();
require_once("includes/All.php");
$action = NULL;
if (empty($_SESSION["player_1"]) && empty($_SESSION["player_2"]))
{
	$_SESSION["player_1"] = array();
	$_SESSION["player_2"] = array();
	$player_1 = NULL;
	$player_2 = NULL;
	if (isset($_GET["user_1"]) && isset($_GET["user_2"]))
	{
		$user_2_name = explode('?', $_GET["user_2"]);
		$player_1 = new Player();
		@$player_1->SetName($_GET["user_1"]);
		$player_2 = new Player();
		@$player_2->SetName($user_2_name[0]);
		array_push($_SESSION["player_1"], serialize($player_1));
		array_push($_SESSION["player_2"], serialize($player_2));
		Ship::GetAllDefaultShip();
		Player::SendAllShip($_SESSION['player_1']);
		Player::SendAllShip($_SESSION['player_2']);
		$turn = new Turn($_GET["user_1"]);
		$_SESSION["turn"] = serialize($turn);
	}
	else
		echo "false;error";
}
else
{
	@$action = $_GET["action"];
	@$name = $_GET["name"];
	if (!empty($_GET["action"]))
	{
		switch ($action)
		{
			case "turn":
				$turn = unserialize($_SESSION["turn"]);
				if ($_GET["player"] == $turn->GetCurrentPlayer())
					echo "true";
				else
					echo "false";
			break ;

			case "end_turn":
				$turn = unserialize($_SESSION["turn"]);
				$player1_name = Utility::GetPlayerName(1);
				$player2_name = Utility::GetPlayerName(2);
				if ($_GET["player"] == $player2_name)
					Utility::ResetShip($_SESSION["player_1"], 1);
				else
					Utility::ResetShip($_SESSION["player_2"], 2);
				$turn->SetCurrentPlayer($_GET["player"]);
				$_SESSION["turn"] = serialize($turn);
				echo 'true';
			break ;

			case "get_ship_data_by_name":
				foreach ($_SESSION['player_'.substr($_GET['player'], 0, 1).''] as $value)
				{
					$value = unserialize($value);
					if (get_class($value) == 'Player')
					{
						$ships = $value->GetShip();
						foreach ($ships as $ship)
						{
							$ship = unserialize($ship);
							if ($ship->GetName() == $_GET["name"])
							{
								$ship->GetAllData();
								echo ';'.$value->getName().'';
							}
						}
					}
				}
			break ;

			case "get_weapon":
				foreach ($_SESSION['player_'.substr($_GET['player'], 0, 1).''] as $value)
				{
					$value = unserialize($value);
					if (get_class($value) == 'Player')
					{
						$ships = $value->GetShip();
						foreach ($ships as $ship)
						{
							$ship = unserialize($ship);
							if ($ship->GetName() == $_GET["name"])
							{
								$weapons = $ship->GetAvailableWeapon();
								foreach ($weapons as $weapon)
								{
									$weapon = unserialize($weapon);
									$weapon->GetData();
									echo ";".$ship->GetName();
								}
							}
						}
					}
				}
			break ;

			case "set_played":
				foreach ($_SESSION['player_'.substr($_GET['player'], 0, 1).''] as $value)
				{
					$value = unserialize($value);
					if (get_class($value) == 'Player')
					{
						$ships = $value->GetShip();
						foreach ($ships as $ship)
						{
							$ship = unserialize($ship);
							if ($ship->GetName() == $_GET["name"])
							{
								$ship->SetAlreadyPlayed();
								if ($_GET["name"] == "Mastodonte")
									$ships[0] = serialize($ship);
								else if ($_GET["name"] == "Regular")
									$ships[1] = serialize($ship);
								else if ($_GET["name"] == "Scout")
									$ships[2] = serialize($ship);
								$found = true;
							}
						}
						if ($found)
						{
							$value->UpdateShip($ships);
							$_SESSION['player_'.substr($_GET['player'], 0, 1)][0] = serialize($value);
							echo "true";
						}
						else
							echo "false";
					}
				}
			break ;

			case "active_ship":
			$index = 0;
				foreach ($_SESSION['player_'.substr($_GET['player'], 0, 1).''] as $value)
				{
					$value = unserialize($value);
					if (get_class($value) == 'Player')
					{
						$ships = $value->GetShip();
						$i = 0;
						$found = false;
						foreach ($ships as $ship)
						{
							$ship = unserialize($ship);
							if ($ship->GetName() == $_GET["name"])
							{
								if (Turn::CheckTurn($_SESSION["turn"], $value->GetName()))
								{
									if (!$ship->CheckAlreadyPlayed())
									{
										$ship->ActivateShip();
										if ($_GET["name"] == "Mastodonte")
											$ships[0] = serialize($ship);
										else if ($_GET["name"] == "Regular")
											$ships[1] = serialize($ship);
										else if ($_GET["name"] == "Scout")
											$ships[2] = serialize($ship);
										$found = true;
									}
									else
										die("false");
								}
								else
									die("false");
							}
							$i++;
						}
						if ($found)
						{
							$value->UpdateShip($ships);
							$_SESSION['player_'.substr($_GET['player'], 0, 1)][0] = serialize($value);
							echo 'true';
						}
						else
							echo "false";
					}
					$index++;
				}
			break ;

			case "update_info":
				$index = 0;
				foreach ($_SESSION['player_'.substr($_GET['player'], 0, 1).''] as $value)
				{
					$value = unserialize($value);
					if (get_class($value) == 'Player')
					{
						$ships = $value->GetShip();
						$i = 0;
						$found = false;
						foreach ($ships as $ship)
						{
							$ship = unserialize($ship);
							if ($ship->GetName() == $_GET["name"])
							{
								if (Turn::CheckTurn($_SESSION["turn"], $value->GetName()))
								{
									$ship->SetCurrentPositionX($_GET["y"]);
									$ship->SetCurrentPositionY($_GET["x"]);
									if (isset($_GET["life"]))
										$ship->SubstractLife($_GET["life"]);
									if ($_GET["name"] == "Mastodonte")
										$ships[0] = serialize($ship);
									else if ($_GET["name"] == "Regular")
										$ships[1] = serialize($ship);
									else if ($_GET["name"] == "Scout")
										$ships[2] = serialize($ship);
									$found = true;
								}
								else
									die("false");
							}
							$i++;
						}
						if ($found)
						{
							$value->UpdateShip($ships);
							$_SESSION['player_'.substr($_GET['player'], 0, 1)][0] = serialize($value);
							echo 'true';
						}
						else
							echo "error";
					}
					$index++;
				}
			break ;
		}
	}
	else
	{
		Player::SendAllShip($_SESSION['player_1']);
		Player::SendAllShip($_SESSION['player_2']);
	}
}
?>