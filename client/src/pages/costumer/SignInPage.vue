<template>
    <div class="signIn-container">
        <div class="content">
            <div class="text-content">
                <h2 class="title">Inscription</h2>
                <form @submit.prevent="submitForm">
                    <div class="input-container">
                        <input class="name-input" type="text" placeholder="Nom" v-model="name" maxlength="11" required/>
                        <p v-if="errors.name" class="error">{{ errors.name }}</p>

                        <input class="phone-input" type="tel" placeholder="Numéro de téléphone" v-model="phoneNumber" required/>
                        <p v-if="errors.phoneNumber" class="error">{{ errors.phoneNumber }}</p>

                        <input class="email-input" type="text" v-model="email" placeholder="Email" required />
                        <p v-if="errors.email" class="error">{{ errors.email }}</p>

                        <input class="password-input" type="password" placeholder="Mot de passe" v-model="password" required/>
                        <p v-if="errors.password" class="error">{{ errors.password }}</p>

                        <input class="confirm-password-input" type="password" placeholder="Confirmer le mot de passe" v-model="confirmPassword" required/>
                        <p v-if="errors.confirmPassword" class="error">{{ errors.confirmPassword }}</p>

                        <button class="button" @click="register">S'inscrire</button>

                        <p v-if="errors.outPut" class="error">{{ errors.outPut }}</p>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <Footer/>
</template>

<script>
import { UserRepository } from "@/repositories/User";
import Footer from '@/components/Footer.vue'


const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
const passwordRegex = /^(?=.*[0-9])(?=.*[!@#$%^&*])(?=.*[A-Z])[a-zA-Z0-9!@#$%^&*]{6,16}$/;
const phoneNumberRegex = /^(0|\+33)[1-9]([-. ]?[0-9]{2}){4}$/;

export default {
    name: "SignInPage",
    components: {
        Footer
    },
    data() {
        return {
            name: "",
            phoneNumber: "",
            email: "",
            password: "",
            confirmPassword: "",
            errors: {
                name: null,
                phoneNumber: null,
                email: null,
                password: null,
                confirmPassword: null,
                outPut:null
            }
        };
    },
    computed: {
        allFieldsValid() {
            return !this.errors.name && !this.errors.phoneNumber && !this.errors.email && !this.errors.password && !this.errors.confirmPassword;
        }
    },
    methods: {
        async register() {
            this.validateName();
            this.validatePhoneNumber();
            this.validateEmail();
            this.validatePassword();
            this.validateConfirmPassword();

            if (this.allFieldsValid) {
                try {
                    const responseData = await UserRepository.signIn(this.name,
                                        this.phoneNumber,
                                        this.email,
                                        this.password, 
                                        this.confirmPassword
                                        );
                    console.log(" response ? ", responseData.status);
                    if (responseData.status === 'error') {
                        this.errors.outPut = responseData.message;  
                        return;
                    }
                    this.$router.push({ name: 'LogInPage' });
                }catch(error){
                    console.error("Erreur lors de l'inscription:", error);
                    this.errors.outPut = "Une erreur s'est produite lors de l'inscription.";
                }
            }
        },
        validateName() {
            if(!this.name){
                this.errors.name = "Le nom est requis.";
            }else{
                this.errors.name = null;
            }
        },
        validatePhoneNumber() {
            if (!this.phoneNumber) {
                this.errors.phoneNumber = "Le numéro de téléphone est requis.";
            } else if (!phoneNumberRegex.test(this.phoneNumber)) {
                this.errors.phoneNumber = "Le numéro de téléphone n'est pas valide.";
            }else{
                this.errors.phoneNumber = null;
            }
        },
        validateEmail() {
            if (!this.email) {
                this.errors.email = "L'email est requis.";
            } else if (!emailRegex.test(this.email)) {
                this.errors.email = "L'email n'est pas valide.";
            }else{
                this.errors.email = null;
            }
        },
        validatePassword() {
            if (!this.password) {
                this.errors.password = "Le mot de passe est requis.";
            } else if (!passwordRegex.test(this.password)) {
                this.errors.password = "Le mot de passe doit contenir au moins un chiffre, un caractère spécial, une lettre minuscule et majuscule, avec une longueur comprise entre 6 et 16 caractères inclus.";
            }else{
                this.errors.password = null;
            }
        },
        validateConfirmPassword() {
            if (this.password !== this.confirmPassword) {
                this.errors.confirmPassword = 'Le mot de passe et la confirmation du mot de passe ne correspondent pas.';
            }else{
                this.errors.confirmPassword = null;
            }
        }
    }
};
</script>

<style lang="css" scoped>
@import url('https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css');


.signIn-container {
    display: flex;
    align-items: center;
    justify-content: center;    
    background-color: #ffffff;
}

.title {
    font-size: 42px;
    font-family: fantasy;
}


.content {
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    max-width: 600px;
    width: 100%;
    padding: 60px;
    margin-bottom: 1em;
}

.text-content {
    display: flex;           
    flex-direction: column;  
    justify-content: center; 
    align-items: center;     
}

input {
    width: 450px;
    padding: 10px 15px;
    margin-bottom: 10px;
    border: 1px solid #e1e4e8;
    border-radius: 5px;
    font-size: 16px;
    color: #24292e;
    outline: none;
    transition: border-color 0.3s;
}

input:focus {
    border-color: #0366d6;
}

.input-container {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

.button {
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

.button:hover {
    background-color: #34495e;
}

.error {
    color: red;
    width: 400px;
}

</style>
