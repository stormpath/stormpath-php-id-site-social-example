<?php
	require __DIR__ . '/bootstrap.php';

	getHead();
	getNav($user);
?>

<div class="container">
	<div class="well">
		<h2>Stormpath Social Login Example (ID Site)</h2>
		<p>
			This example is meant to show you the steps to building social login with the PHP SDK
		</p>
	</div>
</div>

<?php getFooter(); ?>