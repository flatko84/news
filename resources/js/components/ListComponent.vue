<template>
  <div class="container">
    <post-component
      v-for="post in posts"
      :key="post['post_id']"
      :postid="post['post_id']"
      :title="post['title']"
      :user="post['user']"
      @del="del"
      csrf="csrf"
    ></post-component>
  </div>
</template>

<script>
export default {
  props: ['postsdata', 'csrf'],
  data() {
    return {
      posts: JSON.parse(this.postsdata)
    };
  },
  methods: {
    del(post_id) {
      window.axios.post("/post/" + post_id, {
          _method: 'DELETE',
          _token: this.csrf
      }).then(() => {
        let index = this.posts.findIndex(post => post.post_id === post_id);
          this.posts.splice(index, 1);
      });
    }
  }
};
</script>
