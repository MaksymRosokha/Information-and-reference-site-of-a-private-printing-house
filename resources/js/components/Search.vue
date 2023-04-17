<template>
  <form class="search" method="get" action="/service/{{ this.service }}/search={{ this.text }}">
    <input class="search__input-field" name="text" type="text" v-bind:value="text" ref="searchInput">
    <input name="serviceID" :value="this.service" type="hidden">
    <input type="hidden" name="_token" :value="csrf">
    <button class="search__submit" type="submit">Шукати</button>
  </form>
</template>

<script>
export default {
  name: "Search",
  data() {
    return {
      text: '',
    };
  },
  props: {
    service: {
      type: Number,
      required: true,
    },
  },
  computed: {
    csrf() {
      return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    },
  }
}
</script>

<style scoped lang="scss">
.search {
  width: 100%;
  display: flex;
  justify-content: center;

  &__input-field {
    width: 300px;
    border-bottom-left-radius: 25px;
    border-top-left-radius: 25px;
    padding: 1px 5px 1px 10px;
    border: solid 1px #3b0072;
    border-right: none;
    background-color: #f9e9ff;
  }

  &__submit {
    border-bottom-right-radius: 25px;
    border-top-right-radius: 25px;
    border: solid 1px #3b0072;
    border-left: none;
    background-color: darkviolet;
    color: white;
    transition: background-color .5s;
    padding: 1px 5px 1px 5px;

    &:hover {
      background-color: #b300ff;
    }
  }
}
</style>