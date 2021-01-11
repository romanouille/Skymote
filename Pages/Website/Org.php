<?php
require "Pages/Website/Layout/Start.php";
?>
<div class="container page">
	<ul class="breadcrumbs">
		<li class="page-item"><a href="#" class="page-link">Skymote</a>
		<li class="page-item"><a href="#" class="page-link">Organisation "<?=$match[0]?>"</a>
	</ul>
	
	<h1>Organisation <b><?=$match[0]?></b></h1>
	
	<table class="table striped">
		<tbody>
			<tr>
				<td>Nom
				<td><?=htmlspecialchars($data["name"])?>
				
			<tr>
				<td>LIR
				<td><?=$data["is_lir"] ? "<span class=\"mif-checkmark\"></span>" : "<span class=\"mif-cross\"></span>"?>
				
			<tr>
				<td>Création
				<td><?=date("d/m/Y H:i:s", $data["created"])?>
				
			<tr>
				<td>Dernière modification
				<td><?=date("d/m/Y H:i:s", $data["modified"])?>
		</tbody>
	</table>
</div>
<?php
require "Pages/Website/Layout/End.php";