<?php 
// Try catch
function divide($a,$b)
{
	if($b==0)
	{
		throw new Exception("Cannot divide by Zero");
	}

	return $a / $b;
}

try {

	echo divide(10,0);

} catch (Exception $e) {
	echo $e->getMessage();
	// echo $e->getCode();
	// echo $e->getLine();
	// echo $e->getTrace();
} finally {
    echo "<br>Process completed.";
}



?>