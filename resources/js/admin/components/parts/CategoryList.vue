<template>
	<div class="category-list">
		<ul class="category-list__list">
			<li v-for="category in categories" v-bind:key="category.id" :class="categoryClass">
				<i class="category-list__folder-ico" v-if="category.subcategories.length > 0" @click="toggleSubcategories()"></i> <label>{{category.name}}</label>
				<ul v-for="subcategory in category.subcategories" v-bind:key="subcategory.id" class="category-list__subcaegory">
					<li>
						<b-form-checkbox
								v-model="selectedCategories"
								:value="subcategory.id"
						>{{subcategory.name}}</b-form-checkbox>
					</li>
				</ul>
			</li>
		</ul>
	</div>
</template>


<script>
	export default {
		name: 'category-list',
        props: ['categories','selectedCategories'],
		data() {
		    return {
		        isActive: [],
			}
		},
        methods: {
            categoryClass: function (category) {

                if (category.subcategories.length > 0) {
                    return "category-list__has-subcategory";
				}
            },
            toggleSubcategories: function () {
                //console.log();

				if (event.target.parentElement.classList.contains('category-list__has-subcategory--active')) {
                    event.target.parentElement.classList.remove('category-list__has-subcategory--active');
				} else {
                    event.target.parentElement.classList.add('category-list__has-subcategory--active');
				}

            }
        }
	}
</script>