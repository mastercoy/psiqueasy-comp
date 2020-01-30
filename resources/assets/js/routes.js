
import Filial from "./components/views/FormFilial"
import CadastroEmpresa from "./components/views/FormEmpresa"
import Usuarios from "./components/views/FormUsuarios"
import newFilial from "./components/views/views_filiais/newFilial"
import EditFilial from "./components/views/views_filiais/EditFilial"
import NewUser from "./components/views/views_usuarios/NewUser"
import EditUser from "./components/views/views_usuarios/EditUser"


const routes = [
    {
        path: "/cadastro",
        component: CadastroEmpresa
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
    },
    {
        path: "/usuarios/new",
        name: "NovoUsuario",
        component: NewUser,
        props: true
    },
    {
        path: "/usuarios/edit",
        name: "EditUsuario",
        component: EditUser,
        props: true
    }
];

  
  export default routes;

