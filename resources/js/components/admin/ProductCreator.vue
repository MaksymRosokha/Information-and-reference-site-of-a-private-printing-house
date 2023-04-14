<template>
  <form @submit.prevent="sendData" enctype="multipart/form-data" class="product-creator">
    <h3 class="product-creator__title">Створення продукту</h3>
    <label class="product-creator__label" for="service">Послуга: </label>
    <select v-model="serviceID"
            id="service"
            class="product-creator__input-field product-creator__input-field--select"
            name="type"
            required>
      <option v-for="service in this.services" :value="service.id">{{ service.name }}</option>
    </select>

    <label class="product-creator__label" for="name">Назва: </label>
    <input id="name"
           v-model="name"
           class="product-creator__input-field product-creator__input-field--text"
           type="text"
           name="name"
           maxlength="300"
           required>

    <label class="product-creator__label" for="price">Ціна: </label>
    <input id="price"
           v-model="price"
           class="product-creator__input-field product-creator__input-field--number"
           type="number"
           name="price"
           required>

    <label class="product-creator__label" for="image">Картинка: </label>
    <input id="image"
           ref="imageInput"
           class="product-creator__input-field product-creator__input-field--file"
           type="file"
           name="image"
           accept="image/*"
           @change="setImage">

    <input type="hidden" name="_token" :value="csrf">
    <button class="product-creator__submit" type="submit">Створити</button>

    <success-or-fail-modal-window
        class="product-creator__result-window result-window"
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
  name: "ProductCreator",

  data() {
    return {
      serviceID: 0,
      name: '',
      price: 0,
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
    services: {
      type: Array,
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
      formData.append('serviceID', this.serviceID);
      formData.append('name', this.name);
      formData.append('price', this.price);
      formData.append('image', this.image);
      formData.append('_token', this.csrf);

      axios.post(this.link, formData, {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      })
          .then(response => {
            this.result.text = "Продукт успішно створений";
            this.result.type = "success";
            this.result.isVisible = true;
            this.name = '';
            this.price = 0;
            this.$refs.imageInput.value = null;
          })
          .catch(error => {
            if (error.response && error.response.data && error.response.data.errors) {
              this.result.errors = error.response.data.errors;
              this.result.text = "Не вдалося створити продукт";
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
.product-creator {
  display: flex;
  flex-direction: column;
  align-items: center;

  // .product-creator__title

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

  // .product-creator__label

  &__label {
    align-self: flex-start;
    font-size: 1.1em;
    font-weight: 600;
  }

  // .product-creator__input-field

  &__input-field {
    width: 100%;
  }

  // .product-creator__input-field--select

  &__input-field--select {
  }

  // .product-creator__input-field--text

  &__input-field--text {
  }

  // .product-creator__input-field--number

  &__input-field--number {
  }

  // .product-creator__input-field--file

  &__input-field--file {
  }

  // .product-creator__submit

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

  // .product-creator__result-window

  &__result-window {
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