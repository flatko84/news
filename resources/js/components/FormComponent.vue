<template>
  <div>
    <form method="put" id="post-form" enctype="multipart/form-data" :action="action" @submit.prevent="sendArticle">
      <input type="hidden" :value="csrf" name="_token">

      <table>
        <tr>
          <td>Title:</td>
          <td>
            <input type="text" name="title" v-model="title">
          </td>
          <td>
            <div id="title-error" class="error"></div>
          </td>
        </tr>
        <tr>
          <td>Content:</td>
          <td>
            <textarea name="content" v-model="content"></textarea>
          </td>
          <td>
            <div id="content-error" class="error"></div>
          </td>
        </tr>
        <tr>
          <td>Image:</td>
          <td>
            <image-upload-component @changedimage="changeImage" :src="image"></image-upload-component>
          </td>
          <td>
            <div id="image-error" class="error"></div>
          </td>
        </tr>
        <tr>
          <td>Tags:</td>
          <td>
            <input type="text" name="tags" v-model="tags">
          </td>
          <td>
            <div id="tags-error" class="error"></div>
          </td>
        </tr>
        <tr>
          <td>SEO URL:</td>
          <td>
            <input type="text" name="seo_url" v-model="seo_url">
          </td>
          <td>
            <div id="seo_url-error" class="error"></div>
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
            <div id="seo_url-error" class="error"></div>
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
    return JSON.parse(this.post);
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
      .then(response => {console.log(response)})
      .catch(error => {console.log(error.response)});
    }
  },
  computed: {
    categoried: function() {
      return JSON.parse(this.categories);
    }
  }
};
</script>
