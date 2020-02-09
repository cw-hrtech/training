<template>
  <div>
    <h1>Student list</h1>
    <div class="mb-3">
      <NLink class="btn btn-outline-primary" :to="{name: 'index'}">Home Page</NLink>
      <NLink class="btn btn-outline-primary" :to="{name: 'student-create'}">Add new student</NLink>
    </div>
    <table v-if="students.length > 0" class="table table-striped">
      <thead>
      <tr>
        <th style="width: 50px">No</th>
        <th>Code</th>
        <th>Name</th>
        <th>Age</th>
        <th>Gender</th>
        <th>Email</th>
        <th>Address</th>
        <th></th>
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
        <td>{{item.gender == 1 ? 'Male' : 'Female'}}</td>
        <td>{{item.email}}</td>
        <td>{{item.address}}</td>
        <td>
          <NLink :to="{}">Edit</NLink>
          <a>Delete</a>
        </td>
      </tr>
      </tbody>
    </table>
    <div class="text-center">
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
    </div>
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
        tmpPage: 0,
        loadDataDone: false
      }
    },
    async asyncData({$axios, route}) {
      let page = route.query.page == undefined ? 1 : route.query.page
      let {data} = await $axios.$get(`api/student?page=${page}`)
      return {
        students: data.data,
        currentPage: data.current_page,
        tmpPage: data.current_page,
        totalPage: data.last_page,
        perPage: data.per_page,
        loadDataDone: true
      }
    },
    methods: {
      async loadData(page) {
        this.loadDataDone = false
        let {data} = await this.$axios.$get(`api/student?page=${this.tmpPage}`)

        this.students = data.data
        this.currentPage = data.current_page,
          this.tmpPage = data.current_page
        this.totalPage = data.last_page
        this.perPage = data.per_page
        this.loadDataDone = true
        this.$router.push({name: 'student', query: { page: this.tmpPage }})
      },
      nextPage() {
        if (this.currentPage >= this.totalPage) {
          return;
        }
        this.tmpPage++;
        this.loadData(this.tmpPage);
      },

      prevPage() {
        if (this.currentPage <= 1) {
          return;
        }
        this.tmpPage--;
        this.loadData(this.tmpPage);
      }
    }

  }
</script>

<style scoped>
</style>
