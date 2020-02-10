<template>
  <form>
    <div class="form-group">
      <label>Student code <small class="text-danger">*</small></label>
      <input :class="{'is-invalid': checkError(errors.code)}" v-model="student.code" :readonly="student.id > 0"
             type="text" class="form-control">
      <LabelError :message="errors.code"/>
    </div>
    <div class="form-group">
      <label>Name <small class="text-danger">*</small></label>
      <input :class="{'is-invalid': checkError(errors.name)}" v-model="student.name" type="text" class="form-control">
      <LabelError :message="errors.name"/>
    </div>
    <div class="form-group">
      <label>Age <small class="text-danger">*</small></label>
      <input :class="{'is-invalid': checkError(errors.age)}" v-model="student.age" type="text" class="form-control">
      <LabelError :message="errors.age"/>
    </div>
    <div class="form-group">
      <label>Gender <small class="text-danger">*</small></label>
      <select :class="{'is-invalid': checkError(errors.gender)}" v-model="student.gender" class="form-control">
        <option value="">-- Select --</option>
        <option value="1">Male</option>
        <option value="0">Female</option>
      </select>
      <LabelError :message="errors.gender"/>
    </div>
    <div class="form-group">
      <label>Email <small class="text-danger">*</small></label>
      <input :class="{'is-invalid': checkError(errors.email)}" v-model="student.email" type="text" class="form-control">
      <LabelError :message="errors.email"/>
    </div>
    <div class="form-group">
      <label>Address <small class="text-danger">*</small></label>
      <input :class="{'is-invalid': checkError(errors.address)}" v-model="student.address" type="text"
             class="form-control">
      <LabelError :message="errors.address"/>
    </div>

    <NLink class="btn btn-outline-primary" :to="{name: 'student'}">
      <i class="fa fa-chevron-left"></i> Back
    </NLink>
    <button type="button" class="btn btn-primary" @click="submitStudent">
      <i class="fa fa-save"></i> Save
    </button>
  </form>
</template>

<script>
  import LabelError from '~/components/LabelError.vue'

  export default {
    components: {LabelError},
    props: {
      edit: {
        type: Boolean,
        default: false
      },
      student: {
        type: Object,
        require: false,
        default:() => {
          return {
            id: 0,
            code: '',
            name: '',
            age: '',
            gender: '',
            email: '',
            address: '',
          }
        }
      }
    },
    data() {
      return {
        errors: {
          code: '',
          name: '',
          age: '',
          gender: '',
          email: '',
          address: '',
        },
        isError: false
      }
    },
    methods: {
      checkError(message) {
        return message.length > 0
      },
      validateForm() {
        Object.keys(this.errors).forEach(key => {
          this.$set(this.errors, key, '')
        })

        Object.keys(this.student).forEach(key => {
          this.$set(this.student, key, this.student[key].toString().trim())
        })

        //check student code
        if (this.student.code.length == 0) {
          this.errors.code = 'The code field is required.'
        } else if (this.student.code.split(' ') > 1) {
          this.errors.code = 'Student code must not contain spaces.'
        }

        //check student name
        if (this.student.name.length == 0) {
          this.errors.name = 'The name field is required.'
        }

        //check age
        if (!this.student.age) {
          this.errors.age = 'The age field is required.'
        } else if (isNaN(this.student.age)) {
          this.errors.age = 'The age must be an integer.'
        } else {
          let age = parseInt(this.student.age);
          if (age == 0) {
            this.errors.age = 'The gender field is required.'
          } else if (age < 18) {
            this.errors.age = 'The age must be at least 18.'
          } else if (age > 35) {
            this.errors.age = 'The age may not be greater than 35.'
          }
        }

        //check gender
        if (!this.student.gender) {
          this.errors.gender = 'The gender field is required.'
        }

        //check email
        if (!this.student.email) {
          this.errors.email = 'The email field is required.'
        } else if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(this.student.email) == false) {
          this.errors.email = 'The email must be a valid email address.'
        }

        //check address
        if (!this.student.address) {
          this.errors.address = 'The address field is required.'
        }

        this.isError = false
        Object.keys(this.errors).forEach(key => {
          if (this.errors[key].length > 0) {
            this.isError = true;
          }
        })
      },

      async submitStudent() {
        this.validateForm()
        if (this.isError) {
          return
        }

        if (this.student.id == 0) {
          await this.$axios.$post(`api/student`, this.student).then((data) => {
            this.$router.push({name: 'student', params: {message: 'Create student success.'}})
          }).catch((error) => {
            if (error.response.data.status == 404) {
              Object.keys(error.response.data.message).forEach(key => {
                this.$set(this.errors, key, error.response.data.message[key][0])
              })
              this.isError = true
            }
          });
        } else {
          await this.$axios.$put(`api/student/${this.student.id}`, this.student).then((data) => {
            this.$router.push({name: 'student', params: {message: 'Edit student success.'}})
          }).catch((error) => {
            if (error.response.data.status == 404) {
              Object.keys(error.response.data.message).forEach(key => {
                this.$set(this.errors, key, error.response.data.message[key][0])
              })
              this.isError = true
            }
          });
        }
      }
    }
  }
</script>

<style scoped>

</style>
