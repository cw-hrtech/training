<template>
  <div>
    <h1>Student list</h1>
    <div class="mb-3">
      <NLink class="btn btn-outline-primary" :to="{name: 'index'}">
        <i class="fa fa-home"></i> Home Page
      </NLink>
      <NLink class="btn btn-outline-primary" :to="{name: 'student'}">
        <i class="fa fa-home"></i> List
      </NLink>
      <NLink class="btn btn-outline-primary" :to="{name: 'student-create'}">
        <i class="fa fa-plus"></i> Add new student
      </NLink>
    </div>
    <b-alert v-if="message.length > 0" show variant="success">{{message}}</b-alert>
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
        <th style="width: 80px"></th>
      </tr>
      </thead>
      <tbody>
      <tr v-if="students.length == 0">
        <td colspan="7">Data not found</td>
      </tr>
      <tr v-for="(item, index) in students" :key="index">
        <td>{{(currentPage - 1) * perPage + index + 1}}</td>
        <td>
          <NLink :to="{name:'student-edit-id', params: {id: item.id}}">
            {{item.code}}
          </NLink>
        </td>
        <td>{{item.name}}</td>
        <td>{{item.age}}</td>
        <td class="text-center">
          <i v-if="item.gender == 1" class="fa fa-mars"></i>
          <i v-if="item.gender == 0" class="fa fa-venus"></i>
        </td>
        <td>{{item.email}}</td>
        <td>{{item.address}}</td>
        <td>
          <NLink :to="{name:'student-edit-id', params: {id: item.id}}">
            <i class="fa fa-edit"></i>
          </NLink>
          <a @click="showMsgBoxOne(item.id)"><i class="fa fa-trash text-danger"></i></a>
        </td>
      </tr>
      </tbody>
    </table>
    <div class="text-center">
      <div class="pr-3 d-inline">
        Page: <strong>{{currentPage}}</strong>/{{totalPage}}
      </div>
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
        loadDataDone: false,
        message: ''
      }
    },
    async asyncData({$axios, route}) {
      let page = route.query.page == undefined ? 1 : route.query.page
      let message = route.params.message == undefined ? '' : route.params.message
      let {data} = await $axios.$get(`api/student?page=${page}`)
      return {
        students: data.data,
        currentPage: data.current_page,
        tmpPage: data.current_page,
        totalPage: data.last_page,
        perPage: data.per_page,
        loadDataDone: true,
        message: message
      }
    },
    methods: {
      async loadData(page) {
        this.loadDataDone = false
        let {data} = await this.$axios.$get(`api/student?page=${this.tmpPage}`)

        this.students = data.data
        if (this.students.length == 0) {
          return this.$router.push({name: 'student'})
        }
        this.currentPage = data.current_page,
          this.tmpPage = data.current_page
        this.totalPage = data.last_page
        this.perPage = data.per_page
        this.loadDataDone = true
        this.$router.push({name: 'student', query: {page: this.tmpPage}})
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
      },
      showMsgBoxOne(id) {
        this.$bvModal.msgBoxConfirm('Are you sure?')
          .then(value => {
            if (value) {
              this.deleteStudent(id)
            }
          })
          .catch(err => {
          })
      },
      async deleteStudent(id) {
        await this.$axios.$delete(`api/student/${id}`).then(response => {
          this.message = 'Delete student success.';
          this.reloadData()
        }).catch(error => {
        })
      },
      reloadData() {
        this.loadData(this.currentPage);
      }
    }

  }
</script>

<style scoped>
</style>
