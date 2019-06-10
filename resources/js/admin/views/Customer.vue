<template>
	<div class="item-list container-xl">
		<b-row class="item-list__header">
			<b-col>
				<h1 class="item-list__title">Zákazníci</h1>
			</b-col>
			<b-col lg="5" md="7" sm="7" xs="12">
				<b-form-group label-cols-sm="6" label-class="text-sm-right text-center" label="Hledat v zákaznících" class="item-list__search">
					<b-input-group class="input-group--search">
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
						 @filtered="onFiltered"
						 class="item-list__table item-list__table--col1-center item-list__table--col1-bold">
					<div slot="table-busy" class="text-center my-2">
						<b-spinner class="align-middle"></b-spinner>
					</div>
				</b-table>
			</b-col>
		</b-row>
		<b-row>
			<b-col>
				<b-pagination
						v-model="currentPage"
						:total-rows="totalRows"
						:per-page="perPage"
						class="justify-content-center mb-5"
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
					{key: 'email', label: 'email', sortable:true},
					{key: 'firstname', label: 'Jméno', sortable:true},
					{key: 'lastname', label: 'Příjmení', sortable:true},
				],
				totalRows: 1,
				currentPage: 1,
				perPage: 30,
				loading: true,
				sortBy: null,
				sortDesc: false,
				sortDirection: 'asc',
				filter: null,
			}
		},
		methods: {
			loadData: function () {
				this.loading = true;

				this.$http.get ("/api/user/")
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
			}
		},
		mounted: function mounted() {
			this.loadData();
		}
	}
</script>

<style scoped>

</style>