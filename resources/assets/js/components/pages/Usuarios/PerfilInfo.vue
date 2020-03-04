<template>
  <div class="form-temp">
    <h3>{{perf.nome}}</h3>
    <h5>{{ arrPermissoes1 }}</h5>
    <div class="alert alert-warning" role="alert">
      <i class="fa fa-exclamation-circle fa-lg" aria-hidden="true"></i>
      As alterações feitas afetarão todos os usuários com este perfil
    </div>
    <hr>
    <EditPermissions :perfil='perfil'/>
  </div>
</template>

<script>
import EditPermissions from '../../form_components/EditPermissions';
export default {
  mounted() {
    this.perfil = this.perf
  },
  name: 'PerfilInfo',
  props: ['perf'],
  components: {
    EditPermissions
  },
  data() {
    return {
      perfil: {},
      arrPermissoes1: []
    }
  }
}
</script>

<style>
.form-temp {
  margin-bottom: 30px;
}

.parent {
  padding: 10px;
  width: 100%;
  display: flex;
  justify-content: space-between;
  background-color: #eee;
  border-radius: 5px;
}

.vl {
  border-left: 3px solid #eee;
  height: 300px;
  margin-bottom: 30px;
}

.container-n1 {
  padding: 20px;
} 

.pf {
  color: rgb(112, 112, 112);
}

.docker {
  padding: 20px;
  width: 100%;
  display: flex;
  justify-content: space-between;
  vertical-align: middle;
}
</style>