<template>
  <div class="col-8 offset-2">
    <h1>Create student</h1>
    <div class="mb-3">
      <NLink class="btn btn-outline-primary" :to="{name: 'student'}">Back</NLink>
    </div>
    <form>
      <div class="form-group">
        <label>Student code</label>
        <input type="text" class="form-control">
      </div>
      <div class="form-group">
        <label>Name</label>
        <input type="text" class="form-control">
        <small class="form-text text-danger">Please input name.</small>
      </div>
      <div class="form-group">
        <label>Age</label>
        <input type="text" class="form-control">
      </div>
      <div class="form-group">
        <label>Gender</label>
        <input type="text" class="form-control">
      </div>
      <div class="form-group">
        <label>Email</label>
        <input type="text" class="form-control">
      </div>
      <div class="form-group">
        <label>Address</label>
        <input type="text" class="form-control">
      </div>

      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
</template>

<script>
  export default {}
</script>

<style scoped>
</style>
