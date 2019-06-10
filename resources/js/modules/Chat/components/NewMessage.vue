<template>

	<div>
		<b-alert variant="danger" v-model="error">Nelze odeslat zpravu.</b-alert>

		<form @submit.prevent="send">
			<b-input v-model="newMessage" @keydown="isTyping"></b-input>
			<b-btn type="submit">Odeslat</b-btn>
		</form>
	</div>

</template>

<script>
	export default {
		name: 'chat-write-message',
		props: ['chat', 'source'],
		data() {
			return {
				newMessage: '',
				error: false,
				sending: false
			}
		},
		methods: {
			send() {
				if (this.newMessage === '') {
					// ignore empty message
					return;
				}

				this.sending = true;
				this.$http.post ('/api/chat/' + this.chat.id + '/messages', {
					message: this.newMessage,
					source: this.source
				}).then ((response) => {
					this.error = this.sending = false;
					this.newMessage = '';
				}).catch ((error) => {
					this.sending = false;
					this.error = true
				});
			},
			isTyping() {
				let channel = Echo.private('App.Chat.' + this.chat.id);

				setTimeout(function() {
					channel.whisper('typing', {
						typing: true
					});
				}, 300);
			},
		}
	}
</script>