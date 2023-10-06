<template>
    <div v-if="visible" :class="['popup-alert', error ? 'error' : 'success']">
      {{ message }}
    </div>
  </template>
  
  <script>
  export default {
    props: {
      message: {
        type: String,
        required: true
      },
      duration: {
        type: Number,
        default: 3
      }, 
      toHomePage: {
        type: Boolean,
        default: false
      }, 
      error: {
        type: Boolean,
        default: false
      }
    },
    data() {
      return {
        visible: false
      };
    },
    methods: {
    show() {
        this.visible = true;
        setTimeout(async () => {
        this.visible = false;
        if(this.toHomePage) {
            await this.$router.push({ name: 'homePage' });
        }
        }, this.duration * 1500);
    }
    },
    mounted() {
      this.show();
    }
  };
  </script>
  
  <style scoped>
  .popup-alert {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translateX(-50%);
    padding: 15px 30px;
    border-radius: 5px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    z-index: 1000;
  }
  .popup-alert.success {
    background-color: #36f443;
    color: rgb(0, 0, 0);
  }
  .popup-alert.error {
    background-color: #f44336;
    color: rgb(255, 255, 255);
  }
  </style>
  