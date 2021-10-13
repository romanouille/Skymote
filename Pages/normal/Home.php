<?php
require "Pages/$version/Layout/Start.php";
?>
<h1>IP Geolocation</h1>
<p>Discover the country, the source block, the allocations, the Internet Service Provider...</p>
<form method="get" action="search">
	<input type="text" class="form-control" name="text" placeholder="IPv4/v6, ISP, ..." value="<?=$_SERVER["REMOTE_ADDR"]?>" required>
	<input type="submit" class="btn btn-white" value="Submit">
</form>
<?php
require "Pages/$version/Layout/End.php";