<template>
    <div>
    <div class="product__modal modal product fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body spinner-border" v-if="activeLoader"></div>
                <div class="modal-body" v-else>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="ico-close"></span>
                    </button>
                    <div class="product__image">
                        <img class="js_product__image" :src="product.image">
                    </div>
                    <div class="product__content">
                        <h2 class="js_product__name product__name">{{product.name}}</h2>
                        <div class="js_product__text product__text">{{product.description}}</div>
                        <div class="product__footer">
                            <div class="js_product__price product__price">{{product.price}}</div>
                            <div class="product__button" @click="addToOrder">
                                <button type="button" class="btn btn-primary">Pridat k objednávce</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <order-comp :product="product">
        </order-comp>
    </div>
</template>

<script>
    import Order from "../../../../../Order/public/views/components/Popup.vue";


    export default {
        props:['productid','activemodal'],
        data(){
            return{
                product:{
                    id: null,
                    name: '',
                    description: '',
                    price: null,
                    image: '/img/product.jpg'
                },
                activeLoader: false
            }
        },
        components:{
            orderComp: Order
        },
        methods:{
            addToOrder(){
                $('.order__modal').modal('show');
                $('.product__modal').modal('hide');
            }
        },
        watch:{
            productid(){
                this.activeLoader = true;
                var _this = this;
                _this.$http.get('/api/produkt/'+this.productid).then(function (response) {
                    var productObj = response.data.data;
                    _this.product.id = productObj.id;
                    _this.product.name = productObj.name;
                    _this.product.description = productObj.description;
                    _this.product.price = productObj.price_user;
                    if(productObj.hasOwnProperty('image') && (productObj.image !== null || productObj.image !== '')){
                    _this.product.image = productObj.image;
                    }
                    _this.activeLoader = false;
                });

            },
            activemodal(){
                $('.product__modal').modal('show');
            }


        }
    }
</script>
