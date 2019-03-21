<template>
  <div>
    <form
      method="put"
      id="post-form"
      enctype="multipart/form-data"
      :action="action"
      @submit.prevent="sendArticle"
    >
      <input type="hidden" :value="csrf" name="_token">
      <div v-if="success">Success!</div>
      <table>
        <tr>
          <td>Title:</td>
          <td>
            <input type="text" name="title" v-model="post.title">
          </td>
          <td>
            <div v-if="errors.title" id="title-error" class="error">{{ errors.title['0'] }}</div>
          </td>
        </tr>
        <tr>
          <td>Content:</td>
          <td>
            <textarea name="content" v-model="post.content"></textarea>
          </td>
          <td>
            <div v-if="errors.content" id="content-error" class="error">{{ errors.content['0'] }}</div>
          </td>
        </tr>
        <tr>
          <td>Image:</td>
          <td>
            <image-upload-component v-if="showImage" @changedimage="changeImage" :src="post.image"></image-upload-component>
          </td>
          <td>
            <div v-if="errors.image" id="image-error" class="error">{{ errors.image['0'] }}</div>
          </td>
        </tr>
        <tr>
          <td>Tags:</td>
          <td>
            <input type="text" name="tags" v-model="post.tags">
          </td>
          <td>
            <div v-if="errors.tags" id="tags-error" class="error">{{ errors.tags['0'] }}</div>
          </td>
        </tr>
        <tr>
          <td>SEO URL:</td>
          <td>
            <input type="text" name="seo_url" v-model="post.seo_url">
          </td>
          <td>
            <div v-if="errors.seo_url" id="seo_url-error" class="error">{{ errors.seo_url['0'] }}</div>
          </td>
        </tr>
        <tr>
          <td>Category:</td>
          <td>
            <select name="category_id" v-model="post.category_id">
              <option
                v-for="category in categories"
                :value="category.category_id"
                :key="category.category_id"
              >{{ category.title }}</option>
            </select>
          </td>
          <td>
            <div v-if="errors.category_id" id="category_id-error" class="error">{{ errors.category_id['0'] }}</div>
          </td>
        </tr>
        <tr>
          <td></td>
          <td>
            <input type="submit" value="Publish">
          </td>
        </tr>
      </table>
    </form>
  </div>
</template>

<script>
export default {
  props: ["action", "csrf", "postid"],
  data() {
    let data = {};
    data.post = {};
    data.categories = {};
    data.success = false;
    data.errors = {};
    return data;
  },
  methods: {
    changeImage(imageblob) {
      this.post.image = imageblob;
    },
    sendArticle() {
      let formData = new FormData();
      if (this.post.title) {
        formData.append("title", this.post.title);
      }
      if (this.post.content) {
        formData.append("content", this.post.content);
      }
      if (typeof this.post.image === "object") {
        formData.append("image", this.post.image);
      }
      if (this.post.tags) {
        formData.append("tags", this.post.tags);
      }
      if (this.post.seo_url) {
        formData.append("seo_url", this.post.seo_url);
      }
      if (this.post.category_id) {
        formData.append("category_id", this.post.category_id);
      }
      formData.append("_token", this.csrf);
      if (typeof this.post.post_id !== "undefined") {
        formData.append("_method", "PUT");
      }
      window.axios
        .post(this.action, formData)
        .then(response => {
          if (typeof this.post.post_id !== "undefined") {
            this.$emit("editPost", this.post.title);
          } else {
            this.$emit("savedPost", response.data);
          }
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
    showImage: function() {
      return !this.postid || this.post.image ? true : false;
    }
  },
  mounted() {
    if (this.postid) {
      window.axios
        .get("/post/" + this.postid + "/edit")
        .then(response => {
          this.post = response.data.post;
          if (this.post.image == "") {
            this.post.image = "-";
          }
        })
        .catch(errors => {
          console.log(errors.response);
        });
    }
    window.axios.get("/category").then(response => {
      this.categories = response.data;
    });
  }
};
</script>
