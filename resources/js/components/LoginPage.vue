<template>
  <div class="container">
    <div class="row margin-auto">
      <div class="col-md-4 offset-md-4">
        <b-form @submit="onSubmit" @reset="onReset" v-if="show">
          <b-form-group
              id="input-group-1"
              label="Email"
              label-for="email"
          >
            <b-form-input
                id="email"
                v-model="form.email"
                type="email"
                placeholder="Enter email"
                required
            ></b-form-input>
          </b-form-group>

          <b-form-group id="input-group-2" label="Password:" label-for="input-2">
            <b-form-input
                id="input-2"
                v-model="form.password"
                placeholder="Password"
                type="password"
                required
            ></b-form-input>
          </b-form-group>

          <b-button type="submit" variant="primary">Submit</b-button>
          <b-button type="reset" variant="danger">Reset</b-button>
        </b-form>
      </div>
    </div>
  </div>
</template>

<script>
  import axios from 'axios';

  export default {
    name: "LoginPage",
    data() {
      return {
        form: {
          email: '',
          password: ''
        },
        show: true
      }
    },
    methods: {
      onSubmit(event) {
        event.preventDefault();

        axios.post('/api/login', {
          email: this.form.email,
          password: this.form.password
        }).then(res => {
          const token = res.data.token;
          axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
          localStorage.setItem('token', token);
          localStorage.setItem('user', JSON.stringify(res.data.user));
          this.$router.push({ path: '/'})
        })


      },
      onReset(event) {
        event.preventDefault();
        this.form.email = '';
        this.form.password = '';
        this.show = false;
        this.$nextTick(() => {
          this.show = true
        })
      },
    },

    beforeMount() {
      const token = localStorage.getItem('token');
      if (token != null && token.length > 0) {
        this.$router.push({ path: '/' })
      }
    }
  }
</script>

<style scoped>

</style>
