<template>
	<span :class="'state-ico state-ico--' + this.type">
	</span>
</template>


<script>
	export default {
		name: 'state-ico',
        props: ['type']
	}
</script>