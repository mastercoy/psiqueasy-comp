
import Filial from "./components/views/FormFilial"
import CadastroEmpresa from "./components/views/FormEmpresa"
import Usuarios from "./components/views/FormUsuarios"
import newFilial from "./components/views/views_filiais/newFilial"
import EditFilial from "./components/views/views_filiais/EditFilial";


const routes = [
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
        path: "/cadastro",
        component: CadastroEmpresa
    },
    {
        path: "/usuarios",
        component: Usuarios
    }
];

  
  export default routes;

