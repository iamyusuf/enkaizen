<template>
  <div class="container">
    <div class="d-flex justify-content-end pt-2">
      <div class="col">
        <b-button v-b-modal.modal-1>Add More Image</b-button>

        <b-modal id="modal-1" title="Image Upload" hide-footer>

          <b-form @submit="onSubmit">

            <b-form-group id="input-group-2" label="URL:" label-for="image_url">
              <b-form-input
                  id="image_url"
                  v-model="url"
                  placeholder="Valid Image URL:"
                  required
              ></b-form-input>
              <span style="color: #550000" v-if="error">{{ error }}</span>
            </b-form-group>

            <b-button type="submit" variant="primary">Submit</b-button>
          </b-form>
        </b-modal>
      </div>

      <div class="col text-right">
        <button class="btn btn-primary" @click="logout">Logout</button>
      </div>
    </div>

    <div class="d-flex mt-3 flex-wrap justify-content-start">
      <div class="col" v-for="image in first10Images" :key="image.id">
        <img :src="image.path" alt="Invalid" width="200px">
      </div>
    </div>
  </div>
</template>

<script>

  // import axios from 'axios';
  import axios from './../api';
  import * as toastr from 'toastr';
  import Echo from 'laravel-echo';


  export default {
    name: "HomePage",
    data() {
      return {
        images: [],
        url: '',
        error: ''
      }
    },
    computed: {
      first10Images() {
        return this.images.slice(0, 10);
      }
    }
    ,
    methods: {
      async onSubmit(e) {

        e.preventDefault();

        if (!this.url) {
          this.error = 'required';
          return;
        }

        this.$bvModal.hide('modal-1');

        // const token = () => localStorage.getItem('token');

        toastr.info('Processing...');

        await axios.post('/api/image', {
          url: this.url
        });

        this.url = '';
      },

      logout() {
        axios.post('/api/logout').finally(() => {
          localStorage.removeItem('token');
          this.$router.push({ path: '/login'})
        })
      },

      async fetchImages () {
        const res = await axios.get('/api/images');
        this.images = res.data;
      }
    },

    mounted() {
      const userId = JSON.parse(localStorage.getItem('user'))?.id;

      window.Echo = new Echo({
        // authEndpoint: '/broadcasting/auth',
        broadcaster: 'pusher',
        key: 'f6a5eea94d94ec60d9f4',
        cluster: "ap1",
        forceTLS: true
      });

      window.Echo.channel('downloaded').listen(`.fileUploaded.${userId}`,  (data) => {
        this.images.unshift(data.image);
        toastr.success('Completed...');
      });

      this.fetchImages();
    }
  }
</script>


<style scoped>
</style>
