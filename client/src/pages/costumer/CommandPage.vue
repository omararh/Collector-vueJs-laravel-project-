<template>
    <div class="command-container">
        <p class="instructions-title">Instructions spécifiques</p>
        <textarea v-model="instructions" placeholder="Instructions spécifiques ..."></textarea>
        <button @click="confirmOrder" class="confirm-btn">Confirmer ma commande</button>
        <popUp v-if="showPopup" :message="popupMessage" :toHomePage="true" :error="ifError"></popUp>
    </div>
</template>

<script>
import{ CommandRepository } from "@/repositories/Command";
import PopUp from '@/components/PopUp';

export default {
    name: "CommandPage",
    data() {
        return {
            instructions: "",
            showPopup: false,
            popupMessage: "", 
            ifError: false,
        };
    },
    components : {
        PopUp
    },
    methods: {
        async confirmOrder() {
            const productIds = localStorage.getItem('ids');
            const custumerName = localStorage.getItem('custumerName');
            const custumerPhoneNumber = localStorage.getItem('custumerPhoneNumber');
            const preparationTime = 20;
            const priceString = localStorage.getItem('price');
            const totalPrice = parseInt(priceString, 10);
            try {
                const response = await CommandRepository.store(productIds, custumerName, custumerPhoneNumber, preparationTime, this.instructions, totalPrice);
                if(response){
                    this.popupMessage = "Commande confirmée. Vous pouvez venir la récupérer dans 20 min.";
                    return;
                } 
                    this.popupMessage = "La commande n'a pas été passée, Êtes-vous connecté ? Votre session a peut etre expiré.";
                    this.ifError = true;
            } catch(error) {
                console.error(error.message);
                this.popupMessage = "Une erreur s'est produite. Veuillez réessayer.";
                this.ifError = true;
            } finally {
                this.showPopup = true;
            }
        }
    }
}
</script>

<style lang="css" scoped>
.command-container {
    max-width: 400px;
    margin: 0 auto;
    padding: 20px;
    background-color: #ffffff;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.instructions-title {
    font-family: fantasy;
    font-size: 20px;
    font-weight: bold;
    color: #333333;
    margin-bottom: 15px;
}

.confirm-btn {
    display: block;
    width: 220px;
    padding: 10px;
    background-color: #4CAF50;
    color: #ffffff;
    font-size: 18px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color .5s;
    margin-top: 10px;
    text-align: center;
    margin-left: auto;
    margin-right: auto;
    display: block;
    font-family: fantasy;

}

.confirm-btn:hover {
    background-color: #000000;
}

textarea {
    width: 80%;
    height: 100px;
    padding: 10px;
    border-radius: 5px;
    border: 1px solid #ccc;
    resize: none; /* Empêche le redimensionnement */
    margin-left: auto;
    margin-right: auto;
    display: block;

}
</style>
