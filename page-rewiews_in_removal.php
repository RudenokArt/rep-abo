<?php include_once 'kundenportal/init.php';
$greviewsList = new B24_Greviews();
$greviewsRelationsList = json_decode(
	$greviewsList->relationsList($B24_CONTACT->data["ID"]), true
)['result'];
?>

<div class="container pt-5 pb-5">
	<?php foreach ($greviewsRelationsList as $key => $value): ?>
		<?php $itemArrDate = getdate($value['DATE']); ?>
	<a href="greviews_detail/?id=<?php echo $value['greviews_id'] ?>" class="row border-bottom pt-1 pb-1 justify-content-center text-decoration-none detail-page-link">
		<div class="col-lg-3 col-md-3 col-sm-4">
			ID: <?php echo $value['ID']; ?>
		</div>
		<div class="col-lg-3 col-md-3 col-sm-4">
			<?php echo getdate($value['DATE'])['month']; ?>
		</div>
		<div class="col-lg-3 col-md-3 col-sm-4">
			<?php echo date('Y-m-d H:i:s', $value['DATE']); ?>
		</div>
	</a>
<?php endforeach ?>
</div>


<?php include_once 'kundenportal/layout/footer.php'; ?>