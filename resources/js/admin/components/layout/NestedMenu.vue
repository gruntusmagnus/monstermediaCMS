<template>
	<ul class="main-menu__menu-left">
		<li v-for="link in data">
			<router-link v-if="typeof link.submenu === 'undefined' || link.submenu.length === 0 " :to=link.href :class="`main-menu__item main-menu__item--${link.slug}`">
				{{link.text}}
			</router-link>
			<nested-menu v-else :data="link.submenu">{{link.text}}</nested-menu>
		</li>
	</ul>
</template>

<script>
	export default {
		name: 'nested-menu',

		props: ['data'],
	}
</script>