<template>
    <div class="div">
        <div class="content-header">
            <h1>
                {{ trans(`projects.title.${projectTitle}`) }}
            </h1>
            <el-breadcrumb separator="/">
                <el-breadcrumb-item>
                    <a href="/backend">{{ trans(`core.breadcrumb.home`) }}</a>
                </el-breadcrumb-item>
                <el-breadcrumb-item :to="{ name: 'admin.project.project.index' }">
                    {{ trans("projects.title.projects") }}
                </el-breadcrumb-item>
                <el-breadcrumb-item :to="{ name: 'admin.project.project.create' }">
                    {{ trans(`projects.title.${projectTitle}`) }}
                </el-breadcrumb-item>
            </el-breadcrumb>
        </div>

        <el-form ref="form" :model="project" label-width="120px" label-position="top"
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
                                    <el-form-item :label="trans('projects.form.title')" :class="{
                                        'el-form-item is-error': form.errors.has(
                                            locale + '.title'
                                        ),
                                    }">
                                        <el-input v-model="project[locale].title"
                                            @input="generateSlug($event, locale)"></el-input>
                                        <div v-if="form.errors.has(locale + '.title')" class="el-form-item__error"
                                            v-text="form.errors.first(locale + '.title')"></div>
                                    </el-form-item>
                                    <el-form-item :label="trans('projects.form.slug')" :class="{
                                        'el-form-item is-error': form.errors.has(
                                            locale + '.slug'
                                        ),
                                    }">
                                        <el-input v-model="project[locale].slug">
                                            <el-button slot="prepend" @click="generateSlug($event, locale)">{{
                                                trans("core.generate") }}</el-button>
                                        </el-input>
                                        <div v-if="form.errors.has(locale + '.slug')" class="el-form-item__error"
                                            v-text="form.errors.first(locale + '.slug')"></div>
                                    </el-form-item>
                                    <el-form-item :label="trans('projects.form.body')" :class="{
                                        'el-form-item is-error': form.errors.has(
                                            locale + '.body'
                                        ),
                                    }">
                                        <component :is="getCurrentEditor()" v-model="project[locale].body"
                                            :value="project[locale].body"></component>
                                        <div v-if="form.errors.has(locale + '.body')" class="el-form-item__error"
                                            v-text="form.errors.first(locale + '.body')"></div>
                                    </el-form-item>
                                    <div class="panel box box-primary">
                                        <div class="box-header">
                                            <h4 class="box-title">
                                                <a :href="`#collapseMeta-${locale}`" class="collapsed"
                                                    data-toggle="collapse" data-parent="#accordion">
                                                    {{ trans("core.form.meta_data") }}
                                                </a>
                                            </h4>
                                        </div>
                                        <div :id="`collapseMeta-${locale}`" style="height: 0"
                                            class="panel-collapse collapse">
                                            <div class="box-body">
                                                <el-form-item :label="trans('core.form.meta_title')">
                                                    <el-input v-model="project[locale].meta_title"></el-input>
                                                </el-form-item>
                                                <el-form-item :label="trans('core.form.meta_description')">
                                                    <el-input v-model="project[locale].meta_description" type="textarea"
                                                        autosize maxlength="186" :rows="4"></el-input>
                                                </el-form-item>
                                            </div>
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
                                </el-tab-pane>
                            </el-tabs>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="box box-primary">
                        <div class="box-body">
                            <el-form-item :label="trans('projects.form.category')" :class="{
                                'el-form-item is-error': form.errors.has('category_id'),
                            }">
                                <el-select v-model="project.category_id" placeholder="Select">
                                    <el-option v-for="item in categories" :key="item.id" :label="item.title"
                                        :value="item.id">
                                    </el-option>
                                </el-select>
                                <div v-if="form.errors.has('category_id')" class="el-form-item__error"
                                    v-text="form.errors.first('category_id')"></div>
                            </el-form-item>
                            <el-form-item :label="trans('projects.form.status')" :class="{
                                'el-form-item is-error': form.errors.has('status'),
                            }">
                                <el-switch v-model="project.status" active-color="#13ce66" inactive-color="#ff4949">
                                </el-switch>
                                <div v-if="form.errors.has('status')" class="el-form-item__error"
                                    v-text="form.errors.first('status')">
                                </div>
                            </el-form-item>
                            <single-media :entity-id="project.id" zone="avatar"
                                entity="Modules\Project\Entities\Project"
                                @single-file-selected="selectSingleFile($event, 'project')"></single-media>
                            <br />
                        </div>
                    </div>
                </div>
            </div>
        </el-form>
        <button v-show="false" v-shortkey="['b']" @shortkey="pushRoute({ name: 'admin.page.project.index' })"></button>
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
    import Treeselect from "@riophae/vue-treeselect";
    import "@riophae/vue-treeselect/dist/vue-treeselect.css";

    export default {
        components: {
            FormErrors,
            SingleMedia,
            TagsInput,
            Treeselect,
        },
        mixins: [
            Slugify,
            ShortcutHelper,
            ActiveEditor,
            SingleFileSelector,
        ],
        props: {
            locales: {
                default: null,
                type: Object,
            },
            projectTitle: {
                default: null,
                type: String,
            },
        },
        data() {
            return {
                project: window
                    ._(this.locales)
                    .keys()
                    .map((locale) => [
                        locale,
                        {
                            title: "",
                            slug: "",
                            body: "",
                            meta_title: "",
                            meta_description: "",
                        },
                    ])
                    .fromPairs()
                    .merge({
                        id: null,
                        status: true,
                        category_id: null,
                    })
                    .value(),
                categories: [],
                form: new Form(),
                loading: false,
                activeTab: window.AsgardCMS.currentLocale || "en",
            };
        },
        created() {
            this.fetchCategory();
            if (this.$route.params.projectId !== undefined) {
                this.fetchProject();
            }
        },
        destroyed() {
            $(".publicUrl").hide();
        },
        methods: {
            onSubmit() {
                this.form = new Form(this.project);
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
                            name: "admin.project.project.index",
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
                    name: "admin.project.project.index",
                });
            },
            generateSlug(event, locale) {
                this.project[locale].slug = this.slugify(this.project[locale].title);
            },
            fetchCategory() {
                this.loading = true;
                axios.get(route("api.project.category.all")).then((response) => {
                    this.loading = false;
                    this.categories = response.data.data;
                });
            },
            fetchProject() {
                this.loading = true;
                axios
                    .get(
                        route("api.project.project.find", {
                            projectId: this.$route.params.projectId,
                        })
                    )
                    .then((response) => {
                        this.loading = false;
                        this.project = response.data.data;
                    });
            },
            getRoute() {
                if (this.$route.params.projectId !== undefined) {
                    return route("api.project.project.update", {
                        projectId: this.$route.params.projectId,
                    });
                }
                return route("api.project.project.store");
            },
        },
    };
</script>