 <template>
    <div class="center" id="home">
        <hr>
        <h2 id="loading">
            <span class="white">Latest cryptos</span>
        </h2>
        <vs-table>
            <template #thead>
                <vs-tr>
                    <vs-th> Coin </vs-th>
                    <vs-th> Price </vs-th>
                    <vs-th> 24h </vs-th>
                    <vs-th> Cap </vs-th>
                </vs-tr>
            </template>
            <template #tbody>
                <vs-tr
                    :key="i"
                    v-for="(tr, i) in $vs.getPage(cryptoData, page, max)"
                    :data="tr"
                >
                    <vs-td>
                        <i class="bx bxl-bitcoin btc-color bx-sm"></i>
                        {{ tr.name }} ({{ tr.short }})
                    </vs-td>
                    <vs-td>
                        {{ tr.price }}
                    </vs-td>
                    <vs-td>
                        {{ tr.twenty_four_hour }}%
                    </vs-td>
                    <vs-td>
                        ${{ tr.cap }}
                    </vs-td>
                </vs-tr>
            </template>
            <template #footer>
                <vs-pagination
                    color="primary"
                    v-model="page"
                    :length="$vs.getLength(tableData, max)"
                />
            </template>
        </vs-table>
    </div>
</template>
  
  <script>
export default {
    props: {
        cryptoData: {
            required: true,
        },
    },

    data() {
        return {
            tableData: {},
            page: null,
            max: null,
        };
    },

    mounted() {
        this.loadTableData();
    },

    methods: {
        loadTableData() {
            axios.get("/api/v1/order").then((resp) => {
                this.tableData = resp.data.data;
                this.page = resp.data.meta.current_page;
                this.max = resp.data.meta.total;
                console.log(this.page);
                console.log(this.max);
            });
        },

        mark(id) {
            axios.post("/api/v1/order/" + id + "/mark", {
                status: 1,
            });
        },
    },
};
</script>

<style>
.vs-table__th__content {
    color: white !important;
}

.vs-table__td {
    color: white !important;
}

.vs-table {
    margin-top: 15px !important;
}

.vs-table__td {
    width: 100px;
    align-items: center;
}
#home {
    margin-top: 10px;
}
</style>