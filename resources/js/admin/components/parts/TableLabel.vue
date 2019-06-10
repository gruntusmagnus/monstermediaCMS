<template>
	<span :class="'table-label table-label--' + this.type">
		{{this.text}}
	</span>
</template>


<script>
	export default {
		name: 'table-label',
        props: ['type','text']
	}
</script>