<template>
    <div class="item-list container-xl">
        <b-row class="item-list__header">
            <b-col>
                <h1 class="item-list__title">Kategorie</h1>
            </b-col>
            <b-col lg="5" md="7" sm="7" xs="12">
                <b-form-group label-cols-sm="6" label-class="text-sm-right text-center" label="Hledat v kategoriích" class="item-list__search">
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
                         @row-clicked="showCategory"
                         class="item-list__table item-list__table--col1-center item-list__table--col3-center item-list__table--col1-bold">
                    <div slot="table-busy" class="text-center my-2">
                        <b-spinner class="align-middle"></b-spinner>
                    </div>
                    <template slot="position" slot-scope="data">
                        <div class="drag-and-drop"><i class="fas fa-arrows-alt"></i> {{ data.value }}</div>
                    </template>
                    <template slot="active" slot-scope="data">
                        <table-label type="red" text="Neaktivní"></table-label>
                    </template>
                    <template slot="action" slot-scope="data">
                        <div class="text-md-center text-lg-center text-xl-center">
                            <router-link :to="{name: 'CategoryDetail', params: {id:data.item.id}}" class="action-icon" v-b-tooltip.left.hover title="Editovat"><i class="fas fa-search"></i></router-link>
                            <span class="action-icon" v-b-tooltip.left.hover title="Smazat"><i class="fas fa-trash-alt"></i></span>
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
                    {key: 'name', label: 'Název', sortable:true},
                    {key: 'position', label: 'Pozice', sortable:true},
                    {key: 'active', label: 'Stav', sortable:true},
                    {key: 'action', label: ''}
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
        computed: {

        },
        methods: {
            loadData: function () {
                this.loading = true;

                this.$http.get ("/api/category/"+this.$route.params.id)
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
            showCategory(record, index){
                this.$router.replace({to: "Category", params: {id: record.id}});
            }
        },
        watch: {
            $route(from, to) {
                this.loadData()
            }
        },
        mounted: function mounted() {
            this.loadData();
        }
    }
</script>

<style scoped>

</style>