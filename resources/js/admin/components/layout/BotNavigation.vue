<template>

	<b-row>
		<b-col class="text-right">
			Cyberdog &copy; {{ year }}
		</b-col>
	</b-row>

</template>

<script>
	export default {
		name: 'bot-navigation',
		data(){
			return {
				year : new Date().getFullYear()
			}
		}
	}
</script>

<style lang="scss" scoped>

</style>