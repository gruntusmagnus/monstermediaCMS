<template>
	<b-row class="form-footer">
		<b-col class="text-center">
			<slot></slot>
		</b-col>
	</b-row>
</template>


<script>
	export default {
		name: 'form-footer',
        //props: ['type','text']
	}
</script>