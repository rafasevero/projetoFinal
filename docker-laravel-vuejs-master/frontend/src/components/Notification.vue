<!-- Notification.vue -->
<template>
    <div class="notification" v-if="isVisible">
        <p>{{ message }}</p>
    </div>
</template>

<script>
export default {
    name: 'Notification',
    props: {
        message: {
            type: String,
            required: true
        },
        duration: {
            type: Number,
            default: 2000,
        }
    },
    data() {
        return {
            isVisible: true
        };
    },
    mounted() {
        setTimeout(this.closeNotification, this.duration);
    },
    methods: {
        closeNotification() {
            this.isVisible = false;
        }
    }
};
</script>

<style scoped>
.notification {
    position: fixed;
    top: 55%;
    right: 40%;
    padding: 15px 20px;
    background-color: #4CAF50;
    color: white;
    border-radius: 5px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    display: flex;
    align-items: center;
    justify-content: space-between;
    min-width: 200px;
    z-index: 1000;
}

.notification button {
    background: transparent;
    border: none;
    color: white;
    cursor: pointer;
    font-size: 1.2em;
}
</style>
