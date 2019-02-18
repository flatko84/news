<template>
   
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                   	
								<b>{{ title }}</b>
						
								{{ user }}
						
								<a :href="edit">Edit</a>
						
								<button @click="del">Delete</button>
							

                </div>
            </div>
        </div>
    
</template>

<script>
    export default {
        props: ['postid', 'title', 'user'],
        data() {
            return {}
        },
        computed: {
            edit: function (){
                return "/post/" + this.postid + "/edit";
            }
        },
        methods: {
            del() {
                let c = confirm("Delete " + this.title + "?");
                if (c == true) {
                    this.$emit('del', this.postid)
                }
            }
        }
    }
</script>
