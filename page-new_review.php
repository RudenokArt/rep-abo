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
	<div v-if="outscraperResponse && !outscraperPreloader">
		{{outscraperResponse}}
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
			};
		},

		watch: {
			searchProcess: function () {
				if (this.searchProcess) {
					this.mapTextSearch();
				}
			}
		},

		methods: {

			requestOutscraper: async function (e) {
				this.outscraperPreloader = true;
				console.log(this.ajaxUrl);
				var jsonStr = await $.post(this.ajaxUrl, $(e.target).serialize(), function () {});
				this.outscraperResponse = JSON.parse(jsonStr);
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