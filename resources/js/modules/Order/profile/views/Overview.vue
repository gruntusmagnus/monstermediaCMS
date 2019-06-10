<template>
	<b-row>
		<b-col cols="7">
			<h1>objednavky</h1>

			<order-product-list></order-product-list>

		</b-col>

		<b-col>
			<h1>Chat</h1>

			<customer-chat></customer-chat>

		</b-col>
	</b-row>
</template>


<script>

	import OrderProductList from "../components/order/ProductList";
	import CustomerChat from "../../../Chat/profile/components/Chat";
	export default {
		// name: "order-overview",
		components: {CustomerChat, OrderProductList},
	}
</script>