<template>
    <div v-if="show" class="modal-overlay">
        <div class="modal-container">
            <button class="close-button" @click="$emit('close')">X</button>
            <slot></slot>
        </div>
    </div>
</template>
<script>
    export default{
        name:'Modal',
        props:{
            show:{
                type:Boolean,
                required:true
            }
        }
    }
</script>
<style scoped>

</style>
