import ProjectTable from "./components/ProjectTable.vue";
import ProjectForm from "./components/ProjectForm.vue";

const { locales } = window.AsgardCMS;

export default [
  {
    path: "/project/projects",
    name: "admin.project.project.index",
    component: ProjectTable,
  },
  {
    path: "/project/projects/create",
    name: "admin.project.project.create",
    component: ProjectForm,
    props: {
      locales,
      projectTitle: "create project",
    },
  },
  {
    path: "/project/projects/:projectId/edit",
    name: "admin.project.project.edit",
    component: ProjectForm,
    props: {
      locales,
      projectTitle: "edit project",
    },
  },
];
