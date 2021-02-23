<template>
  <div class="container">
    <div class="row">
      <div class="col-md-4 mt-3">
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
    </div>

    <div class="row">

    </div>
  </div>
</template>

<script>

  // import axios from 'axios';
  import axios from './../api';
  import * as toastr from 'toastr';

  export default {
    name: "HomePage",
    data() {
      return {
        images: [],
        url: '',
        error: ''
      }
    },
    methods: {
      async onSubmit(e) {

        e.preventDefault();

        if (!this.url) {
          this.error = 'required';
          return ;
        }

        this.$bvModal.hide('modal-1');

        const token = () => localStorage.getItem('token');

        const res = await axios.post('/api/image', {
          url: this.url
        });

        if (res.status === 200) {
          toastr.success('Processing...');
        }
      },

      getToken() {

      }
    }
  }
</script>

<style scoped>
</style>
