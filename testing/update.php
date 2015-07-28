<?php

if(isset($_POST['editFamily']))
{

require_once("db_functions.php"); 

$rows = db_select("SELECT `address`,`phone` FROM `info` WHERE id=1");

if($rows === false) {
 $error = db_error();
}

#echo '<pre>'; print_r($rows); echo '</pre>';

#echo $rows[0]['address'];
#echo $rows->['address']; 
#echo '<p>hello</p>';
?>



<form name="form1" method="post" action="update_account.php">
Address: <input name="address" type="text" id="name" value="<?php echo $rows[0]['address']; ?>">
Phone: <input name="phone" type="text" id="lastname" value="<?php echo
$rows[0]['phone']; ?>" size="15">
<input type="Submit" value="Update">
</form>
<?php

}

?>

