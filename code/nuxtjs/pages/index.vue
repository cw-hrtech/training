<template>
  <div class="container">
    <div>
      <logo/>
      <h1 class="title">
        HR-TECH Training
      </h1>
      <div class="links">
        <NLink :to="{name: 'student'}" class="btn btn-primary">Student list</NLink>
      </div>
    </div>
  </div>
</template>

<script>
  import Logo from '~/components/Logo.vue'

  export default {
    components: {
      Logo
    }
  }
</script>

<style scoped>
  .container {
    margin: 0 auto;
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
  }

  .title {
    font-family: 'Quicksand', 'Source Sans Pro', -apple-system, BlinkMacSystemFont,
    'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
    display: block;
    font-weight: 300;
    font-size: 100px;
    color: #35495e;
    letter-spacing: 1px;
  }

  .links {
    padding-top: 15px;
  }
</style>
