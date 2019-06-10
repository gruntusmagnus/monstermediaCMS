<template>

	<b-col cols="4">

		<h2>Chat s {{chat.customer.firstname}} {{chat.customer.lastname}} (neprecteno {{unread}})</h2>

		<div class="messages-container" @click="markAsRead">
			<div class="messages">
				<p v-for="message in messages" :key="message.id">
					{{message.created_at}}: {{message.content}} (precteno {{message.read ? 'ano' : 'ne'}}) </p>
			</div>
		</div>


		<b-alert variant="danger" v-model="error">Nelze odeslat zpravu.</b-alert>

		<form @submit.prevent="send">
			<b-input v-model="newMessage"></b-input>
			<b-btn type="submit">Odeslat</b-btn>
		</form>

	</b-col>

</template>

<style scoped>
	.messages-container {
		height: 400px;
		overflow: auto;
	}
</style>

<script>
	export default {
		name: 'chat',
		props: ['chat'],
		data() {
			return {
				messages: [],
				unread: 0,
				newMessage: '',
				loading: true,
				error: false,
				sending: false
			}
		},
		methods: {

			markAsRead() {
				if (this.unread === 0) {
					return;
				}

				this.$http.post('/api/chat/'+this.chat.id+'/read', {}).then(()=>{
					let total = this.messages.length;
					for(let i = 0; i < this.unread; i++) {

						let index = total - i -1;
						let message = this.messages[index];
						message.read = true;

						this.$set (this.messages, index, message);
					}

					this.unread = 0;
				});
			},

			send() {
				this.sending = true;
				this.$http.post ('/api/chat/' + this.chat.id + '/messages', {message: this.newMessage}).then ((response) => {
					this.sending = false;

					this.newMessage = '';

					this.markAsRead();

				}).catch ((error) => {
					this.sending = false;
					this.error = true
				});
			},
			scrollToEnd() {
				setTimeout(() => {
					let elem = this.$el.querySelector ('.messages');
					elem.parentNode.scrollTop = elem.clientHeight;
				}, 500);
			},


			addMessage(data) {
				this.messages.push(data);

				if (!data.read) {
					this.unread++;
				}
			}
		},

		created() {
			this.$http.get ('/api/chat/' + this.chat.id + '/messages').then ((response) => {
				let messages = response.data.data;

				for (let message in messages) {
					this.addMessage(messages[message]);
				}

				this.scrollToEnd ();
			});

			// subscribe to listening to new messages
			Echo.private ('App.Chat.' + this.chat.id).listen ('.message', ({message}) => {
				this.addMessage(message);

				this.scrollToEnd ();
			});
		}
	}
</script>