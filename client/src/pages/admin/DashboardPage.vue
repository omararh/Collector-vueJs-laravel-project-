<template>
    <div class="container">
        <div v-for="command in activeCommands" :key="command.id" class="command-card">
            <h2 class="command-title">Commande #{{ command.id }}</h2>
            <div class="command-details">
                <div class="left-col">
                    <p><strong>Nom du client :</strong> {{ command.customerName }}</p>
                    <p><strong>Numéro de téléphone :</strong> {{ command.customerPhoneNumber }}</p>
                    <p><strong>Produits :</strong> {{ command.productIds }}</p>
                    <p><strong>Instructions spécifiques :</strong> {{ command.specificInstructions }}</p>
                </div>
                <div class="right-col">
                    <p><strong>Temps de préparation :</strong> {{ command.preparationTime }} minutes</p>
                    <p><strong>Prix total :</strong> {{ command.totalPrice }} €</p>
                    <p><strong>Date de création :</strong> {{ new Date(command.created_at).toLocaleString() }}</p>
                    <button class="button">Désactiver</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { CommandRepository } from '@/repositories/Command';

export default {
    name: "DashboardPage",
    data() {
        return {
            activeCommands : []
        }
    },
    async created() {
        try {
                this.activeCommands = await CommandRepository.getActiveCommands();
            } catch (error) {
            console.error(error);
        }
    },
}
</script>

<style scoped>
.container {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 20px;
    background-color: white;
}

.command-card {
    width: 80%;
    background-color: #fff;
    border-radius: 15px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
    margin: 20px 0;
    transition: transform 0.3s;
}

.command-card:hover {
    transform: scale(1.01);
}

.command-title {
    font-size: 24px;
    margin-bottom: 20px;
    text-align: center;
    color: #333;
    font-family: fantasy;
}

.command-details {
    display: flex;
    justify-content: space-between;
    border: solid 1px #ccc;
    padding: 10px;
    border-radius: 10px;
}

.command-details .left-col, .command-details .right-col {
    width: 45%;
}

.command-details p {
    font-family: fantasy;
    margin: 10px 0;
    color: #555;
}

.command-details p strong {
    color: #000;
}

.button {
    text-decoration: none;
    display: block;
    width: 100px;
    padding: 5px;
    background-color: red; 
    color: #ffffff; 
    font-size: 18px; 
    border: none; 
    border-radius: 5px; 
    cursor: pointer; 
    transition: background-color .5s; 
    text-align: center; 
    font-family: fantasy;

}
.button:hover{
    background-color:black;
}
</style>