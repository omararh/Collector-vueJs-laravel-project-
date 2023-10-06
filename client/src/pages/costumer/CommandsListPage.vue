<template>
    <div class="commands-container">
        <p class="title">Historique des commandes : </p>
        <p>NB : ici on affiche que le montant et la date de la commande</p>
        <div v-for="command in commands" :key="command.id" class="command-item">
            <p class="date-time">{{ new Date(command.created_at).toLocaleString() }}</p>
            <p class="price">{{ command.totalPrice }}€</p>
        </div>
    </div>
</template>


<script>
import{ CommandRepository } from "@/repositories/Command"

export default {
    name: "CommandsListPage",
    data(){
        return {
            commands : [],
        }
    },
    async created(){
        const custumerPhoneNumber = localStorage.getItem("custumerPhoneNumber");
        this.commands = await CommandRepository.getCommandsByUser(custumerPhoneNumber);
    }
}
</script>

<style lang="css" scoped>
.commands-container {
    max-width: 400px;
    margin: 0 auto;
    padding: 20px;
    background-color: #ffffff;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}
.title {
    font-family: fantasy;
    font-size: 20px;
    font-weight: bold;
    color: #333333;
    margin-bottom: 15px;
}

.command-item {
    padding:5px;
    border-radius: 10px;
    background-color: #F8F8F8;
    align-items: space-between;
    margin-bottom: 1em;
    text-align: center;
    height:80px;
}
.price {
    font-size: 18px;
    font-weight: bold;
}
</style>
