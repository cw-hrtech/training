<template>
  <div>
    <h1>Student list</h1>
    <div class="mb-3">
      <NLink class="btn btn-outline-primary" :to="{name: 'index'}">Home Page</NLink>
      <NLink class="btn btn-outline-primary" :to="{name: 'student-create'}">Add new student</NLink>
    </div>
    <table class="table table-striped">
      <thead>
      <tr>
        <th scope="col">No</th>
        <th scope="col">Code</th>
        <th scope="col">Name</th>
        <th scope="col">Age</th>
        <th scope="col">Gender</th>
        <th scope="col">Email</th>
        <th scope="col">Address</th>
      </tr>
      </thead>
      <tbody>
      <tr v-if="students.length == 0">
        <td colspan="7">Data not found</td>
      </tr>
      <tr v-for="(item, index) in students" :key="index">
        <td>{{(currentPage - 1) * perPage + index + 1}}</td>
        <td>{{item.code}}</td>
        <td>{{item.name}}</td>
        <td>{{item.age}}</td>
        <td>{{item.gender}}</td>
        <td>{{item.email}}</td>
        <td>{{item.address}}</td>
      </tr>
      </tbody>

      <button
        :class="{'disabled': currentPage <= 1}"
        class="btn btn-outline-info mr-3"
        @click="prevPage"
      >
        Prev
      </button>
      <button
        :class="{'disabled': currentPage >= totalPage}"
        class="btn btn-outline-info"
        @click="nextPage"
      >
        Next
      </button>

      tmpPage: {{tmpPage}}
    </table>
  </div>
</template>

<script>
  export default {
    name: "index",
    data() {
      return {
        students: [],
        currentPage: 1,
        totalPage: 1,
        perPage: 10,
        tmpPage: 0
      }
    },
    async asyncData({$axios}) {
      // let data = await $axios.$get('http://icanhazip.com')
      let {data} = await $axios.$get('api/student')
      return {
        students: data.data,
        currentPage: data.current_page,
        tmpPage: data.current_page,
        totalPage: data.last_page,
        perPage: data.per_page
      }
    },
    methods: {
      nextPage() {
        if (this.currentPage >= this.totalPage) {
          return;
        }
        this.tmpPage++;
      },

      prevPage() {
        if (this.currentPage <= 1) {
          return;
        }
        this.tmpPage--;
      }
    }

  }
</script>

<style scoped>
</style>
