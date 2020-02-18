import Filial from "./components/views/FormFilial"
import CadastroEmpresa from "./components/views/FormEmpresa"
import Usuarios from "./components/views/FormUsuarios"
import newFilial from "./components/views/views_filiais/newFilial"
import EditFilial from "./components/views/views_filiais/EditFilial"
import EditUser from "./components/views/views_usuarios/EditUser"
import EditEmpresa from "./components/views/views_empresa/editEmpresa"
import newInvite from "./components/views/views_usuarios/newInvite";
import newInviteP from "./components/views/views_usuarios/newInvitePermissions";


const routes = [
    {
        path: "/cadastro",
        component: CadastroEmpresa
    },
    {
        path: "/cadastro/edit",
        component: EditEmpresa,
        name: "EditarCadastro",
        props: true
    },
    {
        path: "/filial",
        component: Filial,
        name: "filial"
    },
    {
        path: "/filial/new",
        name: "NovaFilial",
        component: newFilial,
        props: true,
        // meta: {
        //     requiresAuth: true
        // }
    },
    {
        path: "/filial/edit",
        name: "EditFilial",
        component: EditFilial,
        props: true
    },
    {
        path: "/usuarios",
        component: Usuarios,
        // meta: {
        //     requiresAuth: true
        // }
    },
    {
        path: "/usuarios/invite",
        name: "NovoUsuario",
        component: newInvite,
        props: true
    },
    {
        path: "/usuarios/invite/permissions",
        name: "convitePermissoes",
        component: newInviteP,
        props: true
    },
    {
        path: "/usuarios/edit",
        name: "EditUsuario",
        component: EditUser,
        props: true
    }
];
//  routes.beforeEach((to, from, next) => {
//      if (to.matched.some(record => record.meta.requiresAuth)) {
//          if (store.getters.isLoggedIn) {
//              next("/");
//              return;
//          }
//          next("/login");
//      } else {
//          next();
//      }
//  });

export default routes;

