
import Filial from "./components/views/FormFilial"
import CadastroEmpresa from "./components/views/FormEmpresa"
import Usuarios from "./components/views/FormUsuarios"


const routes = [
    {
        path: "/filial",
        component: Filial
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

