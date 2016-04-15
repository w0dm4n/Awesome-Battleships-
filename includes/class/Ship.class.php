<?php
class Ship
{
	use ShipVar;
	public static function doc() { return (file_get_contents('includes/documentation/Ship.doc.txt')); }
	public function __construct($array, $weapon)
	{
		foreach ($array as $value => $content)
		{
			switch ($value)
			{
				case "name":
					$this->_name = $content;
				break ;

				case "x_size":
					$this->_size_x = $content;
				break ;

				case "y_size":
					$this->_size_y = $content;
				break ;

				case "life":
					$this->_life = $content;
				break ;

				case "PP":
					$this->_PP = $content;
				break ;

				case "case_per_tour":
					$this->_case_per_tour = $content;
				break ;
				
				case "current_pos_x":
				$this->_current_position_x = $content;
				break ;

				case "current_pos_y":
				$this->_current_position_y = $content;
				break ;

				case "shield":
				$this->_shield_point = $content;
				break ;
			}
			$this->SetDefaultValue();
		}
		if ($weapon)
			array_push($this->_available_weapon, serialize($weapon));
	}
}
?>