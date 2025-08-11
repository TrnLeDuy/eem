<template>
    <div class="div">
        <div class="content-header">
            <h1>
                {{ trans(`categories.title.${categoryTitle}`) }}
            </h1>
            <el-breadcrumb separator="/">
                <el-breadcrumb-item>
                    <a href="/backend">{{ trans("core.breadcrumb.home") }}</a>
                </el-breadcrumb-item>
                <el-breadcrumb-item :to="{ name: 'admin.contact.category.index' }">
                    {{ trans("categories.title.categories") }}
                </el-breadcrumb-item>
                <el-breadcrumb-item :to="{ name: 'admin.contact.category.create' }">
                    {{ trans(`categories.title.${categoryTitle}`) }}
                </el-breadcrumb-item>
            </el-breadcrumb>
        </div>

        <el-form ref="form" :model="category" label-width="120px" label-position="top"
            @keydown="form.errors.clear($event.target.name)">
            <form-errors :form="form"></form-errors>
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-body">
                            <el-tabs v-model="activeTab">
                                <el-tab-pane v-for="(localeArray, locale) in locales" :key="localeArray.name"
                                    :label="localeArray.name" :name="locale">
                                    <span slot="label" :class="{ error: form.errors.has(locale) }"><i
                                            :class="'flag-icon flag-icon-' + locale"></i> &nbsp;
                                            {{ trans('locales.' + locale) }}</span>
                                    <el-form-item :label="trans('categories.form.title')" :class="{
                                        'el-form-item is-error': form.errors.has(
                                            locale + '.title'
                                        ),
                                    }">
                                        <el-input v-model="category[locale].title"></el-input>
                                        <div v-if="form.errors.has(locale + '.title')" class="el-form-item__error"
                                            v-text="form.errors.first(locale + '.title')"></div>
                                    </el-form-item>
                                    <el-form-item :label="trans('categories.form.status')" :class="{
                                        'el-form-item is-error': form.errors.has('status'),
                                    }">
                                        <el-switch v-model="category.status" active-color="#13ce66"
                                            inactive-color="#ff4949">
                                        </el-switch>
                                        <div v-if="form.errors.has('status')" class="el-form-item__error"
                                            v-text="form.errors.first('status')"></div>
                                    </el-form-item>

                                    <el-form-item>
                                        <el-button :loading="loading" type="primary" @click="onSubmit()">
                                            {{ trans("core.save") }}
                                        </el-button>
                                        <el-button @click="onCancel()">
                                            {{ trans("core.button.cancel") }}
                                        </el-button>
                                    </el-form-item>
                                </el-tab-pane>
                            </el-tabs>
                        </div>
                    </div>
                </div>
            </div>
        </el-form>
        <button v-show="false" v-shortkey="['b']"
            @shortkey="pushRoute({ name: 'admin.contact.category.index' })"></button>
    </div>
</template>

<script>
    import axios from "axios";
    import Form from "form-backend-validation";
    import FormErrors from "../../../../../Core/Assets/js/components/FormErrors.vue";
    import Slugify from "../../../../../Core/Assets/js/mixins/Slugify";
    import ShortcutHelper from "../../../../../Core/Assets/js/mixins/ShortcutHelper";
    import ActiveEditor from "../../../../../Core/Assets/js/mixins/ActiveEditor";
    import SingleMedia from "../../../../../Media/Assets/js/components/SingleMedia.vue";
    import SingleFileSelector from "../../../../../Media/Assets/js/mixins/SingleFileSelector";
    import TagsInput from "../../../../../Tag/Assets/js/components/TagInput.vue";

    export default {
        components: {
            FormErrors,
            SingleMedia,
            TagsInput,
        },
        mixins: [Slugify, ShortcutHelper, ActiveEditor, SingleFileSelector],
        props: {
            locales: {
                default: null,
                type: Object,
            },
            categoryTitle: {
                default: null,
                type: String,
            },
        },
        data() {
            return {
                category: window
                    ._(this.locales)
                    .keys()
                    .map((locale) => [
                        locale,
                        {
                            title: "",
                        },
                    ])
                    .fromPairs()
                    .merge({
                        id: null,
                        status: true,
                    })
                    .value(),
                categories: [],
                form: new Form(),
                loading: false,
                activeTab: window.AsgardCMS.currentLocale || "en",
            };
        },
        created() {
            if (this.$route.params.categoryId !== undefined) {
                this.fetchCategory();
            }
        },
        destroyed() {
            $(".publicUrl").hide();
        },
        methods: {
            onSubmit() {
                this.form = new Form(this.category);
                this.loading = true;

                this.form
                    .post(this.getRoute())
                    .then((response) => {
                        this.loading = false;
                        this.$message({
                            type: "success",
                            message: response.message,
                        });
                        this.pushRoute({
                            name: "admin.contact.category.index",
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
            fetchCategory() {
                this.loading = true;
                axios
                    .get(
                        route("api.contact.category.find", {
                            categoryId: this.$route.params.categoryId,
                        })
                    )
                    .then((response) => {
                        this.loading = false;
                        this.category = response.data.data;
                    });
            },
            onCancel() {
                this.pushRoute({
                    name: "admin.contact.category.index",
                });
            },
            getRoute() {
                if (this.$route.params.categoryId !== undefined) {
                    return route("api.contact.category.update", {
                        categoryId: this.$route.params.categoryId,
                    });
                }
                return route("api.contact.category.store");
            },
        },
    };
</script>