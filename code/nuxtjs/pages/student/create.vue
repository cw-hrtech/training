<template>
  <div class="col-8 offset-2">
    <h1>Create student</h1>
    <StudentForm />
  </div>
</template>

<script>
  import StudentForm from '~/components/StudentForm.vue'
  export default {
    components: {StudentForm},
    data() {
      return {}
    }
  }
</script>

<style scoped>
</style>
