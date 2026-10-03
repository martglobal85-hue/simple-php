
<?php 
require "conn.php";

$cat_text = $_POST['cat_text'] ?? '';

if(empty($cat_text))
{
  $q  = mysqli_query( $conn,"select * from product_master order by name");
  
}
else
{
	$ids = array_filter(explode(":",$cat_text));
	$ids = array_map('intval',$ids);
	$ids = array_unique($ids);
	$id = implode(",",$ids);
	$q = mysqli_query($conn,"select * from product_master where product_categories_id IN ($id)");
}

while($row = mysqli_fetch_assoc($q))
{
	echo '<div class="col-md-4">';
		echo '<div class="card h-100">';
			echo '<img class="img-card-top" src="media/'.$row['path'].'">';
				echo '<div class="card-body d-flex flex-column">';
					echo '<h5>' . htmlspecialchars($row['name']) .'</h5>';
				echo '</div>';
		echo '</div>';
	echo '</div>';
}

?>