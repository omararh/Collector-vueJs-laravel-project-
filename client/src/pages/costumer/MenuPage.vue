<template lang="html">
    <div class="container">
        <div class="search-bar-container animated fadeInDown">
            <input type="text" v-model="search" placeholder="Chercher ..." class="search-bar animated fadeInUp">
        </div>


        <div class="menu-container animated fadeIn">
            <div v-for="(item, index) in filteredMenu" 
                 :key="index" 
                 class="menu-item"
                 :class="index % 2 === 0 ? 'animated fadeInLeft' : 'animated fadeInRight'"
                >
                <button class="menu-item-content" @click="switchToproductPage(item.id)">
                    <h2 class="menu-item-name">{{ item.name }}</h2>
                    <p class="menu-item-description">{{ item.description }}</p>
                    <p class="menu-item-price">{{ item.price }} €</p>
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import { MenuRepository } from '@/repositories/Menu'


export default {
    name: 'MenuPage',
    data() {
        return {
            menu: [],
            search: '',
        }
    },
    methods : {
        switchToproductPage(id) {
            this.$router.push({ name: 'ItemPage', params: { itemId: id } });
        },
    },
    computed: {
        filteredMenu() {
            if (this.search) {
                return this.menu.filter(item => 
                    item.name.toLowerCase().includes(this.search.toLowerCase()) ||
                    item.description.toLowerCase().includes(this.search.toLowerCase())
                );
            } else {
                return this.menu;
            }
        }
    },
    async created() {
        try {   
            const response = await MenuRepository.get();
            this.menu = response.data;
        } catch (error) {
            console.log(error);
        }
    }
}
</script>


<style lang="css" scoped>
@import url('https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css');

.container {
    width: 100%; 
    display: block;
}

.search-bar-container {
    display: flex;
    justify-content: center;
    margin-bottom: 2em;
}

.search-bar {
    width: 20%;
    padding: 8px;
    font-size: 1.2em;
    border-radius: 25px;
    border: 1px solid #ccc;
    outline: none;
}

.search-bar:focus {
    border-color: #0366d6;
}

.menu-container {
    margin-top: -1.5em;
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 2em;
    padding: 2em;
    background-color: #ffffff;
    animation-delay: 0.2s;
    margin-bottom: 3em;
    margin-left: auto; 
    margin-right: auto; 
    width: 75%;
}


.menu-item {
    display: flex;
    flex-direction: column;
    justify-content: flex-start; /* Align content at the top */
    height: 180px;
    border-radius: 10px;
    overflow: hidden;
    position: relative;
    box-shadow: 0 0 10px rgba(0,0,0,0.15);
    transition: all 0.3s ease-in-out;
    cursor: pointer;
    animation-delay: 0.5s;
}

.menu-item:hover {
    transform: scale(1.03);
    box-shadow: 0 5px 15px rgba(0,0,0,0.3);
}


.menu-item-content {
    z-index: 1;
    padding: 1em;
    color: rgb(0, 0, 0);
    text-shadow: 1px 1px 3px rgba(0,0,0,0.3);
    animation-delay: 0.8s;
    background-color: rgb(255, 255, 255);
    border:none;
    cursor: pointer;
}

.menu-item-name {
    font-size: 1.25em;
    font-weight: bold;
}

.menu-item-description {
    margin-top: 0.5em;
    animation-delay: 1.1s;
}

.menu-item-price {
    font-size: 1.1em;
    font-weight: bold;
    margin-top: 1em;
    animation-delay: 1.4s;
}
</style>
