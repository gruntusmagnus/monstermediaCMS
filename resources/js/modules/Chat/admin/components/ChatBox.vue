<template>

	<div>
		<h1> Chaty </h1>
		<b-alert variant="info" v-model="loading">Probiha nacitani chatu</b-alert>
		<b-row>
			<chat v-for="chat in chats" :key="chat.id" :chat="chat"></chat>
		</b-row>
	</div>

</template>

<script>
	import Chat from "./Chat";
	import {mapState} from "vuex";

	export default {
		name: 'chat-boxes',
		components: {Chat},
		data() {
			return {
				chats: {},
				loading: false
			}
		},
		computed: {
			...mapState (['user'])
		},
		methods: {
			loadData() {
				this.loading = true;

				let _this = this;

				this.$http.get ('/api/chat/').then ((response) => {
					let chats = response.data.data;
					for (let  i in chats) {
						let chat = chats[i];
						this.chats[chat.id] = chat;
					}
					this.loading = false;
				});

				// Echo is not defined bez timeoutu... wtf?
				setTimeout(function () {
					Echo.private ('App.Chat.Active').listen ('.chat', ({chat}) => {
						console.log('---------------');
						console.log(_this.chats);

						let isActive = chat.is_active;

						if (!isActive) {
							_this.$delete(_this.chats, chat.id);
						} else {
							if (typeof _this.chats[chat.id] === 'undefined') {
								// _this.chats[chat.id] = chat;
								_this.$set(_this.chats, chat.id, chat);
							}
						}

						console.log(_this.chats);
						console.log('---------------');
					});
				}, 500);

			}
		},
		created() {
			this.loadData ();
		},
	};
</script>