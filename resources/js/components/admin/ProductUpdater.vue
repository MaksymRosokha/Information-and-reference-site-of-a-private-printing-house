<template>
  <form @submit.prevent="sendData" enctype="multipart/form-data" class="product-updater">
    <h3 class="product-updater__title">Редагування продукту</h3>

    <label class="product-updater__label" for="services">Послуга: </label>
    <select v-model="serviceID"
            @change="showProducts"
            id="services"
            class="product-updater__input-field product-updater__input-field--select"
            name="service"
            required>
      <option v-for="service in this.services" :value="service.id">{{ service.name }}</option>
    </select>

    <label class="product-updater__label" for="products">Продукт: </label>
    <select v-model="productID"
            @change="showContentForUpdate"
            id="products"
            class="product-updater__input-field product-updater__input-field--select"
            name="product"
            required>
      <option v-for="product in this.productsOfService" :value="product.id">{{ product.name }}</option>
    </select>

    <div v-if="isVisibleContent" class="product-updater__content-for-update">
      <label class="product-updater__label" for="name">Назва: </label>
      <input id="name"
             v-model="name"
             class="product-updater__input-field product-updater__input-field--text"
             type="text"
             name="name"
             maxlength="100"
             required>

      <label class="product-updater__label" for="price">Ціна: </label>
      <input id="price"
             v-model="price"
             class="product-updater__input-field product-updater__input-field--number"
             type="number"
             step="0.01"
             name="price"
             min="0"
             required>

      <label class="product-updater__label" for="services-for-update">Послуга: </label>
      <select v-model="newServiceID"
              id="services-for-update"
              class="product-updater__input-field product-updater__input-field--select"
              name="service"
              required>
        <option v-for="service in this.services" :value="service.id">{{ service.name }}</option>
      </select>

      <label class="product-updater__label" for="image">Картинка: </label>
      <input id="image"
             ref="imageInput"
             class="product-updater__input-field product-updater__input-field--file"
             type="file"
             name="image"
             accept="image/*"
             @change="setImage">

      <input type="hidden" name="_token" :value="csrf">
      <button class="product-updater__submit" type="submit">Редагувати</button>
    </div>

    <success-or-fail-modal-window
        class="product-updater__result-window result-window"
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
  name: "ProductUpdater",

  data() {
    return {
      isVisibleContent: false,
      serviceID: 0,
      productsOfService: [],
      productID: 0,
      name: '',
      price: 0,
      newServiceID: 0,
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
      type: [],
      required: true,
    },
    products: {
      type: [],
      required: true,
    }
  },
  methods: {
    setImage(event) {
      this.image = event.target.files[0];
    },
    showProducts() {
      this.productsOfService = [];
      this.isVisibleContent = false;

      this.products.forEach(product => {
        if (product.service_id === this.serviceID) {
          this.productsOfService.push(product);
        }
      });
    },
    showContentForUpdate() {
      this.isVisibleContent = true;
      this.clearFields();
    },
    clearFields(){
      this.name = '';
      this.price = 0;
      this.$refs.imageInput.value = null;
    },
    sendData() {
      this.result.errors = {};
      const formData = new FormData();
      formData.append('serviceID', this.newServiceID);
      formData.append('productID', this.productID);
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
            this.result.text = "Послуга успішно відредагована";
            this.result.type = "success";
            this.result.isVisible = true;
            this.clearFields();
          })
          .catch(error => {
            if (error.response && error.response.data && error.response.data.errors) {
              this.result.errors = error.response.data.errors;
              this.result.text = "Не вдалося відредагувати послугу";
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
.product-updater {
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

    &--select {

    }

    &--text {

    }

    &--file {
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