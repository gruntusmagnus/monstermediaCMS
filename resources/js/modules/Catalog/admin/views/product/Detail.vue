<template>
    <container-xl class="detail">
        <main-title>Úprava produktu: <span>{{product.name}}</span></main-title>
        <b-form @submit="onSubmit">
            <b-row>
                <b-col md="4" xs="12">

                    <b-form-group
                            id="input-group-4"
                            label="Aktivní"
                            label-for="input-4"
                            label-cols-sm="4"
                            label-cols-lg="3"
                    >
                        <toggle-switch id="input-4" v-model="product.active" :labels="{checked: 'Aktivní', unchecked: 'Neaktivní'}"></toggle-switch>
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
                                v-model="product.name"
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

                    <b-form-group
                            id="input-group-2"
                            label="Cena s DPH"
                            label-for="input-2"
                            label-cols-sm="4"
                            label-cols-lg="3"
                            class="form-group--unit"
                    >
                        <b-form-input
                                id="input-2"
                                v-model="product.price"
                                type="number"
                                step="0.1"
                                required
                        ></b-form-input>
                        <form-input-unit unit="Kč"></form-input-unit>
                    </b-form-group>
                </b-col>
                <b-col md="4" xs="12">
                    <b-form-group
                            id="input-group-6"
                            label="Obrázek"
                            label-for="imageInputFile"
                    >
                        <image-input inputId="imageInputFile"></image-input>
                    </b-form-group>
                </b-col>
                <b-col md="4" xs="12">
                    <b-form-group
                            id="input-group-3"
                            label="Popis"
                            label-for="input-3"
                    >
                        <b-form-textarea
                                id="input-3"
                                rows="8"
                                v-model="product.description"
                                required
                        ></b-form-textarea>
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
    import ImageInput from "../components/ImageInput";

    export default {
        components: {ImageInput},
        data() {
            return {
                loading: true,

                product: {},
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

                //product
                this.$http.get ("/api/product/"+this.$route.params.id)
                    .then ((response) => {
                        this.loading = false;
                        this.product = response.data;
                        for(let e in this.product.categories){
                            this.selectedCategories.push(this.product.categories[e].id);
                        }

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