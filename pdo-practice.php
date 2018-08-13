<h1>test</h1>

<?php 
// var_dump('test');
// exit;

// echo 'test'; exit;

$servername = "localhost";
$database = "sakila";
$username = "root";
$password = "password";

// Create connection
// $conn = new mysqli($servername, $username, $password);

// // Check connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }
// echo "Connected successfully";
// echo 'test';
try{
     $db = new PDO("mysql:host=localhost;dbname=sakila;","root","password" );
     $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(Exception $e){
     echo 'Unable to connect';
     echo $e->getMessage();
     exit;
}

// get actors
try {
    $results = $db->query(
          "SELECT *
          FROM actor
          LIMIT 10"
    );
} catch (Exception $e) {
    echo "bad query";
    echo $e;
}
$item = $results->fetchAll(PDO::FETCH_ASSOC);

?>





<table>
<?php
foreach ($item as $key => $actor) { ?>
	<tr>
		<td>
		<?php echo $item[$key]['first_name']; ?>
		</td>
		<td>
			<?php echo $item[$key]['last_name']; ?>
		</td>
	</tr>
<?php }
?>
</table>


<h2>Prepares statement</h2>

<?php
/* **************************************************** */
// get customer_list
$country = 'Austria';

try {
    $customer_list = $db->prepare(
          "SELECT *
          FROM customer_list
          WHERE country = :country
          "
    );

    $customer_list->bindParam(':country', $country, PDO::PARAM_STR, 24);
    $customer_list->execute();
    $list = $customer_list->fetchAll(PDO::FETCH_ASSOC);

} catch (Exception $e) {
    echo "bad query";
    echo $e;
}
?>

<table>

<?php
foreach ($list as $key => $value) { ?>

	<tr>
		<td>
			<?php echo($list[$key]['name']); ?>			
		</td>
		<td>
			<?php echo($list[$key]['address']); ?>			
		</td>
		<td>
			<?php  echo($list[$key]['city']); ?>
		</td>
		<td>
			<?php echo($list[$key]['country']);	?>
		</td>
	</tr>

<?php
}
?>

</table>



