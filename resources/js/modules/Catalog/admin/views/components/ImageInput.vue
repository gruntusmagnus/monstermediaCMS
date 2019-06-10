<template>
    <div class="image-uploader">

        <div class="image-uploader__image">
            <div class="image-uploader__remove"></div>
            <b-img-lazy :src="previewImage" width="400" fluid alt=""></b-img-lazy>
        </div>

        <div class="image-uploader__buttons">
            <b-button variant="primary" @click="loadFile" class="image-uploader__btn">Nahrát obrázek</b-button>
            <input type="file" :id="inputId" ref="fileInput" accept="image/*" />
        </div>

    </div>
</template>

<script>

    export default {
        name: 'image-input',
        props: ["inputId"],

        data() {
            return {
                previewImage: 'https://www.jacisnik.cz/photos/06/a5/06a551e458a8098c4afa7d583ba9c162.jpeg'
            }
        },
        methods: {
            loadFile(){
                this.$refs.fileInput.click();
            },
            handleFileChange(e) {
                this.$emit('input', e.target.files[0])
            }
        }

    }
</script>
