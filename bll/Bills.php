
<?php
/**
 *
 */
include_once  __DIR__.DIRECTORY_SEPARATOR."../dal/DaoBills.php";
class Bills{

	/**
	 * get unpaid users
	 */
	public static function getUnPaidBills(){
		$result = DaoBills::getUnPaidBills();
		$unpaidBills = array();
		while($row = mysql_fetch_array($result))
		{
			$unpaidBills[$row['id']] = $row['username'];
		}
		return $unpaidBills;
	}
}
?>
