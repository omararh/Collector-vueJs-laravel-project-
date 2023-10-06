<template>
    <div class="login-container">
        <div class="content">
            <div class="text-content">
                <form @submit.prevent="submitForm">
                    <div class="input-container animated fadeInRight">
                        <h2 class="title animated fadeInLeft">Connexion</h2>
                        <input class="email-input" type="text" v-model="form.email" placeholder="Email" required />
                        <p v-if="errors.email" class="error">{{ errors.email }}</p>
                        
                        <input class="password-input" type="password" v-model="form.password" placeholder="Mot de passe" required />
                        <p v-if="errors.password" class="error">{{ errors.password }}</p>
                        
                        <button type="submit" class="submit-button">Se connecter</button>

                        <p v-if="errors.outPut" class="error">{{ errors.outPut }}</p>

                        <router-link class="link" to="/signIn">Créer nouveau compte</router-link>
                    </div>
                </form>
            </div>

            <router-link to="/signIn">
                <div class="image-content animated fadeInRight">
                    <img :src="chefAvatar" alt="Chef Avatar" />
                </div>
            </router-link>
        </div>
    </div>
</template>

<script>
import chefAvatar from "@/assets/chef-2.png";
import { UserRepository } from "@/repositories/User";

export default {
    name: "LogInPage",
    data() {
        return {
            chefAvatar,
            form: {
                name : '',
                email: ''
            },
            errors: {
                name: null,
                email: null,
                outPut : null,
            }
        }
    },
    methods: {
        async submitForm() {

            if (!this.form.email) {
                this.errors.email = "L'email est requis.";
            } else if (!this.isValidEmail(this.form.email)) {
                this.errors.email = "L'email n'est pas valide.";
            }else{
                this.errors.email = null;
            }

            if (!this.form.password) {
                this.errors.password = "Le mot de passe est requis.";
            } else if (!this.isValidPassword(this.form.password)) {
                this.errors.password = "Le mot de passe doit contenir au moins un chiffre, un caractère spécial, une lettre miniscule et majuscule, avec une longueur comprise entre 6 et 16 caractères inclus.";
            }else {
                this.errors.password = null;
            }

            if (!this.errors.email && !this.errors.password) {
                const loginSuccessful = await UserRepository.logIn(this.form.email, this.form.password);

                if (loginSuccessful) {
                    await this.$router.push({ name: 'MenuPage' });
                    window.location.reload();
                } else {
                    this.errors.outPut = "email ou mot de passe incorrecte !";
                }
            }
        },
        isValidEmail(email) {
            const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            return emailRegex.test(email);
        },
        isValidPassword(password) {
            var passwordRegex = /^(?=.*[0-9])(?=.*[!@#$%^&*])(?=.*[A-Z])[a-zA-Z0-9!@#$%^&*]{6,16}$/;
            return passwordRegex.test(password);
        }
    }
}
</script>


<style lang="css" scoped>
@import url('https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css');

.login-container {
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 2em;
}

.content {
    display: flex; /* Ajout de flexbox */
    align-items: start; /* Alignement vertical au début (haut) */
    justify-content: space-between; /* Espacement entre les éléments */
    max-width: 1200px;
    margin-bottom : 3em;
}
.title {
    font-family: fantasy;
    font-size: 42px;
}

.text-content {
    width: 60%;
    margin-left: 5em;
}

.input-container{
    max-width: 400px;

    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    padding: 30px;
    margin-bottom: 1em;
}

.email-input, .password-input {
    width: 75%;
    padding: 0.8em;
    margin: 0.5em 0;
    border: 1px solid #7f8c8d;
    border-radius: 5px;
    font-size: 1em;
    color: #34495e;
    outline: none;
}



input:focus {
    border-color: #0366d6;
}

.signIn-btn {
    text-decoration: none;
    padding: 0px 8px;
    border: none;
    cursor: pointer;
    font-size: 16px;
    color: #000000;
    font-family: fantasy;
    font-weight: bold;
    transition: color 0.5s;
}

.signIn-btn:hover {
    color: #ea580c;
}

.submit-button {
    margin-top: 1em;
    width: 150px;
    padding: 8px;
    background-color: #000000;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 18px;
    font-family: fantasy;
    color: #fff;
    transition: background-color 0.3s;
}

.submit-button:hover {
    background-color: #34495e;
}

.image-content {
    width: 90%;
    animation-delay: .5s;
}

.image-content img {
    width: 100%;
    height: auto;
}

.error {
    color: red;
    width: 400px;
}

.link {
    display: flex;
    margin-top: 2em;
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

.link:hover {
    color: #ea580c;
}

</style>