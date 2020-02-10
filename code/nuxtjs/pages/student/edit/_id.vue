<template>
  <div class="col-8 offset-2">
    <h1>Edit student: <span class="text-primary">{{student.name}}</span></h1>
    <div v-if="!loadDataDone" class="text-center">
      <b-spinner label="Spinning"></b-spinner>
    </div>
    <StudentForm v-if="loadDataDone && student != {}" :student="student"/>
  </div>
</template>

<script>
  import StudentForm from '~/components/StudentForm.vue'

  export default {
    components: {StudentForm},
    data() {
      return {
        student: {
          name: '...'
        },
        loadDataDone: false
      }
    },
    async asyncData({$axios, route, redirect}) {
      let id = route.params.id == 0 ? '' : route.params.id
      if (isNaN(id) | id == 0) {
        return redirect({name: 'student'})
      }
      let {data} = await $axios.$get(`api/student/${id}`).catch(error => {
        return redirect({name: 'student'})
      })

      return {
        student: data,
        loadDataDone: true
      }
    },
  }
</script>

<style scoped>
</style>
