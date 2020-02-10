<template>
  <span>
    <small v-if="message.length > 0" class="form-text text-danger">{{message}}</small>
  </span>
</template>

<script>
  export default {
      props: {
        message: {
          type: String,
          default: ''
        }
      }
  }
</script>

<style scoped>

</style>
