<?php include_once 'kundenportal/init.php';?>

<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>

<div id="google_search-instance" class="pb-5">

	<div class="input-group mb-3">
		<input type="text" class="form-control" v-model="text" v-on:input="startSearching" placeholder="Geben Sie eine Abfrage ein">
		<span class="input-group-text" v-on:click="searchResset">
			<span v-if="!text"><i class="fa fa-search" aria-hidden="true"></i></span>
			<span v-if="text"><i class="fa fa-times" aria-hidden="true"></i></span>  	
		</span>
	</div>

	<div class="google_search-dropdown-wrapper">
		<div v-if="searchPreloader" class="google_search-dropdown bg-white shadow-lg">
			<p class="placeholder-glow p-2 border-bottom">
				<span class="placeholder col-5 bg-secondary placeholder-lg"></span>
				<span class="placeholder col-10 bg-secondary placeholder-lg"></span>
			</p>
			<p class="placeholder-glow p-2 border-bottom">
				<span class="placeholder col-5 bg-secondary placeholder-lg"></span>
				<span class="placeholder col-10 bg-secondary placeholder-lg"></span>
			</p>
			<p class="placeholder-glow p-2 border-bottom">
				<span class="placeholder col-5 bg-secondary placeholder-lg"></span>
				<span class="placeholder col-10 bg-secondary placeholder-lg"></span>
			</p>
			<p class="placeholder-glow p-2 border-bottom">
				<span class="placeholder col-5 bg-secondary placeholder-lg"></span>
				<span class="placeholder col-10 bg-secondary placeholder-lg"></span>
			</p>
		</div>	
		<div v-else="!searchPreloader && list" class="google_search-dropdown bg-white shadow-lg">
			<template v-for="(item, index) in list">
				<div v-on:click="setGoogleId(item, index)" class="p-2 border-bottom google_search-dropdown-item">
					<div>{{item.name}}</div>
					<div>{{item.address}}</div>
				</div>
			</template>
		</div>
	</div>

	<form class="pt-5" method="post" action="" v-if="googleId" v-on:submit.prevent="requestOutscraper">
		<input type="hidden" v-model="googleId" name="googleId">
		<input type="hidden" name="taskAdd" value="Y">
		<div class="row">
			<div class="col-lg-8 col-md-12 col-sm-12 pt-1">
				<input type="text" class="form-control" v-model="googleText" readonly>
			</div>
			<div class="col-lg-2 col-md-6 col-sm-6 pt-1"> 
				<button class="btn btn-lg btn-success w-100">
					<i class="fa fa-check" aria-hidden="true"></i>
				</button>
			</div>
			<div class="col-lg-2 col-md-6 col-sm-6 pt-1"> 
				<button class="btn btn-lg btn-danger w-100" type="button" v-on:click="outscrapetResset">
					<i class="fa fa-times" aria-hidden="true"></i>
				</button>
			</div>
		</div>
	</form>

	<div v-if="outscraperPreloader">
		<p>Bewertungen werden analysiert... <br>Das kann ein paar minuten dauern...</p>
		<?php for ($i=0; $i < 10; $i++): ?>
			<div class="row p-2 border-bottom">
				<div class="col-lg-4 col-md-4 col-sm-12">
					<p class="placeholder-glow h1">
						<span class="placeholder col-12 bg-secondary placeholder-lg p-0 m-0"></span>
						<span class="placeholder col-12 bg-secondary placeholder-lg p-0 m-0"></span>
					</p>
				</div>
				<div class="col-lg-8 col-md-8 col-sm-12">
					<p class="placeholder-glow">
						<span class="placeholder col-12 bg-secondary placeholder-lg"></span>
						<span class="placeholder col-10 bg-secondary placeholder-lg"></span>
						<span class="placeholder col-8 bg-secondary placeholder-lg"></span>
						<span class="placeholder col-8 bg-secondary placeholder-lg"></span>
					</p>
				</div>
			</div>
		<?php endfor; ?>
	</div>

	<div v-if="outscraperResponse && !outscraperPreloader">
		<div class="pt-5">
			<div class="card">
				<div class="card-header">
					<div class="row">
						<div class="col-lg-3 col-md-4 col-sm-12 text-center">
							<img v-bind:src="outscraperData.logo" width="50" alt="">
						</div>
						<div class="col-lg-9 col-md-8 col-sm-12">
							<div>
								<a v-bind:href="outscraperData.site" target="_blank" class="text-decoration-none">
									<b>{{outscraperData.name}}</b>
									{{outscraperData.country}}
									{{outscraperData.city}}
								</a>	
							</div>
							<div>{{outscraperData.street}}</div>
							<div>{{outscraperData.phone}}</div>
							<div>{{outscraperData.site}}</div>
							<div>{{outscraperData.full_address}}</div>
						</div>

					</div>
					<!-- <div>{{outscraperData.query}}</div> -->
				</div>
				<div class="card-body">

					<div class="alert alert-secondary">
						<i class="fa fa-filter" aria-hidden="true"></i>
						Filter: 
						<span class="text-warning">
							<label class="form-check-label m-1 p-1 border">
								<input type="radio" class="form-check-input" v-model="starsFilter" name="starsFilter" v-bind:value="false">
								<span class="text-body">All</span>
							</label>
							<label class="form-check-label m-1 p-1 border">
								<input type="radio" class="form-check-input" v-model="starsFilter" name="starsFilter"  v-bind:value="1">
								<i class="fa fa-star" aria-hidden="true"></i>
							</label>
							<label class="form-check-label m-1 p-1 border">
								<input type="radio" class="form-check-input" v-model="starsFilter" name="starsFilter"  v-bind:value="2">
								<i class="fa fa-star" aria-hidden="true"></i>
								<i class="fa fa-star" aria-hidden="true"></i>
							</label>
							<label class="form-check-label m-1 p-1 border">
								<input type="radio" class="form-check-input" v-model="starsFilter" name="starsFilter"  v-bind:value="3">
								<i class="fa fa-star" aria-hidden="true"></i>
								<i class="fa fa-star" aria-hidden="true"></i>
								<i class="fa fa-star" aria-hidden="true"></i>
							</label>
						</span>
					</div>

					<template v-for="item, index in outscraperData.reviews_data">
						<div class="row pt-3" v-if="starFilterSet(item.review_rating)">
							<div class="col-lg-3 col-md-4 col-sm-4 text-center">
								<img v-bind:src="item.author_image" alt="" width="100"><br>
							</div>
							<div class="col-lg-6 col-md-8 col-sm-8">
								<!-- {{item.review_id}}<br> -->
								{{item.author_title}}<br>
								<span v-for="num in 5" class="text-warning">
									<template v-if="num <= item.review_rating">
										<i class="fa fa-star" aria-hidden="true"></i>
									</template>
									<template v-else="num > item.review_rating">
										<i class="fa fa-star-o" aria-hidden="true"></i>
									</template>
								</span>
								<span v-if="item.review_rating">
									({{item.review_rating}})
								</span>
								<br>
								<a v-bind:href="item.review_link" target="_blank">In der Quelle</a><br>
							</div>

							<div class="col-lg-3 col-md-12 col-sm-12">
								<div class="form-check">
									<label class="form-check-label">
										<input class="form-check-input" type="checkbox" v-bind:value="item.review_id" name="need" v-on:change="needAndReasonsSet">
										Zum Löschen senden
									</label>
								</div>
								<div class="pt-2" v-if="need.includes(item.review_id)">
									<select class="form-select" name="reasons" v-on:change="needAndReasonsSet">
										<option value="-" selected>Select reason</option>
										<option value="No text">No text</option>
										<option value="Fake name">Fake name</option>
										<option value="Bullshit">Bullshit</option>
										<option value="Spam">Spam</option>
										<option value="Offense">Offense</option>
										<option value="Unacceptable content">Unacceptable content</option>
										<option value="Advertisement">Advertisement</option>
										<option value="Other">Other</option>
									</select>
								</div>
							</div>
							<div class="col-12 border-bottom pb-3">
								{{item.review_text}}<br>
							</div>
						</div>
					</template>


					<div class="text-center pt-5 pb-5">
						<div class="pb-2">
							<input type="text" class="form-control" v-model="userName">
						</div>
						<div class="pb-2">
							<input type="text" class="form-control" v-model="userPhone">
						</div>
						<div class="pb-3">
							<input type="text" class="form-control" v-model="userEmail">
						</div>
						<button class="w-75 btn-lg btn-primary" v-on:click="taskAddFromSite">Send</button>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div v-if="need.length > 0" class="remaing_rewiews bg-light text-center text-danger p-1">
		Verbleibende Bewertungen zur Auswahl: {{need.length}}
	</div>


