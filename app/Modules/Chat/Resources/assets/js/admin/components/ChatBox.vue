<template>

	<div>
		<b-alert variant="info" v-model="loading">Probiha nacitani chatu</b-alert>

		<b-row>
			<chat v-for="chat in chats" :key="chat.id" :chat="chat"></chat>

			<b-col cols="1">

			</b-col>
		</b-row>
	</div>

</template>

<script>
	import Chat from "./Chat";

	export default {
		name: 'chat-boxes',
		components: {Chat},
		data() {
			return {
				chats: [],
				loading: false
			}
		},
		methods: {
			loadData() {
				this.loading = true;

				this.$http.get ('/api/chat/').then ((response) => {
					this.chats = response.data.data;
					this.loading = false;
				});
			}
		},
		mounted() {
			this.loadData ()
		}

	}
</script>