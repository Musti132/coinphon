<template>
    <div class="center grid">
        <vs-row>
            <vs-col vs-type="flex" vs-justify="center" vs-align="center" w="4">
                <vs-card>
                    <template #title>
                        <h3>
                            Current balance
                            <i class="bx bxl-bitcoin btc-color"></i>
                        </h3>
                    </template>
                    <template #text>
                        <p>${{ revenue_fiat }} ({{ revenue_crypto }} BTC)</p>
                    </template>
                </vs-card>
            </vs-col>
            <vs-col vs-type="flex" vs-justify="center" vs-align="center" w="4">
                <vs-card>
                    <template #title>
                        <h3>
                            Balance change (24h)
                            <i class="bx bxs-dollar-circle success"></i>
                        </h3>
                    </template>
                    <template #text>
                        <p>${{ balance_change }}</p>
                    </template>
                </vs-card>
            </vs-col>
            <vs-col vs-type="flex" vs-justify="center" vs-align="center" w="4">
                <vs-card>
                    <template #title>
                        <h3>
                            Order Volume change (24h)
                            <i class="bx bxs-shopping-bag-alt primary"></i>
                        </h3>
                    </template>
                    <template #text>
                        <p>
                            {{ volume_change }}%
                        </p>
                    </template>
                </vs-card>
            </vs-col>
        </vs-row>
        <HomeCryptoTable v-bind:cryptoData="cryptoData"></HomeCryptoTable>
    </div>
</template>

<script>
import HomeCryptoTable from "../Components/HomeCryptoTable";

export default {
    data() {
        return {
            cryptoData: {},
            revenue_fiat: null,
            revenue_crypto: null,
            balance_change: null,
            volume_change: null,
        };
    },

    components: {
        HomeCryptoTable,
    },

    mounted() {
        this.loadRevenue();
    },

    methods: {
        loadRevenue() {
            axios.get("/api/v1/dashboard").then((resp) => {
                this.cryptoData = resp.data.data.price_chart.coins;
                this.balance_change = resp.data.data.balance_change;
                this.volume_change = resp.data.data.volume_change;
                this.revenue_fiat = resp.data.data.total_balance_fiat;
                this.revenue_crypto = resp.data.data.total_balance;
            });
        },
    },
};
</script>