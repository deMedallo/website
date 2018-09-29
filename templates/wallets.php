<?php
	$walletInfo = new BalanceWallet();
	if(isset($_GET['address']) && isset($_GET['coin'])){
		$walletInfo = loadWalletOne($_GET['address'], $_GET['coin']);
		if($walletInfo->coin_id == 0){
			echo 'Cuenta no encontrada, te vamos a redirigir a otra pagina...';
			echo '<meta http-equiv="refresh" content="2; url=home.dm">';
			exit();
		}
	}else{
		echo '<meta http-equiv="refresh" content="0; url=home.dm">';
		exit();
	}
	
?>
<div class="container marketing">
	<hr class="featurette-divider">
	<h1>Visor de Billetera</h1>
		<hr class="featurette-divider">
	<div class="row">
	  <div class="col-md-8">
		<h2><?php echo $walletInfo->address; ?> (<?php echo $walletInfo->symbol; ?>)</h2>
		<table class="table">
			<tr>
				<th>Address</th>
				<td><?php echo $walletInfo->address; ?></td>
			</tr>
			<tr>
				<th>Name</th>
				<td><?php echo $walletInfo->name; ?></td>
			</tr>
			<tr>
				<th>Symbol</th>
				<td><?php echo $walletInfo->symbol; ?></td>
			</tr>
			<tr>
				<th>Decimals</th>
				<td><?php echo $walletInfo->decimals; ?></td>
			</tr>
			<tr>
				<th>Balance</th>
				<td><?php echo $walletInfo->balance; ?> <?php echo $walletInfo->symbol; ?></td>
			</tr>
			<tr>
				<th>Balance Real</th>
				<td><?php echo convertInFloat($walletInfo->balance, $walletInfo->decimals); ?> <?php echo $walletInfo->symbol; ?></td>
			</tr>
		</table>
	  </div>
	  <div class="col-md-4">
		<?php 
			$listTx = lastTx($walletInfo->address, $walletInfo->coin_id);
		?>
		<h2>Ultimas Actividades</h2>
		<table class="table table-responsive" style="zoom: 0.7;">
			<tr>
				<th>Tx</th>
				<th>From</th>
				<th>To</th>
				<th>Value</th>
				<th>Coin</th>
			<tr>
			<?php foreach($listTx As $txItem){ ?>
			<tr>
				<td title="<?php echo $txItem->tx; ?>"><a href="tx.dm?tx=<?php echo $txItem->tx; ?>"><?php echo substr($txItem->tx, 0, 10) . '...'; ?></a></td>
				<td title="<?php echo $txItem->from; ?>"><a href="wallets.dm?address=<?php echo $txItem->from; ?>&coin=<?php echo $txItem->coinInfo->id; ?>"><?php echo substr($txItem->from, 0, 10) . '...'; ?></a></td>
				<td title="<?php echo $txItem->to; ?>"><a href="wallets.dm?address=<?php echo $txItem->to; ?>&coin=<?php echo $txItem->coinInfo->id; ?>"><?php echo substr($txItem->to, 0, 10) . '...'; ?></a></td>
				<td><?php echo convertInFloat($txItem->value, $demo->wallets->DM->decimals); ?></td>
				<td><?php echo $demo->wallets->DM->symbol; ?></td>
			</tr>
			<?php } ?>
			
		</table>
	  </div>
	</div>
</div>