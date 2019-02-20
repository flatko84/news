<template>
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card card-default">
        <table border=1 width=100%>
          <tr>
            <td style="width: 500px">
              <b>{{ titleRender }}</b> - 
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
        <form-component
          v-if="edit"
          :postid="postidRender"
          :csrf="csrf"
          :action="action"
          @editPost="editPost"
          @savedPost="savedPost"
        ></form-component>
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
      userRender: this.user
    };
  },
  computed: {
    action: function() {
      let action = "/post/";
      if (this.postidRender && this.postidRender != "undefined") { action += this.postidRender; };
      return action;
    }
  },
  methods: {
    savedPost(post){
      this.postidRender = post.post_id;
      this.titleRender = post.title;
      this.userRender = "You";
      this.edit = false;
      let response = {
        post_id: post.post_id,
        title: post.title,
        tempid: this.tempid,
        user: "You"
      };
      this.$emit('savedPost', response);
    },
    editPost(title) {
      this.titleRender = title;
    },
    toggleEdit() {
      this.edit = this.edit === true ? false : true;
    },
    del() {
      let c = confirm("Delete " + this.titleRender + "?");
      if (c == true) {
        this.$emit("del", this.postidRender);
      }
    },
    rem(){
      let c = confirm("Cancel new article?");
      if (c == true) {
      this.$emit('rem', this.tempid);
      }
    }
  }
};
</script>
