<?php 
	$demo = UserForId($_SESSION['id']);
	$Wallets = $demo->wallets;
?>
<!-- Icons -->
<script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
<script>
  feather.replace()
</script>

<!-- Graphs -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
<div class="content_middle">
	<div class="container">
		<div class="row">
			<h1 class="h2">
			<hr>Tablero<hr></h1>
			<?php foreach($Wallets As $W=>$item){
					$dt = new DateTime();
					$today = $dt->format('Y-m-d H:i:s');
					
					$old = strtotime('-1 month', strtotime($today));
					$old = date('Y-m-d H:i:s', $old);
					
					$chart = ChartTxWallet($item->address, $item->coin_id, $today, $old);
			?>
				<div class="col-md-12">
					<h3>Actividad (<?php echo $W; ?>) / <?php echo ($today). ' - ' . ($old); ?></h3>
					<table class="table">
						<tr>
							<th>Address: </th>
							<td>
								<a href="wallets.dm?address=<?php echo ($item->address); ?>&coin=<?php echo ($item->coin_id); ?>">
								<?php echo ($item->address); ?>
							</td>
							<th>Balance: </th><td><?php echo ($item->balance); ?></td>
						</tr>
						<tr>
							<th>Nombre: </th><td><?php echo ($item->name); ?></td>
							<th>Simbolo: </th><td><?php echo ($item->symbol); ?></td>
						</tr>
					</table>
						
					<!--<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
						<div class="btn-toolbar mb-2 mb-md-0">
						  <div class="btn-group mr-2">
							<button class="btn btn-sm btn-outline-secondary">Share</button>
							<button class="btn btn-sm btn-outline-secondary">Export</button>
						  </div>
						  <button class="btn btn-sm btn-outline-secondary dropdown-toggle">
							<span data-feather="calendar"></span>
							This week
						  </button>
						</div>
					</div>-->
					<h4><hr>Cantidad Tx <hr></h4>
					<?php
						$totalSend = totalSendWallet($item->address, $item->coin_id);
						$totalRecibe = totalRecibeWallet($item->address, $item->coin_id);
					?>
					<table class="table">
						<tr>
							<th></th>
							<th>Total Tx</th>
							<th>Valor Total</th>
						</tr>
						<tr>
							<th>Enviado</th>
							<td><?php echo $totalSend->total; ?></td>
							<td><?php echo convertInFloat($totalSend->value, $item->decimals); ?></td>
						</tr>
						<tr>
							<th>Recibido</th>
							<td><?php echo $totalRecibe->total; ?></td>
							<td><?php echo convertInFloat($totalRecibe->value, $item->decimals); ?></td>
						</tr>
						<tr>
							<th>Total</th>
							<td><?php echo $totalSend->total + $totalRecibe->total; ?></td>
							<td><?php echo convertInFloat($totalRecibe->value + $totalRecibe->value, $item->decimals); ?></td>
						</tr>
					</table>
					
					<canvas class="my-4" id="myChart-<?php echo $W; ?>" width="900" height="380"></canvas>
								
					<script>
					  var ctx = document.getElementById("myChart-<?php echo $W; ?>");
					  var myChart = new Chart(ctx, {
						type: 'line',
						data: {
						  labels: <?php echo json_encode($chart->labels); ?>,
						  datasets: [{
							data: <?php echo json_encode($chart->data); ?>,
							lineTension: 0,
							backgroundColor: 'transparent',
							borderColor: '#007bff',
							borderWidth: 4,
							pointBackgroundColor: '#007bff'
						  }]
						},
						options: {
						  scales: {
							yAxes: [{
							  ticks: {
								beginAtZero: false
							  }
							}]
						  },
						  legend: {
							display: false,
						  }
						}
					  });
					</script>
				</div>
				
				<!--
				<div class="col-md-12">
					<h2 id="">Acceso Rapido</h2>
					<table class="table table-striped table-sm">
					  <thead>
						<tr><th>Seleciona el dia en la lista para ir de manera rapida a las actividades de ese día.</th><tr>
					  </thead>
						  <tbody>
							<?php foreach($chart->labels as $lab){ ?>
								<tr><td><a href="#<?php echo $lab; ?>"><?php echo $lab; ?></a></td></tr>
							<?php } ?>
						  </tbody>
					  </table>
				</div>-->
				
				<div class="col-md-12">
					<?php /* foreach($chart->complete As $day=>$list){ ?>
						<h2 id="<?php echo $day; ?>"><?php echo $day; ?></h2>
						<div class="table-responsive">
						<table class="table table-striped table-sm">
						  <thead>
							<tr>
								<th>Tx</th>
								<th>From</th>
								<th>To</th>
								<th>Value</th>
								<th>Coin</th>
							<tr>
						  </thead>
						  <tbody>
							<?php foreach($list->data As $txItem){ ?>
								<tr id="<?php echo $txItem->tx; ?>">
									<td title="<?php echo $txItem->tx; ?>"><a href="tx.dm?tx=<?php echo $txItem->tx; ?>"><?php echo substr($txItem->tx, 0, 10) . '...'; ?></a></td>
									<td title="<?php echo $txItem->from; ?>"><a href="wallets.dm?address=<?php echo $txItem->from; ?>&coin=<?php echo $txItem->coinInfo->id; ?>"><?php echo substr($txItem->from, 0, 10) . '...'; ?></a></td>
									<td title="<?php echo $txItem->to; ?>"><a href="wallets.dm?address=<?php echo $txItem->to; ?>&coin=<?php echo $txItem->coinInfo->id; ?>"><?php echo substr($txItem->to, 0, 10) . '...'; ?></a></td>
									<td><?php echo convertInFloat($txItem->value, $demo->wallets->DM->decimals); ?></td>
									<td><?php echo $demo->wallets->DM->symbol; ?></td>
								</tr>
							<?php } ?>
						  </tbody>
						</table>
					<?php } */ ?>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
</div>

