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
<div class="content_middle">
	<div class="container">
		<div class="row">
			<hr>
			<div class="col-md-1"></div>
			<div class="col-md-10">
				<h2>Wallet: <span><?php echo $walletInfo->address; ?> (<?php echo $walletInfo->symbol; ?>)</span></h2>
				<table class="table table-responsive">
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
			<div class="col-md-1"></div>
		</div>
	</div>
</div>