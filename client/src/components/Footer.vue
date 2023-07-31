<template>
    <div class="footer">
        <a href="https://www.facebook.com/Cristiano" target="_blank">
            <img :src="facebook" alt="Facebook" class="social-icon" />
        </a>
        <a href="https://www.instagram.com/cristiano/" target="_blank">
            <img :src="instagram" alt="Instagram" class="social-icon" />
        </a>
        <div class="phone" @click="showPhone">
            <img :src="phone" alt="Phone" class="social-icon" />
            <div v-if="phoneVisible" class="alert">
                <button @click.stop="closeAlert" class="close-btn">X</button>
                {{ $t("footer.phoneNumber") }}
            </div>
        </div>
    </div>
</template>

<script>
import facebook from '@/assets/facebook.svg';
import instagram from '@/assets/instagram.svg';
import phone from '@/assets/phone.svg';

export default {
    name: "FooterComponent",
    data() {
        return {
            facebook,
            instagram,
            phone,
            phoneVisible: false,
        }
    },
    methods: {
        showPhone() {
            this.phoneVisible = true;
        },
        closeAlert() {
            this.phoneVisible = false;
        }
    }
}
</script>

<style lang="css">
@keyframes fadeIn {
    0% {
        opacity: 0;
    }

    100% {
        opacity: 1;
    }
}


.footer {
    display: flex;
    justify-content: center;
    gap: 10px;

    animation-name: fadeIn;
    animation-duration: 2s;
    animation-delay: 1.5s;
    animation-fill-mode: both;

}

.social-icon {
    width: 30px;
    height: 30px;
    cursor: pointer;
}

.phone {
    position: relative;
    display: flex;
    align-items: center;
    gap: 5px;
}

.alert {
    position: absolute;
    top: -20px;
    left: 30px;
    padding: 1em;
    border: none;
    background-color: rgb(255, 255, 255);
    color: darkred;
    text-align: center;
}

.close-btn {
    position: absolute;
    top: 0;
    right: 0;
    border: none;
    background: transparent;
    font-size: .8em;
    cursor: pointer;
}

@media only screen and (max-width: 500px) {
    .footer {
        align-items: center;
        gap: 20px;
    }
}
</style>
