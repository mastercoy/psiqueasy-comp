
import Filial from "./components/views/CadastroFilial"
import CadastroEmpresa from "./components/views/CadastroEmpresa"
import Usuarios from "./components/views/CadastroUsuarios"


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

