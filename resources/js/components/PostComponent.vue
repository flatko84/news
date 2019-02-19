<template>
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card card-default">
        <b>{{ title }}</b>
        {{ user }}
        <input type="button" @click="toggleEdit" value="Edit">
        <form-component v-if="edit" :postid="postid" :csrf="csrf" :action="action"></form-component>
        <input type="button" @click="del" value="Delete">
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["postid", "title", "user", "csrf"],
  data() {
    return {
      edit: false
    };
  },
  computed: {
    action: function() {
      return "/post/" + this.postid;
    }
  },
  methods: {
    toggleEdit() {

        this.edit = (this.edit === true) ? false : true;
    },
    del() {
      let c = confirm("Delete " + this.title + "?");
      if (c == true) {
        this.$emit("del", this.postid);
      }
    }
  }
};
</script>
