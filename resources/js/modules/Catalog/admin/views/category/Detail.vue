<template>
    <container-xl class="detail">
        <main-title>Kategorie detail: <span>Název kategorie</span></main-title>
        <b-form @submit="onSubmit">
            <b-row>
                <b-col lg="4" md="6" sm="12" xs="12">
                    <b-form-group
                            id="input-group-4"
                            label="Aktivní"
                            label-for="input-4"
                            label-cols-sm="4"
                            label-cols-lg="3"
                    >
                        <toggle-switch id="input-4" :labels="{checked: 'Aktivní', unchecked: 'Neaktivní'}"></toggle-switch>
                    </b-form-group>

                    <b-form-group
                            id="input-group-1"
                            label="Název"
                            label-for="input-1"
                            label-cols-sm="4"
                            label-cols-lg="3"
                    >
                        <b-form-input
                                id="input-1"
                                type="text"
                                required
                        ></b-form-input>
                    </b-form-group>

                    <b-form-group
                            id="input-group-5"
                            label="Kategorie"
                            label-cols-sm="4"
                            label-cols-lg="3"
                    >
                        <category-list :categories="categories" :selectedCategories="selectedCategories"></category-list>

                    </b-form-group>
                </b-col>
            </b-row>
            <form-footer>
                <b-button type="submit" variant="primary">Uložit</b-button>
                <b-button variant="light">Smazat</b-button>
            </form-footer>
        </b-form>
    </container-xl>
</template>

<script>
    export default {
        data() {
            return {
                loading: true,

                categories: {},
                selectedCategories: []

            }
        },
        methods: {
            loadData: function () {
                this.loading = true;

                //categories
                this.$http.get ("/api/category/")
                    .then ((response) => {
                        this.categories = response.data.data;
                    }, (error) => {
                        console.log(error);
                    })
            },
            onSubmit(evt) {
                evt.preventDefault()
                alert(JSON.stringify(this.form))
            },
        },
        mounted: function mounted() {
            this.loadData();
        }
    }
</script>

<style scoped>

</style>