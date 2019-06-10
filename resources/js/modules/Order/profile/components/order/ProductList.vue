<template>
	<div>
		{{user}}



	</div>
</template>

<script>

	import {mapState} from "vuex";

	export default {
		name: 'order-product-list',
		data() {
			return {
				products: [],
				loading: false,
			}
		},

		computed: {
			...mapState(['user'])
		},

		methods: {
			loadData() {
				this.loading = true;

				// this.$http.get ('').then (() => {
				//
				// });
			}
		}
	}
</script>