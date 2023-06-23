<template>
  <h1>Students</h1>
  <ul>
    <li
      v-for="(student, i) in students"
      :key="i"
    >
      {{ student.name }} {{ student.lastname }}
      <button 
        type="button"
        style="
          background-color: transparent;
          color: red;
        "
        @click="deleteStudent(i)"
      >X</button>
    </li>
  </ul>
  <form @submit.prevent="onSubmit">
    <label for="name"> Name </label>
    <input type="text" name="name" v-model="newStudent.name">
    <br />
    <label for="lastname"> Lastname </label>
    <input type="text" name="lastname" v-model="newStudent.lastname">
    <br />
    <input type="submit" value="CREATE">
  </form>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    
    return {
      students: [],

      newStudent: {
        name: "",
        lastname: ""
      }
    };
  },
  methods: {

    onSubmit() {

      const url = 'http://localhost/tmp/php/newStudent.php';
      const data = this.newStudent;
      const headers = {
          headers: { 'Content-Type': 'multipart/form-data' } 
      };

      axios.post(url, data, headers)
           .then(res => {
            
            const data = res.data;
            this.students = data;

            this.newStudent.name = "";
            this.newStudent.lastname = "";
           })
    },
    deleteStudent(index) {
      
      const url = 'http://localhost/tmp/php/deleteStudent.php';
      const data = {"index": index};
      const headers = {
          headers: { 'Content-Type': 'multipart/form-data' } 
      };

      axios.post(url, data, headers)
           .then(res => {

            const data = res.data;
            this.students = data;
           });
    }
  },
  mounted() {
    
    axios.get("http://localhost/tmp/php/students.php")
         .then(res => {
          
            const data = res.data;
            this.students = data;
         });    
  }
}
</script>