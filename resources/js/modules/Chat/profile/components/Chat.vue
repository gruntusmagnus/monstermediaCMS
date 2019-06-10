<template>
	<div v-if="chat">
		<chat-message-window :chat="chat" source="customer"></chat-message-window>

		<chat-write-message :chat="chat" source="customer"></chat-write-message>

	</div>
</template>
<script>
	import ChatMessageWindow from "../../components/MessageWindow";
	import ChatWriteMessage from "../../components/NewMessage";

	export default {
		components: {ChatWriteMessage, ChatMessageWindow},
		name: "customer-chat",
		data() {
			return {
				chat: false
			}
		},

		methods: {
			loadChat() {
				this.loading = true;

				this.$http.get ('/api/chat').then ((response) => {
					let activeChats = response.data.data;

					if (activeChats.length > 0) {
						this.chat = activeChats[0];
					}
					this.loading = false;
				});
			}
		},

		mounted() {
			this.loadChat ();
		}
	}
</script>