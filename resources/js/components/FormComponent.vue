<template>
  <div>
    <form method="put" id="post-form" enctype="multipart/form-data" :action="action" @submit.prevent="sendArticle">
      <input type="hidden" :value="csrf" name="_token">
    <div v-if="success">Success!</div>
      <table>
        <tr>
          <td>Title:</td>
          <td>
            <input type="text" name="title" v-model="title">
          </td>
          <td>
            <div v-if="errors.title" id="title-error" class="error">{{ errors.title['0'] }}</div>
          </td>
        </tr>
        <tr>
          <td>Content:</td>
          <td>
            <textarea name="content" v-model="content"></textarea>
          </td>
          <td>
            <div v-if="errors.content" id="content-error" class="error">{{ errors.content['0'] }}</div>
          </td>
        </tr>
        <tr>
          <td>Image:</td>
          <td>
            <image-upload-component @changedimage="changeImage" :src="image"></image-upload-component>
          </td>
          <td>
            <div v-if="errors.image" id="image-error" class="error">{{ errors.image['0'] }}</div>
          </td>
        </tr>
        <tr>
          <td>Tags:</td>
          <td>
            <input type="text" name="tags" v-model="tags">
          </td>
          <td>
            <div v-if="errors.tags" id="tags-error" class="error">{{ errors.tags['0'] }}</div>
          </td>
        </tr>
        <tr>
          <td>SEO URL:</td>
          <td>
            <input type="text" name="seo_url" v-model="seo_url">
          </td>
          <td>
            <div v-if="errors.seo_url" id="seo_url-error" class="error">{{ errors.seo_url['0'] }}</div>
          </td>
        </tr>
        <tr>
          <td>Category:</td>
          <td>
            <select name="category_id" v-model="category_id">
              <option
                v-for="category in categoried"
                :value="category.category_id"
                :key="category.category_id"
              >{{ category.title }}</option>
            </select>
          </td>
          <td>
            <div id="category_id" class="error"></div>
          </td>
        </tr>
        <tr>
          <td></td>
          <td>
            <input type="submit">
          </td>
        </tr>
      </table>
    </form>
  </div>
</template>

<script>

import ImageUploadComponent from './ImageUploadComponent.vue';
export default {
  props: ["action", "csrf", "post", "categories"],
  data() {
    let data = JSON.parse(this.post);
    data.success = false;
    data.errors = {};
    return data;
  },
  methods: {
    changeImage(imageblob){
      this.image = imageblob;
    },
    sendArticle() {
      let formData = new FormData();
      formData.append('title', this.title);
      formData.append('content', this.content);
      formData.append('image', this.image);
      formData.append('tags', this.tags);
      formData.append('seo_url', this.seo_url);
      formData.append('category_id', this.category_id);
      formData.append('_token', this.csrf);
      if (typeof this.post_id !== 'undefined') {formData.append('_method', 'PUT');}
      window.axios.post(this.action, formData)
      .then(response => {
        if (response.data.post_id) {
          window.location = '/post/' + response.data.post_id + '/edit';
        };
        this.success = true;
        this.errors = {};
        setTimeout(func => {
                this.success = false;
            }, 2000);
      })
      .catch(error => {
        this.errors = error.response.data.errors;
        this.success = false;
        });
    }
  },
  computed: {
    categoried: function() {
      return JSON.parse(this.categories);
    }
  }
};
</script>
