<template>
	<div class="toggle-switch">
		<div class="toggle-switch__items">
			<input :id="this.id + '-yes'" :name="this.id" type="radio" value="1">
			<label :for="this.id + '-yes'" @click="switched(true)"><span></span></label>
			<input :id="this.id + '-no'" checked="checked" :name="this.id" type="radio" value="0">
			<label :for="this.id + '-no'" @click="switched(false)"><span></span></label>
			<div class="toggle-switch__background"></div>
			<div class="toggle-switch__slide"></div>
		</div>
		<div class="toggle-switch__labels">
			<label :class="firstLabel" v-html="this.labels.checked"></label>
			<label :class="secondLabel" v-html="this.labels.unchecked"></label>
		</div>
	</div>
</template>

<script>
	export default {
		name: 'toggle-switch',
        props: ['checked','unchecked','id','labels'],
        data() {
            return {
                firstLabel: "active",
                secondLabel: ""
            }
        },
		methods: {
            switched: function (isOn) {

                if (isOn) {
                    this.firstLabel = "";
                    this.secondLabel = "active";
				} else {
                    this.firstLabel = "active";
                    this.secondLabel = "";
				}
            }
        }
	}
</script>