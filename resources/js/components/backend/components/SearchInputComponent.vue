<template>
  <div>
    <div class="input-group search-area">
     <vs-input color="rgb(30, 32, 79)" gradient :placeholder="label" v-model="query" v-on:keyup="searchQuery" />
      <span class="input-group-text" v-if="name"><a role="button" @click="searchQuery">
          <i class="fas fa-search"></i></a>
    </span>
    </div>
  </div>
</template>

<script>
export default {
props:['label','name','apiurl'],
 data() {
    return {
      query: "",
    };
  },
  methods: {
     openLoading() {
          const loading = this.$vs.loading({text:'rectangle'})
          setTimeout(() => {
            loading.close()
          }, 2000)
        },
    //asyncdata
    searchQuery: _.debounce(
      function () {
        this.openLoading();
        this.$emit("loading", true);
        setTimeout(() => {
            this.search();
        }, 700);
      },
      500 // 500 milliseconds
    ),
   async search() {
      if (this.query.length > 2) {
       await axios.get(this.apiurl + "&query=" + this.query)
          .then((response) => {
            this.$emit("loading", false);
            this.$emit("filterList", response.data);
            this.$emit("query", this.query);
          });
      } else {
        this.query = "";
        this.$emit("query", this.query);
        this.$emit("reload");
      }
    },
  },
  watch: {
    query() {
      if (this.query == "") {
        this.query = "";
        this.$emit("query", this.query);
        this.$emit("reload");
      }
    },
  },
}
</script>

<style>
 .vs-input {
    width: 100%;
}
</style>