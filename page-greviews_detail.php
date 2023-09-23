<?php include_once 'kundenportal/init.php';
$greviewsDetail = json_decode(
	(new B24_Greviews())->taskGet($_GET['id']), true
)['result']['RESULT']['data'][0];
?>

<div class="card pb-5">
	<div class="card-header">
		<div class="row">
			<div class="col-lg-3 col-md-4 col-sm-12 text-center">
				<img src="<?php echo $greviewsDetail['logo'];?>" width="50" alt="">
			</div>
			<div class="col-lg-9 col-md-8 col-sm-12">
				<div><?php echo $greviewsDetail['name'];?></div>
				<div>
					<?php echo $greviewsDetail['country'];?>
					(<?php echo $greviewsDetail['country_code'];?>)
					<?php echo $greviewsDetail['city'];?>
				</div>
				<div>
					<?php echo $greviewsDetail['borough'];?>
					<?php echo $greviewsDetail['street'];?>					
				</div>
				<div>
					<a href="<?php echo $greviewsDetail['site'];?>">
						<?php echo $greviewsDetail['site'];?>
					</a>
				</div>
				<div><?php echo $greviewsDetail['phone'];?></div>
				<div><?php echo $greviewsDetail['full_address'];?></div>
			</div>
		</div>
	</div>
	<div class="card-body">
		<?php foreach ($greviewsDetail['reviews_data'] as $key => $value): ?>
			<div class="row border-bottom pt-2 pb-2">
				<div class="col-lg-3 col-md-4 col-sm-12">
					<img src="<?php echo $value['author_image'];?>" width="100" alt="">
				</div>
				<div class="col-lg-9 col-md-8 col-sm-12">
					<div><?php echo $value['author_title'];?></div>
					<div>
						<span class="text-warning">
							<?php for ($i=1; $i <= 5; $i++): ?>
								<?php if ($i <= $value['review_rating']): ?>
									<i class="fa fa-star" aria-hidden="true"></i>
								<?php else: ?>
									<i class="fa fa-star-o" aria-hidden="true"></i>
								<?php endif ?>
							<?php endfor; ?>
						</span>					
						(<?php echo $value['review_rating'];?>)
					</div>
					
				</div>
				<div class="col-12">
					<div><?php echo $value['review_text'];?></div>
				</div>
			</div>
		<?php endforeach ?>
		
	</div>
</div>

<?php include_once 'kundenportal/layout/footer.php'; ?>