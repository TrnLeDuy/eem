<template>
    <div class="div">
        <div class="content-header">
            <h1>
                {{ trans(`contacts.title.${contactTitle}`) }}
            </h1>
            <el-breadcrumb seperate="/">
                <el-breadcrumb-item>
                    <a href="/backend">Home</a>
                </el-breadcrumb-item>
                <el-breadcrumb-item :to="{ name: 'admin.contact.contact.index' }">
                    {{ trans("contacts.list resource") }}
                </el-breadcrumb-item>
                <el-breadcrumb-item :to="{ name: 'admin.contact.contact.create' }">
                    {{ trans(`contacts.title.${contactTitle}`) }}
                </el-breadcrumb-item>
            </el-breadcrumb>
        </div>

        <div class="box box-primary">
            <div class="box-body">
                <el-form ref="form" :model="contact" label-width="120px" label-position="top"
                    @keydown="form.errors.clear($event.target.name)">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-4">
                                    <el-form-item :label="trans('contacts.form.contact_code')"
                                        :class="{ 'el-form-item is-error': form.errors.has('contact_code') }">
                                        <el-input v-model="contact.contact_code" disabled class="bold-text no-select">
                                        </el-input>
                                        <div v-if="form.errors.has('contact_code')" class="el-form-item__error"
                                            v-text="form.errors.first('contact_code')"></div>
                                    </el-form-item>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <el-form-item :label="trans('contacts.form.contact_name')" :class="{
                                        'el-form-item is-error': form.errors.has('contact_name'),
                                    }">
                                        <el-input v-model="contact.contact_name" disabled></el-input>
                                        <div v-if="form.errors.has('contact_name')" class="el-form-item__error"
                                            v-text="form.errors.first('contact_name')"></div>
                                    </el-form-item>
                                </div>
                                <div class="col-md-4">
                                    <el-form-item :label="trans('contacts.form.phone_number')" :class="{
                                        'el-form-item is-error': form.errors.has('phone_number'),
                                    }">
                                        <el-input v-model="contact.phone_number" disabled></el-input>
                                        <div v-if="form.errors.has('phone_number')" class="el-form-item__error"
                                            v-text="form.errors.first('phone_number')"></div>
                                    </el-form-item>
                                </div>
                                <div class="col-md-4">
                                    <el-form-item :label="trans('contacts.form.email')" :class="{
                                        'el-form-item is-error': form.errors.has('email'),
                                    }">
                                        <el-input v-model="contact.email" disabled></el-input>
                                        <div v-if="form.errors.has('email')" class="el-form-item__error"
                                            v-text="form.errors.first('email')"></div>
                                    </el-form-item>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <el-form-item :label="trans('contacts.form.contact_title')"
                                        :class="{ 'el-form-item is-error': form.errors.has('contact_title'), }">
                                        <el-input v-model="contact.contact_title" disabled></el-input>
                                        <div v-if="form.errors.has('contact_title')" class="el-form-item__error"
                                            v-text="form.errors.first('contact_title')"></div>
                                    </el-form-item>
                                </div>
                            </div>
                            <div v-if="contact.type_id == 1">
                                <div class="row">
                                    <div class="col-md-3">
                                        <el-form-item :label="trans('contacts.form.categories')" :class="{
                                            'el-form-item is-error': form.errors.has('categories.title'),
                                        }">
                                            <el-input v-model="contact.categories.title" disabled></el-input>
                                        </el-form-item>
                                    </div>
                                    <div class="col-md-9">
                                        <el-form-item :label="trans('contacts.form.product')" :class="{
                                            'el-form-item is-error': form.errors.has('categories.title'),
                                        }">
                                            <el-input v-model="contact.contactDetail.product.title" disabled></el-input>
                                        </el-form-item>
                                    </div>
                                    <div class="col-md-12">
                                        <el-form-item :label="trans('contacts.form.messages')" :class="{
                                            'el-form-item is-error': form.errors.has('contactDetail.messages'),
                                        }">
                                            <el-input type="textarea" v-model="contact.contactDetail.messages" disabled
                                                :rows="15">
                                            </el-input>
                                        </el-form-item>
                                    </div>
                                </div>
                            </div>
                            <div v-if="contact.type_id == 2">
                                <div class="row">
                                    <div class="col-md-3">
                                        <el-form-item :label="trans('contacts.form.categories')" :class="{
                                            'el-form-item is-error': form.errors.has('categories.title'),
                                        }">
                                            <el-input v-model="contact.categories.title" disabled></el-input>
                                        </el-form-item>
                                    </div>
                                    <div class="col-md-3">
                                        <el-form-item :label="trans('contacts.form.monthly_consumption_kwh')" :class="{
                                            'el-form-item is-error': form.errors.has('contactDetail.monthly_consumption_kwh'),
                                        }">
                                            <el-input v-model="contact.contactDetail.monthly_consumption_kwh"
                                                disabled></el-input>
                                        </el-form-item>
                                    </div>
                                    <div class="col-md-2">
                                        <el-form-item :label="trans('contacts.form.avg_monthly_cost_vnd')" :class="{
                                            'el-form-item is-error': form.errors.has('contactDetail.avg_monthly_cost_vnd'),
                                        }">
                                            <el-input v-model="contact.contactDetail.avg_monthly_cost_vnd"
                                                disabled></el-input>
                                        </el-form-item>
                                    </div>
                                    <div class="col-md-2">
                                        <el-form-item :label="trans('contacts.form.financial_capacity_kw')" :class="{
                                            'el-form-item is-error': form.errors.has('contactDetail.financial_capacity_kw'),
                                        }">
                                            <el-input v-model="contact.contactDetail.financial_capacity_kw"
                                                disabled></el-input>
                                        </el-form-item>
                                    </div>
                                    <div class="col-md-2">
                                        <el-form-item :label="trans('contacts.form.avl_roof_area_m2')" :class="{
                                            'el-form-item is-error': form.errors.has('contactDetail.avl_roof_area_m2'),
                                        }">
                                            <el-input v-model="contact.contactDetail.avl_roof_area_m2"
                                                disabled></el-input>
                                        </el-form-item>
                                    </div>
                                    <div class="col-md-12">
                                        <el-form-item :label="trans('contacts.form.assembly_address')" :class="{
                                            'el-form-item is-error': form.errors.has('contactDetail.assembly_address'),
                                        }">
                                            <el-input v-model="contact.contactDetail.assembly_address"
                                                disabled></el-input>
                                        </el-form-item>
                                    </div>
                                </div>
                            </div>
                            <div v-if="contact.type_id == 3">
                                <div class="row">
                                    <div class="col-md-3">
                                        <el-form-item :label="trans('contacts.form.categories')" :class="{
                                            'el-form-item is-error': form.errors.has('categories.title'),
                                        }">
                                            <el-input v-model="contact.categories.title" disabled></el-input>
                                        </el-form-item>
                                    </div>
                                    <div class="col-md-12">
                                        <el-form-item :label="trans('contacts.form.messages')" :class="{
                                            'el-form-item is-error': form.errors.has('contactDetail.messages'),
                                        }">
                                            <el-input type="textarea" v-model="contact.contactDetail.messages" disabled
                                                :rows="15">
                                            </el-input>
                                        </el-form-item>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <el-form-item :label="trans('contacts.form.note')" :class="{
                                        'el-form-item is-error': form.errors.has('note'),
                                    }">
                                        <el-input type="textarea" v-model="contact.note"></el-input>
                                        <div v-if="form.errors.has('note')" class="el-form-item__error"
                                            v-text="form.errors.first('note')"></div>
                                    </el-form-item>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <el-form-item :label="trans('contacts.form.status')" :class="{
                                        'el-form-item is-error': form.errors.has('status'),
                                    }">
                                        <el-select v-model="contact.status">
                                            <el-option v-for="status in statuses" :key="status.id" :value="status.id"
                                                :label="status.text"></el-option>
                                        </el-select>
                                        <div v-if="form.errors.has('status')" class="el-form-item__error"
                                            v-text="form.errors.first('status')"></div>
                                    </el-form-item>
                                </div>
                            </div>
                            <el-form-item>
                                <el-button :loading="loading" type="primary" @click="onSubmit()">
                                    {{ trans("core.save") }}
                                </el-button>
                                <el-button @click="onCancel()">
                                    {{ trans("core.button.cancel") }}
                                </el-button>
                            </el-form-item>
                        </div>
                    </div>
                </el-form>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from "axios";
    import Form from "form-backend-validation";
    import ShortcutHelper from "../../../../../Core/Assets/js/mixins/ShortcutHelper";
    import "@riophae/vue-treeselect/dist/vue-treeselect.css";

    export default {
        mixins: [ShortcutHelper],
        props: {
            locales: {
                default: null,
                type: Object,
            },
            contactTitle: {
                default: null,
                type: String,
            },
        },
        data() {
            return {
                meta: {
                    current_page: 1,
                    per_page: 10,
                },
                order_meta: {
                    order_by: "",
                    order: "",
                },
                contactId: +this.$route.params.contactId,
                contact: {},
                statuses: [
                    { id: "PENDING", text: this.trans('contacts.table.pending') },
                    { id: "APPROVED", text: this.trans('contacts.table.approved') },
                ],
                form: new Form(),
                loading: false,
            };
        },
        async created() {
            this.fetchContact();
        },
        mounted() { },
        destroyed() {
            $(".publicUrl").hide();
        },
        methods: {
            onSubmit() {
                // Tạo bản sao của contact để không ảnh hưởng đến dữ liệu hiển thị
                const contactToSubmit = { ...this.contact };

                // Chuyển đổi status thành chữ thường nếu cần
                if (contactToSubmit.status) {
                    contactToSubmit.status = contactToSubmit.status.toLowerCase();
                }

                this.form = new Form(contactToSubmit);
                this.loading = true;

                this.form
                    .post(this.getRoute())
                    .then((response) => {
                        this.loading = false;
                        this.$message({
                            type: "success",
                            message: response.message,
                        });
                    })
                    .catch((error) => {
                        console.log(error);
                        this.loading = false;
                        this.$notify.error({
                            title: "Error",
                            message: "There are some errors in the form.",
                        });
                    });
            },
            onCancel() {
                this.pushRoute({
                    name: "admin.contact.contact.index"
                });
            },
            fetchContact() {
                this.loading = true;
                axios
                    .get(
                        route("api.contact.contact.find", { contactId: this.$route.params.contactId })
                    )
                    .then((response) => {
                        this.loading = false;
                        this.contact = response.data.data;
                        // Chuyển đổi status thành chữ hoa nếu cần
                        if (this.contact.status) {
                            this.contact.status = this.contact.status.toUpperCase();
                        }
                    })
                    .catch((error) => {
                        console.log(error);
                        this.loading = false;
                        this.$notify.error({
                            title: "Error",
                            message: "There are some errors in the form.",
                        });
                    });
            },
            getRoute() {
                if (this.contactId) {
                    return route("api.contact.contact.update", {
                        contactId: this.$route.params.contactId,
                    });
                }
                return route("api.contact.contact.store");
            },
        },
    };
</script>

<style>
    .el-input.is-disabled .el-input__inner,
    textarea[disabled] {
        color: rgb(78, 78, 78) !important;
    }

    .bold-text input {
        font-weight: bold !important;
    }

    .no-select input {
        user-select: none !important;
        -webkit-user-select: none !important;
        -moz-user-select: none !important;
        -ms-user-select: none !important;
        cursor: default !important;
        pointer-events: none !important;
    }
</style>
