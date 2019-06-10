<template>
    <div class="row product_item">
        <div class="product_item__image_cover">
            <slot name="image"></slot>
        </div>
        <div class="product__item_info_cover">
            <p class="product__item_name_cover">
                <slot name="name"></slot>
            </p>
            <p class="product__item_price_cover">
                <slot name="price"></slot>
            </p>
        </div>
        <div class="product_item__decision_cover">
            <button class="product__item__status" @click="orderProduct(position)">Objednej</button>
            <span class="product_item__remove" @click="deleteProduct(position)">REMOVE</span>
        </div>
    </div>
</template>
<script>
    export default {
        props:['position'],
        methods:{
            deleteProduct(index){
                this.$emit('removeProduct',index);
            },
            orderProduct(index){
                this.$emit('orderProduct',index);
            }
        }
    }
</script>
