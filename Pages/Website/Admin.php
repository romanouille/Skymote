<?php
require "Pages/Website/Layout/Start.php";
?>
<div class="container page">
	<ul class="breadcrumbs">
		<li class="page-item"><a href="#" class="page-link">Skymote</a>
		<li class="page-item"><a href="#" class="page-link">Admin</a>
	</ul>
	
	<h1>Admin</h1>
	<a href="/account/admin/servers/expirations" title="Serveurs proches de l'expiration" class="button primary">Serveurs proches de l'expiration</a>&nbsp;
	<a href="/account/admin/requisition" title="Réquisition judiciaire" class="button primary">Réquisition judiciaire</a>&nbsp;
	<a href="/account/admin/invoices" title="Factures" class="button primary">Factures</a>
</div>
<?php
require "Pages/Website/Layout/End.php";