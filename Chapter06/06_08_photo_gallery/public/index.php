<?php
require_once("../includes/database.php");
require_once("../includes/dao_user.php");

$db = new MySQLDatabase();
$dao_user = new DAOUser($db);

$user = $dao_user->find_by_id(1);
echo $user->full_name();

echo "<hr />";

$users = $dao_user->find_all();
foreach($users as $user) {
  echo "User: ". $user->username ."<br />";
  echo "Name: ". $user->full_name() ."<br /><br />";
}

?>