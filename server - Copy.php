<?php 
require "conn.php";

$cat_text = $_POST['cat_text'] ?? '';

	if(empty($cat_text))
	{
		$q = mysqli_query(
	        $conn,
	        "SELECT * FROM product_master"
    	);
	}
	else
	{
		$ids = array_filter(explode(":",$cat_text));

		// manage integer
		$ids = array_map('intval',$ids);

		// remove duplicate
		$ids = array_unique($ids);

		$id_list = implode(",",$ids);


		$q = mysqli_query(
			$conn,
			"select * from product_master where product_categories_id in ($id_list)"
		);


	}

	if(!$q)
	{
		die("Query Faild ..".mysqli_error($conn));
	}

	while($product = mysqli_fetch_assoc($q))
	{
		echo '<div class="card md-2">';
		
		echo '<div class="card-body">';
		echo '<h5>'. htmlspecialchars($product['name']) .'</h5>';
		echo '</div>';
		echo '</div>';
	}



?>