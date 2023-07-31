<template>
    <nav class="navbar">
        <router-link to="/" class="title">{{ $t("navBar.title") }}</router-link>

        <div class="nav-links">
            <router-link to="/" class="navButton">{{ $t("navBar.home") }}</router-link>
            <router-link to="/menu" class="navButton">{{ $t("navBar.menu") }}</router-link>
            <router-link to="/contact" class="navButton">{{ $t("navBar.contact") }}</router-link>
        </div>

    </nav>
</template>
  
<script>

export default {
    name: 'NavBar',
};
</script>


<style lang="css" scoped>
.navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 16px;
    box-shadow: 0 2px 4px #ea580c;
    max-height: 15px;
}

.title {
    text-decoration: none;
    font-size: 15px;
    font-weight: bold;
    color: #ea580c;
    margin: 0;
    font-family: 'Arial Black', Gadget, sans-serif;
    text-transform: uppercase;
    letter-spacing: 2px;
}

.nav-links {
    display: flex;
    align-items: center;
}

.navButton {
    text-decoration: none;
    padding: 0px 8px;
    border: none;
    cursor: pointer;
    font-size: 16px;
    color: #101010;
    font-family: Didot, serif;
    font-weight: bold;
    transition: color 0.5s;
    letter-spacing: 1px;
}

.navButton:hover {
    color: #ea580c;
}
</style>