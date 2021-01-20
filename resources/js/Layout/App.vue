<template>
    <div id="main">
        <Menu></Menu>
        <router-view></router-view>
    </div>
</template>

<script>
    import Menu from '../Components/Menu.vue'
    export default {
        mounted() {
            console.log('Component mounted.')
        },

        components: {
            Menu
        }
    }
</script>
