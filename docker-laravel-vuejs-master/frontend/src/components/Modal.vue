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
<style>
.modal-overlay {
    position: absolute;
    left: 35%;
    top: 20%;
    width: auto;
    height: auto;
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 1;
}
.modal-container {
    background:#4ea1db;
    padding: 20px;
    border-radius: 8px;
    width: 400px;
    max-width: 90%;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}
.close-button {
    position: absolute;
    top: 10px;
    right: 10px;
}
</style>