<?php 
	require "conn.php";

$cat_query = mysqli_query($conn,"select * from product_categories order by name");
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>A</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				<ul>
					<?php while($cat = mysqli_fetch_assoc($cat_query)) { ?>
						<li>
						<input type="checkbox" 
							name="cat" 
							value="<?php echo htmlspecialchars($cat['id']) ?>"
							id="cat_<?php echo htmlspecialchars($cat['id']) ?>"
							onclick="getCatWiseData()"
							/><?php echo htmlspecialchars($cat['name']) ?>
						</li>
					<?php } ?>
					<input type="hidden" name="cat_text" id="cat_text">
				</ul>
			</div>
			<div class="col-md-9">
				<div id="products" class="row">
			</div>
		</div>
	</div>

</body>
<script src="https://code.jquery.com/jquery-4.0.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

<script>
	$(document).ready(function(){
	 	loadData();
	});

	function loadData()
	{
		$.ajax({
			url : "server3.php",
			type : "post",
			data : {
				cat_text : $("#cat_text").val()
			},
			success : function(response){
				$("#products").html(response);
			}

		});
	}

	function getCatWiseData()
	{
		var ids = [];
		
		$("input[name='cat']:checked").each(function(){
			ids.push($(this).val());
		});

		$("#cat_text").val(
			ids.length ? ids.join(":") + ":" : ''
		);

		loadData();
	}
</script>
</html>