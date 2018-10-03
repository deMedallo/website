<?php
	if(isset($_GET['coin'])){
		$walletsInfo = loadWalletsCoin($_GET['coin']);
		if(count($walletsInfo) <= 0){
			echo 'Moneda no encontrada, te vamos a redirigir a otra pagina...';
			echo '<meta http-equiv="refresh" content="2; url=home.dm">';
			exit();
		}
	}else{
		echo '<meta http-equiv="refresh" content="0; url=home.dm">';
		exit();
	}
	
?>
<div class="container marketing">
	<h1><hr>Participantes : <?php echo $walletsInfo[0]->name; ?> (<?php echo $walletsInfo[0]->symbol; ?>)</h1>
	<hr>
	
	<table class="table">
		<tr>
			<th>Name</th>
			<td><?php echo $walletsInfo[0]->name; ?></td>
		</tr>
		<tr>
			<th>Symbol</th>
			<td><?php echo $walletsInfo[0]->symbol; ?></td>
		</tr>
		<tr>
			<th>Decimals</th>
			<td><?php echo $walletsInfo[0]->decimals; ?></td>
		</tr>
	</table>
	
	<div class="row">
	  <div class="col-md-12">
		<table class="table" style="zoom: 0.7;">
			<tr>
				<th>Address</th>
				<th>Balance</th>
			<tr>
			<?php foreach($walletsInfo As $txItem){ ?>
			<tr>
				<td title="<?php echo $txItem->address; ?>"><a href="wallets.dm?address=<?php echo $txItem->address; ?>&coin=<?php echo $txItem->coin_id; ?>"><?php echo $txItem->address; ?></a></td>
				<td title="<?php echo $txItem->balance; ?>"><?php echo convertInFloat($txItem->balance, $txItem->decimals); ?></td>
			</tr>
			<?php } ?>
		</table>
	  </div>
	</div>
	
	<hr>
</div>