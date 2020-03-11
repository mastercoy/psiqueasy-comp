import Filial from "./components/pages/FormFilial"
import CadastroEmpresa from "./components/pages/FormEmpresa"
import Usuarios from "./components/pages/FormUsuarios"
import newFilial from "./components/pages/Filiais/NewFilial"
import EditFilial from "./components/pages/Filiais/EditFilial"
import EditUser from "./components/pages/Usuarios/EditUser"
import EditEmpresa from "./components/pages/Empresa/EditEmpresa"
import newInvite from "./components/pages/Usuarios/NewInvite";
import newInviteP from "./components/pages/Usuarios/NewInvitePermissions";
import PerfilInfo from "./components/pages/Usuarios/PerfilInfo";
//TESTE DE APLICABILIDADE
import BotoesTestes from "./components/pages/Usuarios/BotoesTestes";


const routes = [
    {
        path: "/teste",
        component: BotoesTestes,
        name: "Teste",
    },
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
        props: true
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
        component: Usuarios
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
    },
    {
        path: "/profile/edit",
        name: "editProfile",
        component: PerfilInfo,
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

