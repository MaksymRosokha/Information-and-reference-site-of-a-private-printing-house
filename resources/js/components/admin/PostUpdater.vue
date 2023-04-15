<template>
  <form @submit.prevent="sendData" enctype="multipart/form-data" class="post-updater">
    <h3 class="post-updater__title">Редагування поста</h3>

    <label class="post-updater__label" for="posts">Пост: </label>
    <select v-model="postID"
            @change="showContentForUpdate"
            id="posts"
            class="post-updater__input-field post-updater__input-field--select"
            name="post"
            required>
      <option v-for="post in this.posts" :value="post.id">{{ post.title }}</option>
    </select>

    <div v-if="isVisibleContent" class="post-updater__content-for-update">
      <label class="post-updater__label" for="title">Заголовок: </label>
      <input v-model="title"
             id="title"
             class="post-updater__input-field post-updater__input-field--text"
             type="text"
             name="title"
             maxlength="200"
             required>

      <label class="post-updater__label" for="image">Картинка: </label>
      <input id="image"
             ref="imageInput"
             class="post-updater__input-field post-updater__input-field--file"
             type="file"
             name="image"
             accept="image/*"
             @change="setImage">

      <label class="post-updater__label" for="type">Вміст: </label>
      <textarea v-model="content"
                id="type"
                class="post-updater__input-field post-updater__input-field--textarea"
                name="description"
                maxlength="3000"
                required>
    </textarea>

      <input type="hidden" name="_token" :value="csrf">
      <button class="post-updater__submit" type="submit">Редагувати</button>
    </div>

    <success-or-fail-modal-window
        class="post-updater__result-window result-window"
        v-if="result.isVisible"
        @close-modal-window="closeResultWindow"
        :text="this.result.text"
        :type="this.result.type">
      <div class="result-window__errors" v-if="Object.keys(result.errors).length">
        <ul class="result-window__list-of-errors">
          <li class="result-window__error" v-for="(error, key) in result.errors" :key="key">
            {{ error }}
          </li>
        </ul>
      </div>
    </success-or-fail-modal-window>
  </form>
</template>

<script>
export default {
  name: "PostUpdater",

  data() {
    return {
      isVisibleContent: false,
      postID: 0,
      title: '',
      content: '',
      image: '',
      _token: this.csrf,
      result: {
        errors: {},
        isVisible: false,
        text: "",
        type: ''
      },
    }
  },
  props: {
    link: {
      type: String,
      required: true,
    },
    posts: {
      type: [],
      required: true,
    }
  },
  methods: {
    setImage(event) {
      this.image = event.target.files[0];
    },
    showContentForUpdate() {
      this.isVisibleContent = true;
    },
    sendData() {
      this.result.errors = {};
      const formData = new FormData();
      formData.append('postID', this.postID);
      formData.append('title', this.title);
      formData.append('content', this.content);
      formData.append('image', this.image);
      formData.append('_token', this.csrf);

      axios.post(this.link, formData, {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      })
          .then(response => {
            this.result.text = "Пост успішно відредагований";
            this.result.type = "success";
            this.result.isVisible = true;
            this.name = '';
            this.$refs.imageInput.value = null;
          })
          .catch(error => {
            if (error.response && error.response.data && error.response.data.errors) {
              this.result.errors = error.response.data.errors;
              this.result.text = "Не вдалося відредагувати пост";
              this.result.type = "fail";
              this.result.isVisible = true;
            }
          });
    },
    closeResultWindow() {
      this.result.isVisible = false;
    }
  },
  computed: {
    csrf() {
      return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    },
  }
}
</script>

<style scoped lang="scss">
.post-updater {
  display: flex;
  flex-direction: column;
  align-items: center;

  &__title {
    width: fit-content;
    background-color: red;
    color: #ffffff;
    text-align: center;
    padding: 15px;
    border-radius: 15px;
    font-weight: 700;
    font-size: 1.3em;
    box-shadow: 0 0 3px 0 #620000;
  }

  &__content-for-update {
    width: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-top: 2vw;
  }

  &__label {
    align-self: flex-start;
    font-size: 1.1em;
    font-weight: 600;
  }

  &__input-field {
    width: 100%;

    &--select{

    }

    &--text {

    }

    &--file {
    }

    &--textarea {
      height: 100px;
      resize: none;
    }
  }

  &__submit {
    margin-top: 20px;
    background-color: #162939;
    color: white;
    transition: background-color .5s;
    width: 60%;
    border-radius: 7px;
    font-size: 1.1em;

    &:hover {
      background-color: #4b5569;
      color: white;
    }
  }

  &__result-window {
  }
}

.result-window {


  &__errors {
  }

  &__list-of-errors {
  }

  &__error {
  }
}
</style>