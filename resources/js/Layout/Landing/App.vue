<template>
    <div id="main">
		<router-view></router-view>
    </div>
</template>

<script>
    import Menu from '../../Components/Menu.vue'
    export default {
        mounted() {
        },

        components: {
            Menu,
        }
    }
</script>
