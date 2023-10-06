<template>
        <div class="content">
            <div class="text-content">

                <h2 class="title animated fadeInLeft">{{ $t("home.title") }}</h2>
                <p class="description animated fadeInLeft">{{ $t("home.description") }}</p>
                <router-link to="/menu" class="button animated fadeInRight">{{ $t("home.command") }}</router-link>

                <div class="food-image-container animated fadeInLeft">
                    <img :src="foodAvatar" alt="food Image" class="animated fadeInUp food-image" />
                </div>
            </div>

            <div class="image-content animated fadeInRight">
                <img :src="chefAvatar" alt="Chef Avatar" />
            </div>
        </div>
</template>

<script>
import chefAvatar from "@/assets/avatar-chef.png";
import foodAvatar from "@/assets/food.png";

export default {
    name: 'HomePage',
    data() {
        return {
            chefAvatar,
            foodAvatar
        }
    },
}
</script>

<style lang="css" scoped >
@import url('https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css');

.content {
    display: flex;
    max-width: 1400px;
}

.text-content {
    width: 60%;
    padding: 2em;
}

.title {
    font-family: fantasy;
    font-size: 3em;
    color: #34495e;
    animation-delay: 0.1s;
}

.description {
    font-family: fantasy;
    font-size: 1.2em;
    color: #7f8c8d;
    white-space: pre-line;
    animation-delay: .5s;
    max-width: 600px;
}

.button {
    text-decoration: none;
    display: inline-block;
    padding: 0.5em 1em;
    background-color: #ea580c;
    border: none;
    cursor: pointer;
    font-size: 1em;
    font-family: 'Arial Black', Gadget, sans-serif;
    color: #fff;
    transition: background-color 0.5s;
    animation-delay: .2s;
    border-radius: 20px;
}

.button:hover {
    background-color: #34495e;
}

.image-content {
    margin-top: 4em;
    width: 40%;
    animation-delay: .5s;
}

.image-content img {
    width: 100%;
    height: auto;
    object-fit: cover;
}

.food-image-container {
    width: 100%;
    padding: 1em 0;
}

.food-image {
    width: 100%;
    height: auto;
    animation-delay: 1s;
}
</style>
