<template>

	<div class="messages-container">

		<span class="unread" v-if="unread > 0">{{unread}}</span>

		<div class="messages" v-chat-scroll="{always: false, smooth: true}" @click="markAsRead">
			<p>
				<a href="#" @click.prevent="loadOlder" v-if="olderMessagesLink">Načíst starší zprávy</a>

				<span v-else>Začátek komunikace</span>
			</p>


			<p v-for="message in messages" :key="message.id" :class="message.from + ' message ' +(message.read ? '' : 'new')">
				{{message.created_at}}: {{message.content}} </p>
		</div>
		<div v-if="typing">pise...</div>
	</div>
</template>

<style scoped>
	.message {
		border: solid 1px;
		width: 75%;
		border-radius: 15px;
		padding: 10px;
		position: relative;
	}

	.message.new:after {
		content: '*';
		color: red;
		position: absolute;
		top: 0;
		right: 6px;
	}

	.customer {
		float: left;
		background: #DDD;
	}

	.employee {
		float: right;
		background: gold;
	}

	.messages {
		height: 400px;
		overflow: auto;
	}

</style>

<script>
	import Vue from 'vue';
	import VueChatScroll from 'vue-chat-scroll';

	Vue.use (VueChatScroll);

	export default {
		name: 'chat-message-window',
		props: ['chat', 'source'],
		data() {
			return {
				messages: [],
				archiveMessages: [],
				unread: 0,
				typing: false,
				loading: true,
				error: false,
				olderMessagesLink: null
			}
		},
		methods: {

			markAsRead() {
				if (this.unread === 0) {
					return;
				}

				this.$http.post ('/api/chat/' + this.chat.id + '/read', {source: this.source}).then (() => {
					let total = this.messages.length;
					for (let i = 0; i < total; i++) {
						let message = this.messages[i];

						if (!message.read && message.from !== this.source) {
							message.read = true;

							this.$set (this.messages, i, message);
						}
					}

					this.unread = 0;
				});
			},

			addMessage(data, type = undefined) {
				if (data.from === this.source) {
					data.read = true;
				}

				if (typeof type === 'undefined') {
					type = 'new';
				}

				if (type === 'new') {
					this.messages.push (data);
				}

				if (type === 'archive') {
					this.archiveMessages.push (data);
				}

				if (!data.read) {
					this.unread++;
				}
			},

			insertMessages(messages, type) {
				// sort incomming messages
				messages = messages.sort (function (a, b) {
					return a.created_at_iso > b.created_at_iso;
				});



				for (let message in messages) {
					this.addMessage (messages[message], type);
				}
			},

			loadOlder() {
				if (!this.olderMessagesLink) {
					return;
				}

				this.$http.get (this.olderMessagesLink).then ((response) => {
					let messages = response.data.data;
					this.olderMessagesLink = response.data.links.next;

					this.insertMessages (response.data.data, 'archive');

					// prepend archive messages
					this.messages = this.archiveMessages.concat (this.messages);
					this.archiveMessages = [];
				});
			},
		},

		mounted() {
			this.$http.get ('/api/chat/' + this.chat.id + '/messages').then ((response) => {
				let messages = response.data.data;
				this.olderMessagesLink = response.data.links.next;
				this.insertMessages (response.data.data, 'new');
			});

			let _this = this;
			let timeout = false;

			// subscribe to listening to new messages
			Echo.private ('App.Chat.' + this.chat.id).listen ('.message', ({message}) => {
				this.addMessage (message);

				if (message.from === this.source) {
					this.markAsRead ();
				}

			}).listenForWhisper ('typing', (e) => {
				if (timeout) {
					clearTimeout (timeout);
				}

				this.typing = e.typing;

				timeout = setTimeout (function () {
					_this.typing = false
				}, 900);
			});
		}
	}
</script>