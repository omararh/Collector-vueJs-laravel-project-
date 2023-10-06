    <template>
        <div class="container">
            <div v-for="item in items" :key="item.id" class="item">
                <p>{{ item.name }}</p>
                <p>Temps de préparation: {{ item.preparationTime }} mins</p>
                <p>Quantité: {{ item.quantity }}</p>
                <p>Prix: {{ item.price }} €</p>
                <button @click="removeItem(item.id)" class="remove-btn">
                    Supprimer
                </button>
            </div>

            <div class="total-price">
                <p>Prix total: {{ totalPrice.toFixed(2) }} €</p>
            </div>

            <button class="command-btn" @click="next"> 
                Suivant
            </button>
        </div>
    </template>

    <script>
    import { MenuRepository } from '@/repositories/Menu';

    export default {
        name: 'basketPage',
        data() {
            return {
                items: []
            };
        },
        async created() {
            let ids = localStorage.getItem('ids');
            ids = ids ? JSON.parse(ids) : [];

            let cartItems = {};

            ids.forEach((id) => {
                if (cartItems[id]) {
                    cartItems[id].quantity += 1;
                } else {
                    cartItems[id] = {
                        quantity: 1
                    };
                }
            });

            // Boucle sur l'objet cartItems
            for (const id in cartItems) {
                try {
                    const response = await MenuRepository.getByID(id);
                    const itemData = response.data;
                    itemData.quantity = cartItems[id].quantity; // Ajout de la quantité à l'objet
                    this.items.push(itemData);
                } catch (error) {
                    console.error(error);
                }
            }
        },
        computed : {
            totalPrice() {
                return this.items.reduce((total, item) => total + item.price * item.quantity, 0);
            }
        },
        methods: {
            removeItem(itemId) {
                // Supprimer l'élément de la liste
                this.items = this.items.filter(item => item.id !== itemId);

                // Supprimer les IDs correspondants du stockage local
                let ids = localStorage.getItem('ids');
                ids = ids ? JSON.parse(ids) : [];
                ids = ids.filter(id => id !== itemId);
                localStorage.setItem('ids', JSON.stringify(ids));
            },
            next(){
                if(this.items.length > 0) {
                    console.log(this.totalPrice)
                    localStorage.setItem('price', this.totalPrice);
                    this.$router.push('/command');
                } 
            }
        }
    };
    </script>

    <style lang="css" scoped>

    .container {
        max-width: 350px;
        margin: 0 auto;
        padding: 20px;
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .item {
        padding: 20px;
        margin: 15px 0;
        background-color: #ffffff;
        border-radius: 5px;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        cursor: pointer;
    }

    .item p {
        font-size: 18px;
        margin: 10px 0;
        color: #333;
    }

    .item p:nth-child(1) {
        font-weight: 600;
    }
    .item p:nth-child(5) {
        font-size: 20px;
        font-weight: bold;
    }

    .remove-btn {
        padding: 5px 10px;
        background-color: #000000;
        color: #ffffff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
        font-family: fantasy;
    }

    .remove-btn:hover {
        background-color: #c0392b;
    }


    .total-price {
        text-align: center; /* Centre le texte horizontalement */
        font-weight: bold;   /* Rend le texte en gras */
        font-size: 20px;     /* Augmente la taille de la police */
        padding: 15px;       /* Ajoute un peu de rembourrage autour du prix total */
        margin-top: 20px;    /* Ajoute une marge en haut pour séparer du reste du contenu */
        border-top: 1px solid #eaeaea; /* Ajoute une ligne de séparation */
    }

    .command-btn {
        text-decoration: none;
        margin-left: auto;
        margin-right: auto;
        display: block;
        width: 100px;
        padding: 5px;
        background-color: #4CAF50; /* Couleur de fond */
        color: #ffffff; /* Couleur du texte */
        font-size: 18px; /* Taille du texte */
        border: none; /* Pas de bordure */
        border-radius: 5px; /* Bordures arrondies */
        cursor: pointer; /* Curseur en forme de main */
        transition: background-color .5s; /* Transition en douceur */
        text-align: center; 
        font-family: fantasy;
    }
    
    .command-btn:hover {
        background-color: #000000; /* Couleur de fond au survol */
    }
    

    </style>
