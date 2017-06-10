<form method="POST">
<span>Broj redaka:</span>
<input type="number" name="rows" />
<span>Broj stupaca:</span>
<input type="number" name="columns" />
<input type="submit" value="Ispiši">
</form>

<?php
//----------------------------------------------------------------------------
if(isset($_POST["rows"]) && isset($_POST["columns"]))
{

	$rows = $_POST["rows"];
	$columns = $_POST["columns"];

	$fill = 1;

	$lowerBoundi = 0;
	$upperBoundi = $rows-1;
	$lowerBoundj = 0;
	$upperBoundj = $columns-1;

	$remainingMatrixRows = $rows;
	$remainingMatrixCols = $columns;

	$array = [];

	// popuni polje 0
	for($i = 0; $i<$rows; $i++){
		array_push($array, []);  //array push dodaje novi elemnt na kraj polja
		for($j = 0; $j<$columns; $j++){
			$array[$i][$j]=0;
		}
	}


	while($remainingMatrixCols>1 && $remainingMatrixRows>1)
	{
		// popuni dole
		for($j=$upperBoundj; $j>=$lowerBoundj; $j--){

			$array[$upperBoundi][$j] = $fill;
			$fill++;
		}

		// popuni ljevu
		for($i=$upperBoundi-1; $i>=$lowerBoundi; $i--){
			

			$array[$i][$lowerBoundj] = $fill;
			$fill++;
		}

		// popuni gore
		for($j=$lowerBoundj+1; $j<=$upperBoundj; $j++){
			

			$array[$lowerBoundi][$j] = $fill;
			$fill++;
		}

		// popuni desno
		for($i = $lowerBoundi+1; $i<=$upperBoundi - 1; $i++){

			$array[$i][$upperBoundj] = $fill;
			$fill++;
		}

		$upperBoundi--;
		$lowerBoundi++;
		$upperBoundj--;
		$lowerBoundj++;

		$remainingMatrixRows-=2;
		$remainingMatrixCols-=2;
	}

	// ako 1 x m 
	if($remainingMatrixRows==1){
		for($j = $upperBoundj; $j>=$lowerBoundj; $j--)
		{
			$array[$lowerBoundi][$j] = $fill;
			$fill++;
		}
	}
	// ako n x 1
	else if($remainingMatrixCols==1){
		for($i = $upperBoundi; $i>=$lowerBoundi; $i--)
		{
			$array[$i][$upperBoundj] = $fill;
			$fill++;
		}
	}

	echo '<table style="width:100%;">';

	for($i=0; $i<$rows; $i++){
		echo "<tr>";
		for($j=0; $j<$columns; $j++){
			echo "<td>";
			echo $array[$i][$j];
			echo "</td>";
		}
		echo '</tr>';
	}

	echo "</table>";
}
?>