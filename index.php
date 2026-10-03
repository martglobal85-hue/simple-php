<?php 
 require "conn.php";
 $category_query = mysqli_query($conn,"select * from product_categories order by name"); 

if(!$category_query)
{
	die('Query Faild'.mysqli_error($conn));
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
	<title>Shop</title>
</head>
<body>

	<div class="container">

		<div class="row">
			<div class="col-md-3 ">
				<ul>
					<?php while($category = mysqli_fetch_assoc($category_query)) { ?>
						<li>
							<input type="checkbox" name="cat" id="cat_<?php echo $category['id'] ?>" value="<?php echo $category['id'] ?>" onclick="CatgoryCart('<?php echo $category['id']  ?>')">
							<?php echo htmlspecialchars($category['name']) ?>
						</li>

					<?php } ?>
					<input type="hidden" name="cat_text" id="cat_text">
				</ul>
			</div>

			<div class="col-md-9 bg-info">
				<div id="products"  class="row"></div>
			</div>
		</div>
	</div>




</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" ></script>
<script src="https://code.jquery.com/jquery-4.0.0.js"></script>

<script>

	$(document).ready(function(){
		loadProduct();	
	});

	function CatgoryCart(id)
	{
		var ids = [];

		$("input[name='cat']:checked").each(function(){
			ids.push($(this).val());
		});

		


		$("#cat_text").val(
			ids.length ? ids.join(":") + ":" : ""
		);

		loadProduct();
	}


	function loadProduct()
	{
		$.ajax({

			url:"server.php",
			type : "post",
			data : {
				cat_text : $("#cat_text").val()
			},
			success : function(response){
				$("#products").html(response);
			}

		});
	}


</script>



</html>