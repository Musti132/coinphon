<template>
    <div id="main">
        <Menu></Menu>

        <div class="container-fluid">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
import Menu from "../../Components/Menu.vue";
export default {
    mounted() {
        this.$vs.setTheme("dark");
    },

    components: {
        Menu,
    },
};
</script>

<style scoped>
.container-fluid {
    margin-top: 125px;
    max-width: 95em;
}
</style>