</div>


<script>

	const {createApp} = Vue;
	createApp({

		data () {
			return {
				ajaxUrl: "<?php echo $theme_url;?>/kundenportal/core/ajax.php",
				searchProcess: false,
				searchPreloader: false,
				text: '',
				list: {},
				googleId: false,
				googleText: '',
				outscraperResponse: false,
				outscraperPreloader: false,
				outscraperData: false,
				need: [],
				reasons: [],
				userName: '<?php echo $B24_CONTACT->data["NAME"]." ".$B24_CONTACT->data["SECOND_NAME"]." ".$B24_CONTACT->data["LAST_NAME"];?>',
				userPhone: '<?php echo $B24_CONTACT->data["PHONE"][0]["VALUE"];?>',
				userEmail: '<?php echo $B24_CONTACT->data["EMAIL"][0]["VALUE"];?>',
				counter: 10,
				starsFilter: false,
			};
		},


		watch: {
			searchProcess: function () {
				if (this.searchProcess) {
					this.mapTextSearch();
				}
			},
		},

		methods: {

			starFilterSet: function (rating) {
				if (this.starsFilter) {
					return rating == this.starsFilter;
				} else {
					return rating <= 3;
				}
			},

			taskAddFromSite: async function () {
				$('#preloader-main').css({'display': 'flex'});
				this.reviewsDataSet();
				var postData = {
					taskAddFromSite: 'Y',
					need: JSON.stringify(this.need),
					reasons: JSON.stringify(this.reasons),
					price: 0, 
					amount: 0,
					uName: this.userName,
					uPhone: this.userPhone,
					uEmail: this.userEmail,
					company: this.outscraperData,
				};
				var response = await $.post(this.ajaxUrl, postData);
				var rel = await this.relationsAdd(response , '<?php echo $B24_CONTACT->data["ID"];?>');
				$('#preloader-main').css({'display': 'none'});
				document.location.href = '/kundenportal/rewiews_in_removal/';
			},

			relationsAdd: async function (greviews, contact) {
				var postData = {
					relationsAdd: 'Y',
					greviews_id: greviews,
					contact_id: contact,
				};
				var response = await $.post(this.ajaxUrl, postData);
				return response;
			},

			counterCheck: function (checkbox) {
				var arr = $('input[name="need"]');
				var counter = 0;
				for (var i = 0; i < arr.length; i++) {
					if (arr[i].checked) {
						counter = counter + 1;
					}
				}
				if (counter > 10) {
					checkbox.checked = false;
					alert('Zur Entfernung stehen keine weiteren 10 Bewertungen zur Verfügung.');
				}
			},

			reviewsDataSet: function () {
				var arr = [];
				for (var i = 0; i < this.outscraperData.reviews_data.length; i++) {
					if (this.need.includes(this.outscraperData.reviews_data[i].review_id)) {
						arr.push(this.outscraperData.reviews_data[i]);
					}
				}
				this.outscraperData.reviews_data = arr;
			},

			needAndReasonsSet: function (e) {
				this.counterCheck(e.target);
				this.reasons = [];
				this.need = [];
				var arr1 = $('input[name="need"]');
				for (var i = 0; i < arr1.length; i++) {
					if (arr1[i].checked) {
						this.need.push(arr1[i].value);
					}
				}
				var instance = this;
				setTimeout(function () {
					var arr = $('select[name="reasons"]');
					for (var i = 0; i < arr.length; i++) {
						instance.reasons.push(arr[i].value);
					}
				}, 100);
			},

			requestOutscraper: async function (e) {
				this.outscraperPreloader = true;
				console.log(this.ajaxUrl);
				var jsonStr = await $.post(this.ajaxUrl, $(e.target).serialize(), function () {});
				this.outscraperResponse = JSON.parse(jsonStr);
				this.outscraperData = this.outscraperResponse.result.result[0];
				this.outscraperPreloader = false;
			},

			setGoogleId: function (item, index) {
				this.googleId = index;
				this.googleText = item.name + ' ' + item.address;
				this.text = '';
				this.list = {};
			},

			searchResset: function () {
				this.text = '';
				this.list = {};
			},

			outscrapetResset: function () {
				this.googleId=false;
				this.googleText='';
				this.outscraperResponse = false;
			},

			startSearching: function () {
				this.searchPreloader = true;
				this.searchProcess = false;
				var instance = this;
				setTimeout(function () {
					instance.searchProcess = true;
				}, 5000);
			},

			mapTextSearch: async function () {
				var response = await $.post(this.ajaxUrl, {
					init: 'google_search',
					text: this.text,
				});
				this.list = JSON.parse(response);
				this.searchPreloader = false;
			}

		},
	}).mount('#google_search-instance');
</script>

<?php include_once 'kundenportal/layout/footer.php'; ?>