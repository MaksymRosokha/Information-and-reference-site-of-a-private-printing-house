<template>
  <form @submit.prevent="sendData" enctype="multipart/form-data" class="post-creator">
    <h3 class="post-creator__title">Створення поста</h3>
    <label class="post-creator__label" for="type">Заголовок: </label>
    <input v-model="title"
           id="type"
           class="post-creator__input-field post-creator__input-field--text"
           type="text"
           name="title"
           required>

    <label class="post-creator__label" for="image">Картинка: </label>
    <input id="image"
           ref="imageInput"
           class="post-creator__input-field post-creator__input-field--file"
           type="file"
           name="image"
           accept="image/*"
           @change="setImage">

    <label class="post-creator__label" for="type">Заголовок: </label>
    <textarea v-model="content"
              id="type"
              class="post-creator__input-field post-creator__input-field--textarea"
              name="description"
              maxlength="3000"
              required>

    </textarea>

    <input type="hidden" name="_token" :value="csrf">
    <button class="post-creator__submit" type="submit">Створити</button>

    <success-or-fail-modal-window
        class="post-creator__result-window result-window"
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
  name: "PostCreator",

  data() {
    return {
      title: '',
      image: '',
      content: '',
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
    }
  },
  methods: {
    setImage(event) {
      this.image = event.target.files[0];
    },
    sendData() {
      this.result.errors = {};
      const formData = new FormData();
      formData.append('title', this.title);
      formData.append('image', this.image);
      formData.append('content', this.content);
      formData.append('_token', this.csrf);

      axios.post(this.link, formData, {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      })
          .then(response => {
            this.result.text = "Пост успішно створений";
            this.result.type = "success";
            this.result.isVisible = true;
            this.title = '';
            this.$refs.imageInput.value = null;
            this.content = '';
          })
          .catch(error => {
            if (error.response && error.response.data && error.response.data.errors) {
              this.result.errors = error.response.data.errors;
              this.result.text = "Не вдалося створити пост";
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
.post-creator {
  display: flex;
  flex-direction: column;
  align-items: center;

  // .post-creator__title

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

  // .post-creator__label

  &__label {
    align-self: flex-start;
    font-size: 1.1em;
    font-weight: 600;
  }

  // .post-creator__input-field

  &__input-field {
    width: 100%;
  }

  // .post-creator__input-field--text

  &__input-field--text {
  }

  // .post-creator__input-field--file

  &__input-field--file {
  }

  // .post-creator__input-field--textarea

  &__input-field--textarea {
    min-height: 100px;
    max-height: 200px;
  }

  // .post-creator__result-window

  &__result-window {
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
}


.result-window {

  // .result-window__errors

  &__errors {
  }

  // .result-window__list-of-errors

  &__list-of-errors {
  }

  // .result-window__error

  &__error {
  }
}

</style>