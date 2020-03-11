<template>
    <div>
        <div class="form-temp">
            <h3>Testando...</h3>
            <b-row>
                <b-col md="auto">
                <b-calendar v-model="value" @context="onContext" locale="en-US"></b-calendar>
                </b-col>
                <b-col>
                <p>Value: <b>'{{ value }}'</b></p>
                <p class="mb-0">Context:</p>
                <pre class="small">{{ context }}</pre>
                </b-col>
            </b-row>
        </div>
    </div>
</template>

<script>
export default {
    data() {
      return {
        value: '',
        context: null
      }
    },
    methods: {
      onContext(ctx) {
        this.context = ctx
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