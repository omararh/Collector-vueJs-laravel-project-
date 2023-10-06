<template>
    <div class="container">
        <div class="dateInput-container animated fadeInDown">
            <input type="date" class="dateInput animated fadeInUp" v-model="date"/>
            <button class="button" @click="applyChosenDate">APPLIQUER</button>
        </div>
        <p class="total">Totale : {{totalSum}} €</p>
        <div class="commands-container animated fadeIn">
            <div v-for="(item, index) in commands"
                 :key="index"
                 class="command-card"
                 :class="index % 2 === 0 ? 'animated fadeInLeft' : 'animated fadeInRight'">
                <button class="command-card-content">
                    <h2 class="command-card-id">Commande #{{ item.id }}</h2>
                    <div class="command-card-description">
                        <p><span>&#x1F464;</span> {{ item.customerName }}</p>
                        <p><span>&#x1F4DE;</span> {{ item.customerPhoneNumber }}</p>
                        <p><span>&#x1F553;</span> {{ extractHourAndMinute(item.created_at) }}</p>
                        <p class="command-total-price">{{ item.totalPrice }} €</p>
                    </div>
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import { CommandRepository } from '@/repositories/Command'

let currentDate = new Date();
const year = currentDate.getFullYear();
const month = String(currentDate.getMonth() + 1).padStart(2, '0');
const day = String(currentDate.getDate()).padStart(2, '0');
currentDate = `${year}-${month}-${day}`;

export default {
    name:'OrdersHistoryPage', 
    data() {
        return {
          commands:[], 
          date : '',
          totalSum : 0
        }
    },
    created() {
        this.fetchCommands(currentDate);
    },
    methods: {
        extractHourAndMinute(datetime) {
            return datetime.slice(11, 16);
        },
        async fetchCommands(date){
            try {
                const response = await CommandRepository.getCommandsByDate(date);
                this.commands = response.data;
                this.totalSum = this.commands.reduce((acc, command) => acc + command.totalPrice, 0);
            } catch (error) {
                console.error(error);
            }
        }, 
        applyChosenDate() {
            if(!this.date) return;
            this.fetchCommands(this.date);
        }
    }
}
</script>

<style scoped>
@import url('https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css');

.container {
    width: 100%;
    display: block;
}

.dateInput-container {
    display: flex;
    justify-content: center;
}

.dateInput {
    width: 20%;
    padding: 8px;
    font-size: 1.2em;
    border-radius: 25px;
    border: 1px solid #ccc;
    outline: none;
    cursor: pointer;
}

.dateInput:focus {
    border-color: #ea580c;
}

.button {
    margin-top: .5em;
    background-color: #ffffff;
    color: #000000;
    font-size: 15px;
    font-family: fantasy;
    border: none;
    cursor: pointer;
    transition: background-color 0.5s;
}
.button:hover {
    color: #ea580c;
}

.total {
    font-size: 1.1em;
    font-weight: bold;
    margin-top: 1em;
    animation-delay: 1.4s;
    font-size: 1.5em;
    font-family: fantasy;
    margin-left: 1.5em;
    color:red;
    cursor: pointer;
}

.commands-container {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 1em;
    padding: 2em;
    background-color: #ffffff;
    animation-delay: 0.2s;
}

.command-card {
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    border-radius: 10px;
    overflow: hidden;
    position: relative;
    box-shadow: 0 0 10px rgba(0,0,0,0.15);
    transition: all 0.3s ease-in-out;
    cursor: pointer;
    animation-delay: 0.5s;
}

.command-card:hover {
    transform: scale(1.03);
    box-shadow: 0 5px 15px rgba(0,0,0,0.3);
}

.command-card-content {
    color: rgb(0, 0, 0);
    text-shadow: 1px 1px 3px rgba(0,0,0,0.3);
    animation-delay: 0.8s;
    background-color: rgb(255, 255, 255);
    border: none;
    cursor: pointer;
}

.command-card-id {
    font-weight: bold;
    font-family: fantasy;
    color:#ea580c;
}

.command-card-description {
    animation-delay: 1.1s;
    line-height: 0.5em;
}

.command-total-price {
    font-weight: bold;
    animation-delay: 1.4s;
}

</style>