<template>
    <main>
        <div class="carousel-container">
            <div class="carousel-slide" :style="{ transform: `translateX(-${currentSlide * 100}%)` }">
                <img src="../assets/img/RECRUITAMENT1.jpg" alt="Imagem 1">
                <img src="../assets/img/RECRUITAMENT2.jpg" alt="Imagem 2">
                <img src="../assets/img/RECRUITAMENT3.jpg" alt="Imagem 3">
            </div>
            <button class="prev" @click="moveSlide(-1)">&#10094;</button>
            <button class="next" @click="moveSlide(1)">&#10095;</button>
        </div>
    </main>
</template>

<script>
export default {
    name: 'Carrossel',
    data() {
        return {
            currentSlide: 0,
            totalSlides: 3
        };
    },
    methods: {
        moveSlide(direction) {
            this.currentSlide += direction;

            if (this.currentSlide < 0) {
                this.currentSlide = this.totalSlides - 1;
            } else if (this.currentSlide >= this.totalSlides) {
                this.currentSlide = 0;
            }
        }
    }
}
</script>

<style scoped>
.carousel-container {
    margin-top: 50px;
    position: relative;
    width: 100vw;
    height: 80vh;
    overflow: hidden;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.carousel-slide {
    display: flex;
    transition: transform 0.5s ease-in-out;
}

.carousel-slide img {
    width: 100vw;
    border-radius: 10px;
    flex-shrink: 0;
}

.prev,
.next {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background-color: rgba(0, 0, 0, 0.5);
    color: white;
    border: none;
    padding: 10px;
    cursor: pointer;
    border-radius: 50%;
}

.prev {
    left: 10px;
}

.next {
    right: 10px;
}

.prev:hover,
.next:hover {
    background-color: rgba(0, 0, 0, 0.8);
}
</style>
