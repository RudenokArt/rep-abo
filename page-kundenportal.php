<?php include_once 'kundenportal/init.php';?>
<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>

<div id="google_search-instance">
	<input type="text" class="form-control" v-model="text" v-on:input="startSearching">
	<div v-if="searchPreloader" class="border p-2 google_search-preloader">
		<p class="placeholder-glow">
			<span class="placeholder col-5 bg-secondary placeholder-lg"></span>
			<span class="placeholder col-10 bg-secondary placeholder-lg"></span>
			<hr>
			<span class="placeholder col-5 bg-secondary placeholder-lg"></span>
			<span class="placeholder col-10 bg-secondary placeholder-lg"></span>
			<hr>
			<span class="placeholder col-5 bg-secondary placeholder-lg"></span>
			<span class="placeholder col-10 bg-secondary placeholder-lg"></span>
			<hr>
			<span class="placeholder col-5 bg-secondary placeholder-lg"></span>
			<span class="placeholder col-10 bg-secondary placeholder-lg"></span>
		</p>
	</div>
	<div v-else="!searchPreloader && list" class="border p-2 google_search-preloader">
		<div v-for="(item, index) in list">
			<div>{{item.name}}</div>
			<div>{{item.address}}</div>
			<hr>
		</div>
	</div>
	

	<pre>{{searchProcess}}</pre>
	<pre>{{text}}</pre>
	
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