<template>
  <div>
    <h1>https://izitoast.marcelodolza.com/</h1>
    <button class="btn btn-outline-danger" @click="showMessage">Show Message</button>
  </div>
</template>

<script>
  export default {
    methods: {
      showMessage() {
        iziToast.show({
          id: 'show',
          // title: 'Hey',
          // close: false,
          // icon: 'fa fa-envelope-o',
          class: 'custom1',
          displayMode: 2,
          message: 'Chung toi rat vui khi nhan duoc tra loi cua ban, moi ban de tham gia phong van vong so tuyen vao hoi 10h00 ngay 20/02/2020',
          position: 'bottomRight',
          image: '/avatar.jpg',
          imageWidth: 80,
          layout: 2,
          balloon: true,
          maxWidth: 300,
          timeout: 10000,
          buttons: [
            ['<button>Chi tiet</button>', (instance, toast) => {

              instance.hide({ transitionOut: 'fadeOutUp' }, toast);

              this.$router.push({name: 'index'})

              // iziToast.show({
              //   theme: 'dark',
              //   icon: 'icon-photo',
              //   title: 'OK',
              //   message: 'Chuyển tới trang chi tiết',
              //   position: 'bottomCenter'
              // });

            }, true]
          ]
        });
      }
    }
  }
</script>

<style scoped>

</style>
