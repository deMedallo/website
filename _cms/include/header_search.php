<?php
if(isset($_GET['q'])){ $q = $_GET['q']; }else{ $q = 'musica, series, peliculas...'; };
?>
<div class="banner">
  <div class="container_wrap">
	<?php //$app->runWithRoute('index'); ?>
	<h1>¿Que Buscas?</h1>
	
	<form class="" method="get" id="download" action="search.dm">
		<input type="text"  name="q" id="q" value="<?php echo $q; ?>" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '<?php echo $q; ?>';}">
		<div class="contact_btn">
		   <label class="btn1 btn-2 btn-2g"><input class="btn btn-default btn-lg" type="submit" name="type" id="type" value="Buscar"></label>
		</div>
	</form>        		
	<div class="clearfix"></div>
  </div>
</div>
	<!--
<div class="content_top">
  <div class="container">
	<div class="col-md-4 bottom_nav">
	   <div class="content_menu">
			<ul>
				<li class="active"><a href="#">Recommended</a></li> 
				<li><a href="#">Latest</a></li> 
				<li><a href="#">Highlights</a></li> 
			</ul>
		</div>
	</div>
	<div class="col-md-4 content_dropdown1">
	   <div class="content_dropdown">    
		  
					<select>
						<option selected="dropdown" tabindex="9" style="display:none;color:#eee;">Dubai</option>
						<option>Australia</option>
						<option>Sri Lanka</option>
						<option>Newzeland</option>
						<option>Pakistan</option>
						<option>United Kingdom</option>
						<option>United states</option>
						<option>Russia</option>
						<option>Mirum</option>		
				  </select>
		  
		 </div>
		 <div class="content_dropdown">    
		  <select>
					<option selected="dropdown" tabindex="9" style="display:none;color:#eee;">Show Map</option>	
					<option>tempor</option>
					<option>congue</option>
					<option>mazim </option>
					<option>mutationem</option>
					<option>hendrerit </option>
					<option></option>
					<option></option>
			</select>
		   </div>
	</div>
	<div class="col-md-4 filter_grid">
		<ul class="filter">
			<li class="fil">Filter :</li>
			<li><a href=""> <i class="icon1"> </i> </a></li>
			<li><a href=""> <i class="icon2"> </i> </a></li>
			<li><a href=""> <i class="icon3"> </i> </a></li>
			<li><a href=""> <i class="icon4"> </i> </a></li>
			<li><a href=""> <i class="icon5"> </i> </a></li>
		</ul>
	</div>
</div>
</div> -->