<template lang="html">
    <div class="item-container animated fadeIn">
        <div class="item-image animated fadeInLeft">
            <img :src="chefAvatar" alt="Menu item image" class="image">
        </div>
        <div class="item-details animated fadeInRight">
            <h1 class="item-name">{{ itemData.name }}</h1>
            <p class="item-category">{{ itemData.category }}</p>
            <div class="item-rating">
                <span class="stars">&#9733;&#9733;&#9733;&#9733;&#9733;</span>
            </div>

            <p class="item-description">{{ itemData.description }}</p>

            <div class="quantity-container animated fadeInUp">
                <label for="quantity" class="item-quantity-label">{{ $t("itemPage.quantity") }}:</label>
                <input type="number" id="quantity" v-model="quantity" min="1" class="item-quantity-input">
            </div>

            <div class="item-info">
                <span class="item-price animated fadeInUp">{{ itemData.price }} €</span>
                <span class="item-time animated fadeInUp">{{ $t("itemPage.Preparation-Time") }}: {{ itemData.preparationTime }} mins</span>
            </div>
            <button class="add-to-cart animated fadeInUp" @click="addToCart(itemData.id)">
                <span class="cart-text">{{ $t("itemPage.addToCart") }}</span>
                <span class="cart-icon">&#128722;</span>
            </button>

            <div class="toast" :class="{ show: showToast }">Plat ajouté au panier!</div>
        </div>
    </div>
</template>

<script>
import { MenuRepository } from '@/repositories/Menu';
import chefAvatar from "@/assets/avatar-chef.png";

export default {
    name: 'ItemPage',
    data() {
        return {
            itemData: {},
            chefAvatar,
            quantity: 1,
            showToast : false,
        }
    },
    async created() {
        try {
            const response = await MenuRepository.getByID(this.$route.params.itemId);
            this.itemData = response.data;
        } catch (error) {
            console.log(error);
        }
    },
    methods: {
        addToCart(id) {
            let ids = localStorage.getItem('ids');
            ids = ids ? JSON.parse(ids) : [];

            // add item Id in storage
            for (let i = 0; i < this.quantity; i++) {
                ids.push(id);
            }

            localStorage.setItem('ids', JSON.stringify(ids));

            // style effect, to show that the item has been added
            this.showToast = true;
            setTimeout(() => {  
                this.showToast = false;
            }, 2000);
        }
    }
}
</script>
<style lang="css" scoped>
@import url('https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css');

.item-container {
    display: flex;
    align-items: center;
    padding: 50px;
    background-color: #ffffff;
    max-width: 1200px;
    margin: 0 auto;
}

.item-image {
    width: 50%;
    margin-right: 5em;
}

.image {
    width: 100%;

    border-radius: 10px;
    object-fit: cover;
}

.item-details {
    width: 60%;
    padding: 20px;
}

.item-name {
    font-size: 30px;
    font-weight: 600;
    color: #333;
    margin-bottom: 10px;
}

.item-category {
    font-size: 18px;
    color: #777;
    margin-bottom: 10px;
}

.item-rating {
    font-size: 18px;
    color: #ffa726;
    margin-bottom: 15px;
}

.stars {
    margin-right: 10px;
}

.reviews {
    color: #777;
}

.item-description {
    font-size: 18px;
    line-height: 1.5;
    margin-bottom: 20px;
}

.item-info {
    display: flex;
    justify-content: space-between;
    margin-bottom: 20px;
}

.item-price {
    font-size: 24px;
    font-weight: 600;
    color: #000000;
}

.item-time {
    font-size: 18px;
    color: #555;
}

.quantity-container {
    display: flex;
    align-items: center; /* Aligne les éléments verticalement */
    gap: 10px; /* Espace entre le label et l'input */
}

.item-quantity-label {
    font-size: 1rem;
    color: #333;
    margin: 0; /* Supprime la marge pour un meilleur alignement */
}

.item-quantity-input {
    width: 60px;
    padding: 5px;
    font-size: 1rem;
    border: 1px solid #000000;
    border-radius: 5px;
    text-align: center;
    background-color: #ffffff;
}

/* Vous pouvez ajouter cette règle si vous voulez ajouter un effet de survol à l'input */
.item-quantity-input:hover {
    border-color: #ea580c;
}

.add-to-cart {
    padding: 10px 20px;
    background-color: #000000;
    color: #fff;
    font-size: 20px;
    border-radius: 5px;
    border: none;
    cursor: pointer;
    transition: background-color 0.5s;
}

.add-to-cart:hover {
    background-color: #ea580c;
}

.cart-text {
    margin-right: 10px;
    font-family: fantasy;
}

.cart-icon {
    transition: transform 0.3s ease;
}

.toast {
    visibility: hidden;
    min-width: 250px;
    margin-left: -125px;
    background-color: none;
    color: #5cd071;
    text-align: center;
    border-radius: 2px;
    padding: 16px;
    position: fixed;
    z-index: 1;
    left: 50%;
    bottom: 30px;
    font-size: 17px;
    transition: visibility 0.5s, opacity 0.5s linear;
}

.toast.show {
    visibility: visible;
    opacity: 1;
}



.item-name,
.item-category,
.item-rating,
.item-description,
.item-price,
.item-time,
.add-to-cart {
    opacity: 0;
    animation: fadeInUp 0.8s forwards;
    animation-delay: 0.2s; /* You can adjust this delay as per your preference */
}

@keyframes fadeInUp {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>
