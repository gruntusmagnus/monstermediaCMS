<template>

	<b-col cols="4">

		<h2>Chat s {{chat.customer.firstname}} {{chat.customer.lastname}}</h2>

		<chat-message-window :chat="chat" source="employee"></chat-message-window>

		<chat-write-message :chat="chat" source="employee"></chat-write-message>


	</b-col>

</template>

<script>
	import ChatMessageWindow from "../../components/MessageWindow";
	import ChatWriteMessage from "../../components/NewMessage";

	export default {
		name: 'chat',
		components: {ChatWriteMessage, ChatMessageWindow},
		props: ['chat'],
	}
</script>