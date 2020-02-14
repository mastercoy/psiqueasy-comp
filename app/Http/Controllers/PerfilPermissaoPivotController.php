<?php

namespace App\Http\Controllers;

use App\Models\PerfilPermissaoPivot;
use Illuminate\Support\Facades\Response;

class PerfilPermissaoPivotController extends Controller {

    public function index() {
        //
        $permissao = PerfilPermissaoPivot::all();
        return Response::json($permissao);
    }

    public function create() {
        //
    }


    public function store() {
        //
        $permissao = PerfilPermissaoPivot::create($this->validatePerfilPermissaoPivotRequest());
    }

    protected function validatePerfilPermissaoPivotRequest() {
        return request()->validate([
                                       'perfil_id' => 'required',
                                       'permissao_id' => 'required',
                                   ]);
    }

    public function show(PerfilPermissaoPivot $perfil_permissao_pivot_json) {
        //
        $permissao = PerfilPermissaoPivot::find($perfil_permissao_pivot_json->id);
        return $permissao->toArray();
    }

    public function edit(PerfilPermissaoPivot $perfil_permissao_pivot_json) {
        //
    }

    public function update(PerfilPermissaoPivot $perfil_permissao_pivot_json) {
        //
        $perfil_permissao_pivot_json->update($this->validatePerfilPermissaoPivotRequest());
    }

    // ========================= protected

    public function destroy(PerfilPermissaoPivot $perfil_permissao_pivot_json) {
        //
        $perfil_permissao_pivot_json->delete();
    }
}
