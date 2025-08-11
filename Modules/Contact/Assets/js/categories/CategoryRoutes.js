import CategoryTable from "./components/CategoryTable.vue";
import CategoryForm from "./components/CategoryForm.vue";

const { locales } = window.AsgardCMS;

export default [
    {
        path: "/contact/categories",
        name: "admin.contact.category.index",
        component: CategoryTable,
    },
    {
        path: "/contact/categories/create",
        name: "admin.contact.category.create",
        component: CategoryForm,
        props: {
            locales,
            categoryTitle: "create category",
        },
    },
    {
        path: "/contact/categories/:categoryId/edit",
        name: "admin.contact.category.edit",
        component: CategoryForm,
        props: {
            locales,
            categoryTitle: "edit category",
        },
    },
];
