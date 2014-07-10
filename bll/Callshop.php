
<?php
/**
 *
 */
include_once  __DIR__.DIRECTORY_SEPARATOR."../dal/DaoCallshop.php";
class Callshop{

	/**
	 * get registed callshop
	 */
	public static function getCallshop(){
		return DaoCallshop::getCallshop();
	}

	/**
	 * get callshop users
	 */
	public static function getUsersByFk_callshop($fk_callshop){
		return DaoCallshop::getUsersByFk_callshop($fk_callshop);
	}

	/**
	 * Insert callshop
	 */
	public static function Callshop_Insert($societe, $addresse=NULL, $cp=NULL, $ville=NULL){
		return DaoCallshop::Callshop_Insert($societe, $addresse, $cp, $ville);
	}

	/**
	 * Delete callshop by id
	 */
	public static function CallshopById_Delete($id){
		return DaoCallshop::CallshopById_Delete($id);
	}
}
?>
