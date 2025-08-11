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
                <el-breadcrumb-item :to="{ name: 'admin.product.category.index' }">
                    {{ trans("categories.title.categories") }}
                </el-breadcrumb-item>
                <el-breadcrumb-item :to="{ name: 'admin.product.category.create' }">
                    {{ trans(`categories.title.${categoryTitle}`) }}
                </el-breadcrumb-item>
            </el-breadcrumb>
        </div>

        <el-form ref="form" :model="category" label-width="120px" label-position="top"
            @keydown="form.errors.clear($event.target.name)">
            <form-errors :form="form"></form-errors>
            <div class="row">
                <div class="col-md-9">
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
                                        <el-input v-model="category[locale].title"
                                            @input="generateSlug($event, locale)"></el-input>
                                        <div v-if="form.errors.has(locale + '.title')" class="el-form-item__error"
                                            v-text="form.errors.first(locale + '.title')"></div>
                                    </el-form-item>

                                    <el-form-item :label="trans('categories.form.slug')" :class="{
                                        'el-form-item is-error': form.errors.has(
                                            locale + '.slug'
                                        ),
                                    }">
                                        <el-input v-model="category[locale].slug">
                                            <el-button slot="prepend"
                                                @click="generateSlug($event, locale)">{{ trans("core.generate") }}</el-button>
                                        </el-input>
                                        <div v-if="form.errors.has(locale + '.slug')" class="el-form-item__error"
                                            v-text="form.errors.first(locale + '.slug')"></div>
                                    </el-form-item>
                                    <el-form-item :label="trans('categories.form.sumary')" :class="{
                                        'el-form-item is-error': form.errors.has(
                                            locale + '.sumary'
                                        ),
                                    }">
                                        <el-input v-model="category[locale].sumary" type="textarea" rows="4"></el-input>
                                        <div v-if="form.errors.has(locale + '.sumary')" class="el-form-item__error"
                                            v-text="form.errors.first(locale + '.sumary')"></div>
                                    </el-form-item>
                                    <el-form-item :label="trans('categories.form.body')" :class="{
                                        'el-form-item is-error': form.errors.has(
                                            locale + '.body'
                                        ),
                                    }">
                                        <component :is="getCurrentEditor()" v-model="category[locale].body"
                                            :value="category[locale].body"></component>
                                        <div v-if="form.errors.has(locale + '.body')" class="el-form-item__error"
                                            v-text="form.errors.first(locale + '.body')"></div>
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
                <div class="col-md-3">
                    <div class="box box-primary">
                        <div class="box-body">
                            <el-form-item :label="trans('categories.form.status')" :class="{
                                'el-form-item is-error': form.errors.has('status'),
                            }">
                                <el-switch v-model="category.status" active-color="#13ce66" inactive-color="#ff4949">
                                </el-switch>
                                <div v-if="form.errors.has('status')" class="el-form-item__error"
                                    v-text="form.errors.first('status')"></div>
                            </el-form-item>
                            <el-form-item :label="trans('categories.form.show_homepage')" :class="{
                                'el-form-item is-error': form.errors.has('show_homepage'),
                            }">
                                <el-switch v-model="category.show_homepage" active-color="#13ce66"
                                    inactive-color="#ff4949">
                                </el-switch>
                                <div v-if="form.errors.has('show_homepage')" class="el-form-item__error"
                                    v-text="form.errors.first('show_homepage')"></div>
                            </el-form-item>
                            <el-form-item :label="trans('categories.form.show_menu')" :class="{
                                'el-form-item is-error': form.errors.has('show_menu'),
                            }">
                                <el-switch v-model="category.show_menu" active-color="#13ce66" inactive-color="#ff4949">
                                </el-switch>
                                <div v-if="form.errors.has('show_menu')" class="el-form-item__error"
                                    v-text="form.errors.first('show_menu')"></div>
                            </el-form-item>
                            <single-media :entity-id="category.id" zone="avatar"
                                entity="Modules\Product\Entities\Category"
                                @single-file-selected="selectSingleFile($event, 'category')"></single-media>
                        </div>
                    </div>
                </div>
            </div>
        </el-form>
        <button v-show="false" v-shortkey="['b']" @shortkey="pushRoute({ name: 'admin.page.category.index' })"></button>
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
                            slug: "",
                            body: "",
                            sumary: "",
                        },
                    ])
                    .fromPairs()
                    .merge({
                        id: null,
                        status: true,
                        show_homepage: false,
                        show_menu: false,
                        show_sidebar: false,
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
                            name: "admin.product.category.index",
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
                    name: "admin.product.category.index",
                });
            },
            generateSlug(event, locale) {
                this.category[locale].slug = this.slugify(this.category[locale].title);
            },
            fetchCategory() {
                this.loading = true;
                axios
                    .get(
                        route("api.product.category.find", {
                            categoryId: this.$route.params.categoryId,
                        })
                    )
                    .then((response) => {
                        this.loading = false;
                        this.category = response.data.data;
                    });
            },
            getRoute() {
                if (this.$route.params.categoryId !== undefined) {
                    return route("api.product.category.update", {
                        categoryId: this.$route.params.categoryId,
                    });
                }
                return route("api.product.category.store");
            },
        },
    };
</script>
