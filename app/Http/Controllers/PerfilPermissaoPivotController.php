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

    public function store() {
        //
        $permissao = PerfilPermissaoPivot::create($this->validatePerfilPermissaoPivotRequest());
    }

    public function show(PerfilPermissaoPivot $perfil_permissao_pivot_json) {
        //
        $permissao = PerfilPermissaoPivot::find($perfil_permissao_pivot_json->id);
        return $permissao->toArray();
    }

    public function update(PerfilPermissaoPivot $perfil_permissao_pivot_json) {
        //
        $perfil_permissao_pivot_json->update($this->validatePerfilPermissaoPivotRequest());
    }

    public function destroy(PerfilPermissaoPivot $perfil_permissao_pivot_json) {
        //
        $perfil_permissao_pivot_json->delete();
    }

    // ========================= protected

    protected function validatePerfilPermissaoPivotRequest() {
        return request()->validate([
                                       'perfil_id' => 'required',
                                       'permissao_id' => 'required',
                                   ]);
    }
}
