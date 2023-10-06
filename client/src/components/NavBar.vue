<template>
    <nav class="navbar">
        <router-link to="/" class="title">{{ $t("navBar.title") }}</router-link>

        <div class="nav-links">
            <router-link to="/" v-if="!isAdmin" class="navButton">{{ $t("navBar.home") }}</router-link>
            <router-link to="/menu" v-if="!isAdmin" class="navButton">{{ $t("navBar.menu") }}</router-link>
            <router-link to="/basket" v-if="!isAdmin" class="navButton">
                <span class="cart-icon">
                    &#x1F6D2;{{ $t("navBar.cart") }}
                </span>
            </router-link>
            <router-link v-if="!isConnected"  to="/logIn" class="navButton"> 
                <span>
                    &#x1F464; Connexion
                </span>
            </router-link>
            <template v-else>
                <router-link v-if="!isAdmin" to="/commands" class="navButton">
                    Commands
                </router-link>  
                <div v-else>
                    <router-link to="/dashboard" class="navButton">
                        Gestion-commands
                    </router-link> 
                    <router-link to="/dashboard" class="navButton">
                        Gestion-menu
                    </router-link>    
                    <router-link to="/OrdersHistoryPage" class="navButton">
                        Historique-commands
                    </router-link>    
                </div>
                <button  class="navButton" @click="logOut"> 
                    <span>
                        &#x1F464; Deconnexion
                    </span>
                </button>
            </template>

        </div>

    </nav>
</template>
  
<script>
import basketImg from '@/assets/basket.svg';
import { UserRepository } from "@/repositories/User";

export default {
    name: 'NavBar',
    data(){
        return {
            basketImg,
            isConnected : false,
            isAdmin: false,
        }
    },
    async created(){
        this.isConnected = await UserRepository.isConnected();
        this.isAdmin = await UserRepository.isAdmin();
    },
    methods : {
        async logOut() {
            await UserRepository.logOut();
            window.location.reload();
        }
    },
};
</script>


<style lang="css" scoped>
.navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 16px;
    box-shadow: 0 2px 4px #ea580c;
    max-height: 15px;
    margin-bottom: 2em;
}

.title {
    text-decoration: none;
    font-size: 15px;
    font-weight: bold;
    color: #ea580c;
    margin: 0;
    font-family: 'Arial Black', Gadget, sans-serif;
    text-transform: uppercase;
    letter-spacing: 2px;
}

.nav-links {
    display: flex;
    align-items: center;
}

.navButton {
    text-decoration: none;
    padding: 0px 8px;
    border: none;
    cursor: pointer;
    font-size: 16px;
    color: #000000;
    font-family: fantasy;
    font-weight: bold;
    transition: color 0.5s;
    background-color: white;
}

.navButton:hover {
    color: #ea580c;
}

.cart-icon {
    transition: transform 0.3s ease;
    padding: 10px;
}
</style>