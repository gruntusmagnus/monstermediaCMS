<template>
    <div>
        <b-row>
            <b-col>
                <h1>Kategorie</h1>
            </b-col>
            <b-col>
                <b-form-group label-cols-sm="3" label="Hledat v kategoriích" class="mb-0">
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
                         @filtered="onFiltered"
                         @row-clicked="showCategory">
                    <div slot="table-busy" class="text-center my-2">
                        <b-spinner class="align-middle"></b-spinner>
                    </div>
                    <span slot="action" slot-scope="data">
                          <router-link :to="{name: 'CategoryDetail', params: {id:data.item.id}}" class="btn btn-primary">Editovat</router-link>
                          <b-button variant="danger">Smazat</b-button>
                    </span>
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