<?php
class Turn
{
	private $_current_player = NULL;
	public function GetCurrentPlayer() { return ($this->_current_player); }
	public function SetCurrentPlayer($new_player) { $this->_current_player = $new_player; }
	public function __construct($first_player) { $this->_current_player = $first_player; }
	public static function CheckTurn($ins, $current_player_name) { $ins = unserialize($ins); return (($ins->GetCurrentPlayer() == $current_player_name) ? true : false); }
	public static function doc() { return (file_get_contents('includes/documentation/Turn.doc.txt')); }
}
?>