<?php
	if(isset($_GET['tx'])){
		$txInfo = TransferForTx($_GET['tx']);
	}else{
		echo '<meta http-equiv="refresh" content="0; url=home.dm">';
		exit();
	}
?>
<div class="content_middle">
	<div class="container">
		<div class="row">
			<hr>
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<h2>Transaccion: <span><?php echo $txInfo->coinInfo->name; ?> (<?php echo $txInfo->coinInfo->symbol; ?>)</span></h2>
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
						<td><textarea readonly="" spellcheck="false" style="width: 100%; font-size: small; font-family: Monospace; padding: 8px; background-color: #EEEEEE;" rows="5" id="inputdata"><?php echo $txInfo->data; ?></textarea></td>
					</tr>
				</table>
			
<a href="#decodetab" id="ContentPlaceHolder1_btnDecodetab" data-toggle="tab" class="btn-u btn-u-default btn-u-xs decodetab" style="padding: 0px 4px 0px 4px; top: -4px;" type="button" onclick="javascript:decodeInput();" aria-expanded="true">Decode Input Data <i class="fa fa-cog"></i></a>
			</div>
			<div class="col-md-2"></div>
		</div>
	</div>
</div>