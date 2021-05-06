<template>
    <div class="hidden">
        <Navbar></Navbar>
        <vs-sidebar
            absolute
            hover-expand
            reduce
            background="#1e2023"
            textWhite
            v-model="active"
            open
        >
            <template #logo>
                <img
                    src="/CoinPhone/Logo/128h/coinphon-mono.png"
                    class="img-responsive"
                    alt=""
                />
            </template>
            <vs-sidebar-item to="home" id="home">
                <template #icon>
                    <i class="bx bx-user"></i>
                </template>
                Home
            </vs-sidebar-item>
            <vs-sidebar-item to="orders" id="orders">
                <template #icon>
                    <i class="bx bx-cart-alt"></i>
                </template>
                Orders
            </vs-sidebar-item>
            <vs-sidebar-item to="wallet" id="wallet">
                <template #icon>
                    <i class="bx bx-wallet"></i>
                </template>
                Wallet
            </vs-sidebar-item>
            <vs-sidebar-item to="developer" id="developer">
                <template #icon>
                    <i class="bx bxl-dev-to"></i>
                </template>
                Developer
            </vs-sidebar-item>
            <template #footer> meow </template>
        </vs-sidebar>
    </div>
</template>


<script>
import Navbar from "./Navbar";

export default {
    data: () => ({
        active: "home",
    }),
    watch: {
        "$route.name": {
            handler: function (val) {
                this.active = val;
                console.log(val);
            },
            deep: true,
            immediate: true,
        },
    },
    method: {
        changeActiveRoute: function () {
            console.log(val);
        },
    },
    components: {
        Navbar,
    },
};
</script>

<style scoped>
    .vs-navbar{
        margin-top: 100px;
    }
</style>