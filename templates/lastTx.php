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
	<h1><hr>Ultima Actividad</h1>
		<table class="table">
			<tr>
				<th>Address</th>
				<td><a href="wallets.dm?address=<?php echo $walletInfo->address; ?>&coin=<?php echo $walletInfo->coin_id; ?>"><?php echo $walletInfo->address; ?></a></td>
				<th>Name</th>
				<td><?php echo $walletInfo->name; ?></td>
			</tr>
			<tr>
				<th>Symbol</th>
				<td><?php echo $walletInfo->symbol; ?></td>
				<th>Decimals</th>
				<td><?php echo $walletInfo->decimals; ?></td>
			</tr>
			<tr>
				<th><h3>Balance: </h3></th>	
				<td><?php echo $walletInfo->balance; ?></td>
				<th><h3>Balance Real: </h3></th>	
				<td><?php echo convertInFloat($walletInfo->balance, $walletInfo->decimals); ?> <?php echo $walletInfo->symbol; ?></td>
			</tr>
		</table>
	<div class="row">
	  <div class="col-md-12">
		<?php 
			$listTx = lastTx($walletInfo->address, $walletInfo->coin_id, 25);
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
				<td title="<?php echo $txItem->tx; ?>"><a href="tx.dm?tx=<?php echo $txItem->tx; ?>"><?php echo $txItem->tx; ?></a></td>
				<td title="<?php echo $txItem->from; ?>"><a href="wallets.dm?address=<?php echo $txItem->from; ?>&coin=<?php echo $txItem->coinInfo->id; ?>"><?php echo $txItem->from; ?></a></td>
				<td title="<?php echo $txItem->to; ?>"><a href="wallets.dm?address=<?php echo $txItem->to; ?>&coin=<?php echo $txItem->coinInfo->id; ?>"><?php echo $txItem->to; ?></a></td>
				<td><?php echo convertInFloat($txItem->value, $demo->wallets->DM->decimals); ?></td>
				<td><?php echo $demo->wallets->DM->symbol; ?></td>
			</tr>
			<?php } ?>
		</table>
	  </div>
	</div>
</div>