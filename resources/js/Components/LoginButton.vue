<template>
    <div class="center" dark>
        <vs-button @click="active = !active" flat> Login </vs-button>
        <vs-dialog v-model="active">
            <template #header>
                <h4 class="not-margin white">Welcome to <b>CoinPhon</b></h4>
            </template>

            <div class="con-form">
                <div class="container fluid">
                    <vs-input
                        v-model="email"
                        placeholder="Email"
                        color="primary"
                    >
                        <template #icon> @ </template>
                    </vs-input>
                    <vs-input
                        type="password"
                        color="primary"
                        v-model="password"
                        placeholder="Password"
                    >
                        <template #icon>
                            <i class="bx bxs-lock"></i>
                        </template>
                    </vs-input>
                    <div class="flex">
                        <vs-checkbox v-model="remember"
                            >Remember me</vs-checkbox
                        >
                        <a href="#">Forgot Password?</a>
                    </div>
                </div>
            </div>

            <template #footer dark>
                <div class="footer-dialog">
                    <vs-button block @click="login"> Sign In </vs-button>

                    <div class="new">
                        New Here? <a href="#">Create New Account</a>
                    </div>
                </div>
            </template>
        </vs-dialog>
    </div>
</template>


<script>
export default {
    data: () => ({
        active: false,
        email: "",
        password: "",
        remember: false,
    }),

    methods: {
        login() {
            var data = {
                email: this.email,
                password: this.password,
            };

            axios.post("/api/v1/auth/login", data).then((resp) => {
                console.log(resp);
                this.$vs.notification({
                    flat: true,
                    color: 'primary',
                    icon: `<i class='bx bxs-user'></i>`,
                    position: "top-center",
                    title: "Authentication",
                    text: `Successfully logged in as ${resp.data.data.first}`,
                });
            });
        },
    },
};
</script>

<style>
.vs-dialog {
    background-color: #1e2023 !important;
}

.vs-input {
    width: 100%;
    margin-bottom: 5px;
}

.vs-input {
    width: 100%;
    margin-bottom: 5px;
}
</style>

<style scoped>
h4 {
    color: white;
}
</style>