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
					<td><?php echo $txInfo->tx; ?></td>
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
					<th>Decimals</th>
					<td><?php echo $txInfo->coinInfo->decimals; ?></td>
				</tr>
				<tr>
					<th>Value</th>
					<td><?php echo $txInfo->value; ?> <?php echo $txInfo->coinInfo->symbol; ?>E-<?php echo $txInfo->coinInfo->decimals; ?></td>
				</tr>
				<tr>
					<th>Value Real</th>
					<td><?php echo convertInFloat($txInfo->value, $txInfo->coinInfo->decimals); ?> <?php echo $txInfo->coinInfo->symbol; ?></td>
				</tr>
				<tr>
					<th>Input data</th>
					<td><textarea class="form-control" readonly="" spellcheck="false" style="width: 100%; font-size: small; font-family: Monospace; padding: 8px; background-color: #EEEEEE;" rows="5" id="inputdata"><?php echo $txInfo->data; ?></textarea></td>
				</tr>
				<tr>
					<th>Input data</th>
					<td><?php echo pack('H*', $txInfo->data); ?></td>
				</tr>
				<tr>
					<th></th>
					<td><a href="decodeTx.dm?tx=<?php echo $txInfo->tx; ?>" class="btn btn-info btn-md" >Decode Input Data <i class="fa fa-cog"></i></a></td>
				</tr>
			</table>
			
			
		</div>
	</div>
</div>