<?php

namespace App\Http\Controllers;

use App\Models\Empresa;

class EmpresaController extends Controller {

    // ========================= EMPRESA

    public function index() {
        //
    }

    public function create() {
        //
    }

    public function store() {
        $empresa_json = Empresa::create($this->validateEmpresaRequest());
<<<<<<< HEAD

       // return redirect()->action('EmpresaController@show', ['id' => $empresa_json->id]);

        return response()->json(array('success' => true, 'last_id' => $empresa_json->id), 200);
=======
        //return response()->json(array('success' => true, 'last_id' => $empresa_json->id), 200);
>>>>>>> cb7ad53aa67373234e47243d9ed631cc5ddef2ac

    }

    public function show(Empresa $empresa_json) {
        return $empresa = Empresa::find($empresa_json->id);
    }

    public function edit($id) {
        //
    }

    public function update(Empresa $empresa_json) {
        $empresa_json->update($this->validateEmpresaRequest());
    }

    public function destroy(Empresa $empresa_json) {
        $empresa_json->delete();
    }

    public function desativarEmpresa(Empresa $empresa_json) {
        $empresa         = Empresa::find($empresa_json->id);
        $empresa->active = false;
        $empresa->save();
    }

    // ========================= protected

    protected function validateEmpresaRequest() {
        return request()->validate([
                                       'cpf_cnpj' => 'required',
                                       'logo_marca' => 'required',
                                       'active' => 'nullable',
                                       'empresa_categoria_id' => 'nullable'
                                   ]);
    }


}
