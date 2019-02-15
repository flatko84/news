<template>
  <div>
    <input ref="image" type="file" @change="setImage"><br>
    <img :src="filename">
  </div>
</template>

<script>
export default {
  props: ["src"],
  data() {
    return {
      filename: ""
    };
  },

  methods: {
      setImage(){
         this.filename = URL.createObjectURL(this.$refs.image.files[0]);
         this.$emit('changedimage', this.$refs.image.files[0]);
      }
  },
  mounted() {
    this.filename = "/storage/" + this.src;
  }
};
</script>
