<template>
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card card-default">
        <table border="1" width="100%">
          <tr>
            <td style="width: 500px">
              <b>{{ titleRender }}</b>
              -
              {{ userRender }}
            </td>
            <td>
              <input type="button" @click="toggleEdit" value="Edit">
            </td>
            <td>
              <input v-if="postidRender" type="button" @click="del" value="Delete">
              <input v-else type="button" @click="rem" value="Cancel">
            </td>
          </tr>
        </table>
        <div v-if="edit">
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
                  <div
                    v-if="errors.content"
                    id="content-error"
                    class="error"
                  >{{ errors.content['0'] }}</div>
                </td>
              </tr>
              <tr>
                <td>Image:</td>
                <td>
                  <image-upload-component
                    v-if="showImage"
                    @changedimage="changeImage"
                    :src="post.image"
                  ></image-upload-component>
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
                  <div
                    v-if="errors.seo_url"
                    id="seo_url-error"
                    class="error"
                  >{{ errors.seo_url['0'] }}</div>
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
                  <div
                    v-if="errors.category_id"
                    id="category_id-error"
                    class="error"
                  >{{ errors.category_id['0'] }}</div>
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
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["tempid", "postid", "title", "user", "csrf"],
  data() {
    return {
      edit: false,
      postidRender: this.postid,
      titleRender: this.title,
      tempidRender: this.tempid,
      userRender: this.user,
      post: {},
      categories: {},
      success: false,
      errors: {}
    };
  },
  computed: {
    action: function() {
      let action = "/post/";
      if (this.postidRender && this.postidRender != "undefined") {
        action += this.postidRender;
      }
      return action;
    },
    showImage: function() {
      return !this.postid || this.post.image ? true : false;
    }
  },
  methods: {
    toggleEdit() {
      this.edit = this.edit === true ? false : true;
    },
    del() {
      let c = confirm("Delete " + this.titleRender + "?");
      if (c == true) {
        this.$emit("del", this.postidRender);
      }
    },
    rem() {
      let c = confirm("Cancel new article?");
      if (c == true) {
        this.$emit("rem", this.tempid);
      }
    },
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
            this.titleRender = this.post.title;
           
          } else {
            this.postidRender = response.data.post_id;
            this.titleRender = response.data.title;
            this.userRender = "You";
            this.edit = false;
            let response = {
              post_id: response.data.post_id,
              title: response.data.title,
              tempid: this.tempid,
              user: "You"
            };
            this.$emit("savedPost", response);
            
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
