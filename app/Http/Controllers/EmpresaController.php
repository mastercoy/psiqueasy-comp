<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Support\Facades\Response;

class EmpresaController extends Controller {

    // ========================= EMPRESA

    public function index() {
        //
        $empresa = Empresa::all();
        return Response::json($empresa);
    }

    public function create() {
        //
    }

    public function store() {
        $empresa_json = Empresa::create($this->validateEmpresaRequest());

       // return redirect()->action('EmpresaController@show', ['id' => $empresa_json->id]);

        return response()->json(array('success' => true, 'last_id' => $empresa_json->id), 200);

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
