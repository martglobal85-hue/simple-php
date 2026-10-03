
<?php 
require "conn.php";

$categories = mysqli_query($conn,"select * from product_categories order by name");

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>

	<div class="container">
		<div class="row">
			<div class="col-md-3">
				<ul>
					<?php while($cat = mysqli_fetch_assoc($categories)) { ?>
					<li>
						<input type="checkbox" 
						name="cat" 
						id="cat_<?php echo htmlspecialchars($cat['id']) ?>"
						value="<?php echo htmlspecialchars($cat['id']) ?>"
						onclick="CategoryData('<?php echo htmlspecialchars($cat['id']) ?>')"
						 /> 
						 <?php echo htmlspecialchars($cat['name']) ?>
					</li>
					<?php } ?>
					<input type="text" name="cat_text" id="cat_text" >
				</ul>
			</div>

			<div class="col-md-9">
				<div id="products" class="row">
			</div>
		</div>
	</div>
</body>
<script src="https://code.jquery.com/jquery-4.0.0.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" ></script>

<script>
$(document).ready(function(){
	loadAllData();
});
function loadAllData()
{
	$.ajax({

		url:"server2.php",
		type:"post",
		data : {
			cat_text : $("#cat_text").val()
		},
		success:function(response){
			$("#products").html(response);
		}

	});


}
function CategoryData(id)	
{

	var ids = [];

	$("input[name='cat']:checked").each(function(){
		ids.push($(this).val());
	})
	
	$("#cat_text").val(
		ids.length ? ids.join(":") + ":" : ""
	);
	
	loadAllData();
}
</script>

</html>