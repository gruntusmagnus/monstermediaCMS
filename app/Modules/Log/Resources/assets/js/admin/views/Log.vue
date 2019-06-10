<template>
	<div>
		<b-row>
			<b-col>
				<h1>Log událostí</h1>
			</b-col>
			<b-col>
				<b-form-group label-cols-sm="3" label="Hledat v logu" class="mb-0">
					<b-input-group>
						<b-form-input v-model="filter"></b-form-input>
					</b-input-group>
				</b-form-group>
			</b-col>
		</b-row>
		<b-row>
			<b-col>
				<b-table striped hover stacked="md"
						 :busy="loading"
						 :items="data.data"
						 :fields="tableColumns"
						 :current-page="currentPage"
						 :per-page="perPage"
						 :sort-by.sync="sortBy"
						 :sort-desc.sync="sortDesc"
						 :sort-direction="sortDirection"
						 :filter="filter"
						 @filtered="onFiltered">
					<div slot="table-busy" class="text-center my-2">
						<b-spinner class="align-middle"></b-spinner>
					</div>
				</b-table>
			</b-col>
		</b-row>
		<b-row>
			<b-col md="6">
				<b-pagination
						v-model="currentPage"
						:total-rows="totalRows"
						:per-page="perPage"
				></b-pagination>
			</b-col>
		</b-row>
	</div>

</template>

<script>
	export default {
		data() {
			return {
				data: [],
				tableColumns: [
					{key: 'id', label: 'ID', sortable:true},
					{key: 'code', label: 'Kód', sortable:true},
                    {key: 'text', label: 'Text', sortable:true},
                    {key: 'timestamp', label: 'Čas', sortable:true},
				],
				totalRows: 1,
				currentPage: 1,
				perPage: 30,
				loading: true,
				sortBy: 'id',
				sortDesc: false,
				sortDirection: 'desc',
				filter: null,
			}
		},
		methods: {
			loadData: function () {
				this.loading = true;

				this.$http.get ("/api/log/")
						.then ((response) => {
							this.loading = false;
							this.data = response.data;
							this.totalRows = this.data.data.length;
						}, (error) => {
							console.log(error);
						})
			},
			onFiltered(filteredItems) {
				// Trigger pagination to update the number of buttons/pages due to filtering
				this.totalRows = filteredItems.length
				this.currentPage = 1
			},
		},
		mounted: function mounted() {
			this.loadData();
		}
	}
</script>

<style scoped>

</style>