import CategoryTable from "./components/CategoryTable.vue";
import CategoryForm from "./components/CategoryForm.vue";

const { locales } = window.AsgardCMS;

export default [
  {
    path: "/project/categories",
    name: "admin.project.category.index",
    component: CategoryTable,
  },
  {
    path: "/project/categories/create",
    name: "admin.project.category.create",
    component: CategoryForm,
    props: {
      locales,
      categoryTitle: "create category",
    },
  },
  {
    path: "/project/categories/:categoryId/edit",
    name: "admin.project.category.edit",
    component: CategoryForm,
    props: {
      locales,
      categoryTitle: "edit category",
    },
  },
];
