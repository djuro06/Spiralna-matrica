<form method="POST">
<span>Broj redaka:</span>
<input type="number" name="redovi" />
<span>Broj stupaca:</span>
<input type="number" name="stupci" />
<input type="submit" value="Ispiši">
</form>

<?php
//----------------------------------------------------------------------------
if(isset($_POST["redovi"]) && isset($_POST["stupci"]))
{
	$redovi = $_POST["redovi"];
	$stupci = $_POST["stupci"];
	if($redovi > 500 or $stupci > 500)
	{
		echo "Preveliki brojevi - nedovoljno memorije!";
	}
	else
	{
		$ispuna = 1;
		$donjagranicai = 0;
		$gornjagranicai = $redovi-1;
		$donjagranicaj = 0;
		$gornjagranicaj = $stupci-1;
		$preostaliRedoviMatrice = $redovi;
		$preostaliStupciMatrice = $stupci;
		$polje = [];
		// popuni polje 0
		for($i = 0; $i<$redovi; $i++){
			array_push($polje, []);  //polje push dodaje novi elemnt na kraj polja
			for($j = 0; $j<$stupci; $j++){
				$polje[$i][$j]=0;
			}
		}
		for($f=0; $f>-1; $f++)
		{
			if($preostaliStupciMatrice<=1 or $preostaliRedoviMatrice<=1)
			{
				break;
			}
		//while($preostaliStupciMatrice>1 && $preostaliRedoviMatrice>1)
		
			// popuni dole
			for($j=$gornjagranicaj; $j>=$donjagranicaj; $j--){
				$polje[$gornjagranicai][$j] = $ispuna;
				$ispuna++;
			}
			// popuni ljevu
			for($i=$gornjagranicai-1; $i>=$donjagranicai; $i--){
				
				$polje[$i][$donjagranicaj] = $ispuna;
				$ispuna++;
			}
			// popuni gore
			for($j=$donjagranicaj+1; $j<=$gornjagranicaj; $j++){
				
				$polje[$donjagranicai][$j] = $ispuna;
				$ispuna++;
			}
			// popuni desno
			for($i = $donjagranicai+1; $i<=$gornjagranicai - 1; $i++){
				$polje[$i][$gornjagranicaj] = $ispuna;
				$ispuna++;
			}
			$gornjagranicai--;
			$donjagranicai++;
			$gornjagranicaj--;
			$donjagranicaj++;
			$preostaliRedoviMatrice-=2;
			$preostaliStupciMatrice-=2;
			
		}
		// ako 1 x m - broj stupaca
		if($preostaliRedoviMatrice==1){
			for($j = $gornjagranicaj; $j>=$donjagranicaj; $j--)
			{
				$polje[$donjagranicai][$j] = $ispuna;
				$ispuna++;
			}
		}
		// ako n - broj redaka x 1
		else if($preostaliStupciMatrice==1){
			for($i = $gornjagranicai; $i>=$donjagranicai; $i--)
			{
				$polje[$i][$gornjagranicaj] = $ispuna;
				$ispuna++;
			}
		}
		echo '<table style="width:100%;">';
		for($i=0; $i<$redovi; $i++){
			echo "<tr>";
			for($j=0; $j<$stupci; $j++){
				echo "<td>";
				echo $polje[$i][$j];
				echo "</td>";
			}
			echo '</tr>';
		}
		echo "</table>";
	}
}
?>