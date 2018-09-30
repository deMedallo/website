<?php
	if(isset($_GET['tx'])){
		$txInfo = TransferForTx($_GET['tx']);
	}else{
		echo '<meta http-equiv="refresh" content="0; url=home.dm">';
		exit();
	}
?>
<div class="container marketing">
	<h1><hr>Visor de Transaccion</h1>

	<hr>
	<div class="row">
		<hr>
		<div class="col-md-12">
			<h3>Transaccion: <span><?php echo $txInfo->coinInfo->name; ?> (<?php echo $txInfo->coinInfo->symbol; ?>)</span></h3>
			<table class="table table-responsive">
				<tr>
					<th>TxHash</th>
					<td><a href="tx.dm?tx=<?php echo $txInfo->tx; ?>"><?php echo $txInfo->tx; ?></a></td>
				</tr>
				<tr>
					<th>TimeStamp</th>
					<td><?php echo $txInfo->create; ?></td>
				</tr>
				<tr>
					<th>From</th>
					<td><a href="wallets.dm?address=<?php echo $txInfo->from; ?>&coin=<?php echo $txInfo->coinInfo->id; ?>"><?php echo $txInfo->from; ?></a></td>
				</tr>
				<tr>
					<th>To</th>
					<td><a href="wallets.dm?address=<?php echo $txInfo->to; ?>&coin=<?php echo $txInfo->coinInfo->id; ?>"><?php echo $txInfo->to; ?></a></td>
				</tr>
				<tr>
					<th>Input data</th>
					<td><textarea class="form-control" readonly="" spellcheck="false" style="min-height: 250px; width: 100%; font-size: small; font-family: Monospace; padding: 8px; background-color: #EEEEEE;" rows="5" id="inputdata"><?php echo pack('H*', $txInfo->data); ?></textarea></td>
				</tr>
			</table>
		</div>
	</div>
</div>