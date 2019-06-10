<template>
	<div :class="languageSwitcherClass">
		<ul class="language-switcher-in">
			<li class="language-switcher__clicker" @click="toggleSwitcherClass"></li>
			<li class="language-switcher__item language-switcher__item--selected">
				<a href="#">cs</a>
			</li>
			<li class="language-switcher__item">
				<a href="#">en</a>
			</li>
		</ul>
	</div>
</template>


<script>
	export default {
		name: 'language-switcher',
		data() {
            return {
                extraClass: ''
            }
        },
        computed: {
            languageSwitcherClass() {
                return "language-switcher language-switcher--admin " +this.extraClass
            }
        },
        methods: {
            toggleSwitcherClass() {
                if (this.extraClass === "") {
                    this.extraClass = "active";
                } else {
                    this.extraClass = "";
                }
            }
        }
	}
</script>