<template>
    <div class="div">
        <div class="content-header">
            <h1>
                {{ trans('contacts.title.contacts') }}
            </h1>
            <el-breadcrumb separator="/">
                <el-breadcrumb-item>
                    <a href="/backend">{{ trans('core.breadcrumb.home') }}</a>
                </el-breadcrumb-item>
                <el-breadcrumb-item :to="{ name: 'admin.contact.contact.index' }">
                    {{ trans("contacts.title.contacts") }}
                </el-breadcrumb-item>
            </el-breadcrumb>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="sc-table">
                            <div class="tool-bar el-row" style="padding-bottom: 20px;">
                                <div class="search el-col el-col-5">
                                    <el-input v-model="searchQuery" prefix-icon="el-icon-search"
                                        @keyup.native="performSearch"></el-input>
                                </div>
                            </div>

                            <el-table ref="pageTable" v-loading.body="tableIsLoading" :data="data" stripe
                                style="width: 100%" @sort-change="handleSortChange" :key="tableKey">
                                <el-table-column prop="id" label="Id" width="75" sortable="custom"></el-table-column>
                                <el-table-column :label="trans('contacts.table.contact_code')" prop="contact_code">
                                    <template slot-scope="scope">
                                        <a :href="editRoute(scope)" @click.prevent="goToEdit(scope)">
                                            {{ scope.row.contact_code }}
                                        </a>
                                    </template>
                                </el-table-column>
                                <el-table-column :label="trans('contacts.table.contact_name')" prop="contact_name">
                                    <template slot-scope="scope">
                                        {{ scope.row.contact_name }}
                                    </template>
                                </el-table-column>
                                <el-table-column :label="trans('contacts.table.contact_title')" prop="contact_title">
                                    <template slot-scope="scope">
                                        <p style="text-align: justify; word-break: normal; white-space: normal;">
                                            {{ scope.row.contact_title }}
                                        </p>
                                    </template>
                                </el-table-column>
                                <el-table-column :label="trans('contacts.table.phone_number')" prop="phone_number">
                                    <template slot-scope="scope">
                                        {{ scope.row.phone_number }}
                                    </template>
                                </el-table-column>
                                <el-table-column :label="trans('contacts.table.categories title')" prop="categories.title">
                                    <template slot-scope="scope">
                                        {{ scope.row.categories.title }}
                                    </template>
                                </el-table-column>
                                <el-table-column :label="trans('contacts.table.email')" prop="email">
                                    <template slot-scope="scope">
                                        {{ scope.row.email }}
                                    </template>
                                </el-table-column>
                                <el-table-column :label="trans('contacts.table.status')" prop="status">
                                    <template slot-scope="scope">
                                        <div :class="scope.row.status" style="width: max-content;">
                                            {{ trans('contacts.table.' + scope.row.status) }}
                                        </div>
                                    </template>
                                </el-table-column>
                                <el-table-column :label="trans('core.table.created at')" prop="created_at"
                                    sortable="custom">
                                </el-table-column>
                            </el-table>
                            <div class="pagination-wrap" style="text-align: center; padding-top: 20px;">
                                <el-pagination :current-page.sync="meta.current_page"
                                    :page-sizes="[10, 20, 30, 50, 100]" :page-size="parseInt(meta.per_page)"
                                    :total="meta.total" layout="total, sizes, prev, pager, next, jumper"
                                    @size-change="handleSizeChange"
                                    @current-change="handleCurrentChange"></el-pagination>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from "axios";
    import debounce from "lodash/debounce";
    import ShortcutHelper from "../../../../../Core/Assets/js/mixins/ShortcutHelper";
    import DeleteButton from "../../../../../Core/Assets/js/components/DeleteComponent.vue";
    import EditButton from "../../../../../Core/Assets/js/components/EditButtonComponent.vue";

    let data;

    export default {
        components: { DeleteButton, EditButton },
        mixins: [ShortcutHelper],
        data() {
            return {
                data: [],  // Initialize as empty array instead of undefined
                meta: {
                    current_page: 1,
                    per_page: 30,
                },
                order_meta: {
                    order_by: "",
                    order: "",
                },
                links: {},
                searchQuery: "",
                tableIsLoading: false,
                tableKey: 0, // Add table key for forcing re-render
            };
        },
        mounted() {
            this.fetchData();
        },
        methods: {
            queryServer(customProperties) {
                const properties = {
                    page: this.meta.current_page,
                    per_page: this.meta.per_page,
                    order_by: this.order_meta.order_by,
                    order: this.order_meta.order,
                    search: this.searchQuery,
                };

                this.tableIsLoading = true;

                axios.get(route("api.contact.contact.indexServerSide", { ...properties, ...customProperties }))
                    .then((response) => {
                        // Clear existing data first
                        this.data = [];
                        this.$nextTick(() => {
                            // Update data in next tick
                            this.data = response.data.data.map(item => ({
                                ...item,
                            }));
                            this.meta = response.data.meta;
                            this.links = response.data.links;
                            this.order_meta.order_by = properties.order_by;
                            this.order_meta.order = properties.order;
                            this.tableKey += 1; // Increment key to force table re-render
                            this.tableIsLoading = false;
                        });
                    })
                    .catch(error => {
                        console.error('Error fetching data:', error);
                        this.tableIsLoading = false;
                    });
            },
            fetchData() {
                this.tableIsLoading = true;
                this.queryServer();
            },
            handleSizeChange(event) {
                console.log(`per page :${event}`);
                this.data = []; // Clear data before changing page size
                this.tableIsLoading = true;
                this.queryServer({ per_page: event });
            },
            handleCurrentChange(event) {
                console.log(`current page :${event}`);
                this.data = []; // Clear data before changing page
                this.tableIsLoading = true;
                this.queryServer({ page: event });
            },
            handleSortChange(event) {
                console.log("sorting", event);
                this.data = []; // Clear data before sorting
                this.tableIsLoading = true;
                this.queryServer({ order_by: event.prop, order: event.order });
            },
            performSearch: debounce(function (query) {
                console.log(`searching:${query.target.value}`);
                this.data = []; // Clear data before searching
                this.tableIsLoading = true;
                this.queryServer({ search: query.target.value });
            }, 300),
            goToEdit(scope) {
                this.pushRoute({ name: "admin.contact.contact.edit", params: { contactId: scope.row.id } });
            },
            editRoute(scope) {
                return route("admin.contact.contact.edit", [scope.row.id]);
            },
        },
    };
</script>

<style>
    .PENDING, .pending {
        background-color: yellowgreen;
        color: #fff;
        padding: 5px;
        font-weight: 600;
    }

    .APPROVED, .approved {
        background-color: yellow;
        color: #ff4949;
        padding: 5px;
        font-weight: 600;
    }
</style>
