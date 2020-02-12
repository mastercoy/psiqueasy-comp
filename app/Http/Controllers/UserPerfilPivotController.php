<?php

namespace App\Http\Controllers;

use App\Models\UserPerfilPivot;
use Illuminate\Support\Facades\Response;

class UserPerfilPivotController extends Controller { //afazer apagar controller?

    public function index() {
        //
        $pivot = UserPerfilPivot::all();
        return Response::json($pivot);
    }

//Route::resource('user-perfil-pivot-json', 'UserPerfilPivotController');
    public function create() {
        //
    }


    public function store() {
        //
        $pivot = UserPerfilPivot::create($this->validateUserPerfilPivotRequest());
    }

    public function show(UserPerfilPivot $user_perfil_pivot_json) {
        //
        $pivot = UserPerfilPivot::find($user_perfil_pivot_json->id);
        return Response::json($pivot);

    }

    public function edit(UserPerfilPivot $user_perfil_pivot_json) {
        //
    }

    public function update(UserPerfilPivot $user_perfil_pivot_json) {
        //
        $user_perfil_pivot_json->update($this->validateUserPerfilPivotRequest());
    }

    public function destroy(UserPerfilPivot $user_perfil_pivot_json) {
        //
        $user_perfil_pivot_json->delete();
    }

    // ========================= protected

    protected function validateUserPerfilPivotRequest() {
        return request()->validate([
                                       'user_id' => 'required',
                                       'perfil_id' => 'required',
                                   ]);
    }


}
