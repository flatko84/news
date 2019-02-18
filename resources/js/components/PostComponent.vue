<template>
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card card-default">
        <b>{{ title }}</b>
        {{ user }}
        <button @click="toggleEdit">Edit</button>
        <form-component v-if="edit" :postid="postid" categories="[]" :csrf="csrf" :action="action"></form-component>
        <button @click="del">Delete</button>
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
      return "/post/" + this.postid + "/update";
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
