<?php include_once 'kundenportal/init.php';?>

<div class="alert alert-info text-center">
	<div class="h2">
		Willkommen zurück 
		<?php echo $B24_CONTACT->data['NAME']; ?>
		<?php echo $B24_CONTACT->data['SECOND_NAME']; ?>
		<?php echo $B24_CONTACT->data['LAST_NAME']; ?> !
	</div>

	<?php if (sizeof($wellcomeCheck)): ?>
		<p>Herzlichen Glückwunsch, Sie haben bereits Ihren Anspruch auf die Bewertungen dieses Monats geltend gemacht.</p>
	<?php else: ?>
		<p>
			Sie haben Ihren Anspruch auf die Bewertungen dieses Monats noch nicht geltend gemacht.
			<a href="/kundenportal/new_review/">
				Klicken Sie hier, um direkt dorthin zu gelangen
			</a>
		</p>
	<?php endif ?>

</div>

<?php include_once 'kundenportal/layout/footer.php'; ?>