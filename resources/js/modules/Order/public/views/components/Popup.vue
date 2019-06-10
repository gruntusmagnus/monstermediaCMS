<template>
    <div class="order__modal modal product fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="product_list__tile">
                        <h2>Produkt byl přidán k objednávce</h2>
                    </div>
                    <div class="product_list__info">
                        <span class="btn-info info-icon"></span><span> Pro objednání jídle potvrďte položky které chcete doručit na stůl.</span>
                    </div>
                    <product-comp v-for="(product, index) in products" :key="product.id" @removeProduct="deleteProduct" @orderProduct="orderProduct" :position="index" >
                        <img slot='image' :src="product.image" alt="" class="product_item__image">
                        <span slot="name">{{product.name}}</span>
                        <span slot="price">{{product.price}}</span>
                    </product-comp>
                    <div class="product_list__decision">
                        <button>Pokračovar ve výběru</button>
                        <button>Objednat vše</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import newProduct from '../../../../Catalog/public/views/product/components/Product.vue';
    export default {
        props:['product'],
        data(){
            return{
                products:[],
                activeLoader:false
            }
        },
        components:{
            productComp: newProduct
        },
        methods:{
            deleteProduct(index){
                this.products.splice(index,1);
            },
            orderProduct(index){

            }
        },
        created(){

        }
    }
</script>
