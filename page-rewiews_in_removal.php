<?php include_once 'kundenportal/init.php';



$ReviewsInRemovalEx = new ReviewsInRemoval();

?>


<div class="container pt-5 pb-5">
	<?php foreach ($ReviewsInRemovalEx->dealsList as $key => $value): ?>
		<a href="greviews_detail/?id=<?php echo '';?>" class="row border-bottom pt-1 pb-1 justify-content-center text-decoration-none detail-page-link">
			<div class="col-lg-6 col-md-6 col-sm-12">
				<?php echo $value['TITLE']; ?>
			</div>
			<div class="col-lg-3 col-md-6 col-sm-12">
				<div class="container">
					<div class="row">
						<?php $dealStageFlag = true; ?>
						<?php if ($value['STAGE_ID'] == 'LOSE' or $value['STAGE_ID'] == 'APOLOGY') {
							$dealStageColor = 'bg-danger';
						} elseif ($value['STAGE_ID'] == 'WON') {
							$dealStageColor = 'bg-success';
						} else {
							$dealStageColor = 'bg-info';
						}?>
						<?php foreach ($ReviewsInRemovalEx->stageList as $key1 => $value1): ?>
							<?php if ($dealStageFlag): ?>
								<div class="col-1 p-1 border <?php echo $dealStageColor ?>"></div>
							<?php endif ?>
							<?php if ($value['STAGE_ID'] == $value1['STATUS_ID']): ?>
								<?php $dealStageFlag = false; ?>
								<?php $dealStageName = $value1['NAME'] ?>
							<?php endif ?>

						<?php endforeach ?>
					</div>
				</div>
				<?php echo $dealStageName; ?>
			</div>
			<div class="col-lg-3 col-md-6 col-sm-12">
				<?php echo explode('T', $value['DATE_CREATE'])[0]; ?>
				<br>
				<?php echo explode('T', $value['DATE_CREATE'])[1]; ?>
			</div>
			
		</a>
	<?php endforeach ?>
</div>

<pre><?php print_r($ReviewsInRemovalEx); ?></pre>

<?php 

/**
 * 
 */
class ReviewsInRemoval {
	
	function __construct() {

		global $B24_CONTACT;

		$greviewsEntity = new B24_Greviews();

		$this->relationsList = json_decode(
			$greviewsEntity->relationsList($B24_CONTACT->data["ID"]),
			true
		)['result'];
		$this->greviewsIdArr = $this->greviewsIdArrCreate();

		$this->dealsList = json_decode(
			$greviewsEntity->dealsList($this->greviewsIdArr),
			true
		)['result'];

		$this->stageList = json_decode(
			$greviewsEntity->stageList(),
			true
		)['result'];

	}

	function greviewsIdArrCreate () {
		foreach ($this->relationsList as $key => $value) {
			$arr[] = $value['greviews_id'];
		}
		return $arr;
	}

}

?>


<?php include_once 'kundenportal/layout/footer.php'; ?>