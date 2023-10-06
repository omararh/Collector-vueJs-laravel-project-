<template>
  <NavBar />
  <router-view></router-view>
</template>

<script>
import httpClient from "@/services/httpClient";
import NavBar from '@/components/NavBar.vue';

export default {
  name: 'App',
  components: {
    NavBar,
  },
  created() {
      const token = localStorage.getItem('jwtToken');
      if (token) {
        httpClient.axiosInstance.defaults.headers.common['Authorization'] = `Bearer ${token}`;
      }
  }
}
</script>

<style>

</style>
