<template>
	<div class="item-list container-xl">
		<b-row class="item-list__header">
			<b-col lg="3" md="12" sm="12" xs="12">
				<h1 class="item-list__title">Starší objednávky</h1>
			</b-col>
			<b-col lg="4" md="12" sm="12" xs="12">
				<b-form-group label-cols-sm="6" label-class="text-lg-right text-center" label="Hledat v archivu" class="item-list__search">
					<b-input-group class="input-group--search">
						<b-form-input v-model="filter"></b-form-input>
					</b-input-group>
				</b-form-group>
			</b-col>
			<b-col lg="5" md="12" sm="12" xs="12">
				<b-form-group label-cols-sm="3" label-class="text-lg-right text-center" label="Filtrovat od" class="item-list__date">
					<b-row>
						<b-input-group class="input-group--date col-sm-5">
							<b-form-input value="12.11.2019"></b-form-input>
						</b-input-group>
						<b-col cols="2" class="col-form-label text-lg-right text-center">do</b-col>
						<b-input-group class="input-group--date col-sm-5">
							<b-form-input value="12.12.2019"></b-form-input>
						</b-input-group>
					</b-row>
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
						 class="item-list__table item-list__table--col1-center item-list__table--col8-center item-list__table--col1-bold item-list__table--col4-bold item-list__table--col5-bold">
					<div slot="table-busy" class="text-center my-2">
						<b-spinner class="align-middle"></b-spinner>
					</div>
					<template slot="payment" slot-scope="data">
						<table-label type="purple" text="Kartou u obsluhy"></table-label>
					</template>
					<template slot="state" slot-scope="data">
						<table-label type="red" text="Nezaplaceno"></table-label>
					</template>
					<template slot="action" slot-scope="data">
						<div class="text-md-center text-lg-center text-xl-center">
							<span class="action-icon" v-b-tooltip.left.hover title="Detail objednávky"><i class="fas fa-search"></i></span>
						</div>
					</template>
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
					{key: 'timestamp', label: 'Datum', sortable:true},
					{key: 'customer', label: 'Zákazník', sortable:true},
					{key: 'table', label: 'Číslo stolu', sortable:true},
					{key: 'total', label: 'Celkem', sortable:true},
					{key: 'payment', label: 'Platba', sortable:true},
                    {key: 'state', label: 'Stav', sortable:true},
                    {key: 'action', label: ''}
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

				this.$http.get ("/api/archive/")
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