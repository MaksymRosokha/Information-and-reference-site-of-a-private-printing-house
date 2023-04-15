<template>
  <form @submit.prevent="sendData" class="product-deleter">
    <h3 class="product-deleter__title">Видалення продукту</h3>
    <label class="product-deleter__label" for="services">Послуга: </label>
    <select v-model="serviceID"
            @change="showProducts"
            id="services"
            class="product-deleter__input-field product-deleter__input-field--select"
            name="service"
            required>
      <option v-for="service in this.services" :value="service.id">{{ service.name }}</option>
    </select>

    <label class="product-deleter__label" for="products">Продукт: </label>
    <select v-model="productID"
            id="products"
            class="product-deleter__input-field product-deleter__input-field--select"
            name="product"
            required>
      <option v-for="product in this.productsOfService" :value="product.id">{{ product.name }}</option>
    </select>

    <input type="hidden" name="_token" :value="csrf">
    <button class="product-deleter__submit" type="submit">Видалити</button>

    <success-or-fail-modal-window
        class="product-deleter__result-window result-window"
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
  name: "ProductDeleter",

  data() {
    return {
      serviceID: 0,
      productID: 0,
      productsOfService: [],
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
    showProducts() {
      this.productsOfService = [];

      this.products.forEach(product => {
        if (product.service_id === this.serviceID) {
          this.productsOfService.push(product);
        }
      });
    },
    sendData() {
      this.result.errors = {};
      const formData = new FormData();
      formData.append('id', this.productID);
      formData.append('_token', this.csrf);

      axios.post(this.link, formData)
          .then(response => {
            this.result.text = "Продукт успішно видалений";
            this.result.type = "success";
            this.result.isVisible = true;
          })
          .catch(error => {
            if (error.response && error.response.data && error.response.data.errors) {
              this.result.errors = error.response.data.errors;
              this.result.text = "Не вдалося видалити продукт";
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
.product-deleter {
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

  &__label {
    align-self: flex-start;
    font-size: 1.1em;
    font-weight: 600;
  }

  &__input-field {
    width: 100%;

    &--select {

    }
  }

  &__submit {
    margin-top: 20px;
    background-color: #d90000;
    color: white;
    transition: background-color .5s;
    width: 60%;
    border-radius: 7px;
    font-size: 1.1em;
    border: none;

    &:hover {
      background-color: #ff1616;
      color: white;
    }
  }

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