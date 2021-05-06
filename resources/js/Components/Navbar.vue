<template>
    <div class="center">
        <vs-navbar center-collapsed shadow padding-scroll color="#1e2023" textWhite>
            <template #left>
                <img src="/logo2.png" alt="" />
            </template>
            <template #right>
                <LoginButton></LoginButton>
            </template>
        </vs-navbar>
    </div>
</template>
<script>
import LoginButton from "./LoginButton";
export default {
    components: {
        LoginButton
    }
};
</script>