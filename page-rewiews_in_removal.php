<?php include_once 'kundenportal/init.php';



$ReviewsInRemovalEx = new ReviewsInRemoval();

?>


<div class="container pb-5">
	<hr>
	<form action="" method="get" class="row">
		<div class="col-lg-6 col-md-12 col-sm-12">
			<select name="STAGE_ID" class="form-select">
				<option value="">Alle</option>
				<?php foreach ($ReviewsInRemovalEx->stageList as $key => $value): ?>
					<option <?php if ($_GET['STAGE_ID'] == $value['STATUS_ID']): ?>
					selected
					<?php endif ?> value="<?php echo $value['STATUS_ID'];?>">
					<?php echo $value['NAME'];?>
				</option>
			<?php endforeach ?>
		</select>
	</div>
	<div class="col-lg-4 col-md-6 col-sm-12 pt-2 text-center" id="sortingByDate">
		Nach Datum: 
		<label class="text-secondary">
			<input <?php if ($_GET['ORDER_DATE'] == 'DESC'): ?>
			checked
			<?php endif ?> type="radio" name="ORDER_DATE" value="DESC">
			<i class="fa fa-sort-amount-desc" aria-hidden="true"></i>
		</label>
		<label class="text-secondary">
			<input <?php if ($_GET['ORDER_DATE'] == 'ASC'): ?>
			checked
			<?php endif ?> type="radio" name="ORDER_DATE" value="ASC">
			<i class="fa fa-sort-amount-asc" aria-hidden="true"></i>
		</label>
	</div>

	<div class="col-lg-2 col-md-6 col-sm-12 text-center pt-1">
		<button class="btn btn-info" name="test" value="Y">
			<i class="fa fa-check" aria-hidden="true"></i>
		</button>
		<a href="?" class="btn btn-warning">
			<i class="fa fa-times" aria-hidden="true"></i>
		</a>
	</div>

	<?php if (!isset($_GET['pageN'])): ?>
		<?php $_GET['pageN'] == 0; ?>
	<?php endif ?>

	<?php if ($ReviewsInRemovalEx->dealsPagination['pagesQty'] > 1): ?>
		<div class="col-12 pt-1 pb-1 text-center">
			Seiten:
			<?php for ($i=0; $i < $ReviewsInRemovalEx->dealsPagination['pagesQty']; $i++):?>
				<button class="btn btn-sm <?php if ($_GET['pageN'] == $i): ?>
				btn-outline-danger
			<?php else: ?>
				btn-outline-info
				<?php endif ?>" name="pageN" value="<?php echo $i;?>">
				<?php echo $i+1; ?>
			</button>
		<?php endfor; ?>
	</div>
<?php endif ?>
</form>		

<hr>
<?php foreach ($ReviewsInRemovalEx->dealsList as $key => $value): ?>
	<a href="greviews_detail/?id=<?php echo $value['UF_DEAL_GREVIEWS_FIELD'];?>" class="row border-bottom pt-1 pb-1 justify-content-center text-decoration-none detail-page-link">
		<div class="col-lg-5 col-md-12 col-sm-12">
			<?php echo $value['TITLE']; ?>
		</div>
		<div class="col-lg-5 col-md-8 col-sm-12">
			<?php echo $dealStageName; ?>
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
		<div class="col-lg-2 col-md-4 col-sm-12">
			<?php echo explode('T', $value['DATE_CREATE'])[0]; ?>
		</div>

	</a>
<?php endforeach ?>
</div>

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

		$this->dealsEntity = json_decode(
			$greviewsEntity->dealsList(
				$this->setDealsFilter(),
				$this->setDealsOrder(),
				$_GET['pageN']
			),
			true
		);

		$this->dealsPagination = $this->dealsPaginationCreate();

		$this->dealsList = $this->dealsEntity['result'];

		$this->stageList = json_decode(
			$greviewsEntity->stageList(),
			true
		)['result'];

	}

	function dealsPaginationCreate () {
		return [
			'pagesQty' => ceil($this->dealsEntity['total'] / 50),
		];
	}

	function setDealsOrder () {
		$order = ['ID'=> 'DESC'];
		if (isset($_GET['ORDER_DATE'])) {
			$order = ['DATE_CREATE' => $_GET['ORDER_DATE'],];
		}
		return $order;
	}

	function setDealsFilter () {
		$filter = [
			'%UF_DEAL_GREVIEWS_FIELD' => $this->greviewsIdArrCreate(),
		];
		if (isset($_GET['STAGE_ID']) and $_GET['STAGE_ID']) {
			$filter['STAGE_ID'] = $_GET['STAGE_ID'];
		}
		return $filter;
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