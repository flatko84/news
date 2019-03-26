<template>
  <div class="container">
    <post-component
      v-for="post in posts"
      :key="post.post_id"
      :postid="post.post_id"
      :tempid="post.tempid"
      :title="post.title"
      :user="post.user"
      @savedPost="savedPost"
      @del="del"
      @rem="rem"
      :csrf="csrf"
    ></post-component>
    

    <input type="button" @click="newPost" value="+">
  </div>
</template>

<script>
export default {
  props: ["postsdata", "csrf"],
  data() {
    return {
      posts: JSON.parse(this.postsdata)
    };
  },
  methods: {
    newPost() {
      let formData = new FormData();
      formData.append("title", "-");
      formData.append("content", "-");
      formData.append("image", "-");
      formData.append("tags", "-");
      formData.append("seo_url", "-");
      formData.append("category_id", '0');
      formData.append("_token", this.csrf);
      window.axios.post('/post', formData)
      .then(response => {
        this.posts.push(response.data);
      })
      .catch(error => {
          console.log(error.response.data);
          
        });

      
    },
    savedPost(response){
      let index = this.posts.findIndex(post => post.tempid === response.tempid);
      this.posts[index] = response;
    },
    del(post_id) {
      window.axios
        .post("/post/" + post_id, {
          _method: "DELETE",
          _token: this.csrf
        })
        .then(() => {
          let index = this.posts.findIndex(post => post.post_id === post_id);
          this.posts.splice(index, 1);
        });
    },
    rem(tempid){
      let index = this.posts.findIndex(post => post.tempid === tempid);
          this.posts.splice(index, 1);
    }
  }
  
};
</script>
