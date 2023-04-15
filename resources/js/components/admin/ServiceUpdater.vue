<template>
  <form @submit.prevent="sendData" enctype="multipart/form-data" class="service-updater">
    <h3 class="service-updater__title">Редагування послуги</h3>

    <label class="service-updater__label" for="service">Послуга: </label>
    <select v-model="serviceID"
            @change="showContentForUpdate"
            id="service"
            class="service-updater__input-field service-updater__input-field--select"
            name="service"
            required>
      <option v-for="service in this.services" :value="service.id">{{ service.name }}</option>
    </select>

    <div v-if="isVisibleContent" class="service-updater__content-for-update">
      <label class="service-updater__label" for="type">Тип: </label>
      <select v-model="type"
              id="type"
              class="service-updater__input-field service-updater__input-field--select"
              name="type"
              required>
        <option value="printing service" selected>Поліграфічна послуга</option>
        <option value="notary">Для нотаріата</option>
      </select>

      <label class="service-updater__label" for="name">Назва: </label>
      <input id="name"
             v-model="name"
             class="service-updater__input-field service-updater__input-field--text"
             type="text"
             name="name"
             maxlength="100"
             required>

      <label class="service-updater__label" for="image">Картинка: </label>
      <input id="image"
             ref="imageInput"
             class="service-updater__input-field service-updater__input-field--file"
             type="file"
             name="image"
             accept="image/*"
             @change="setImage">

      <input type="hidden" name="_token" :value="csrf">
      <button class="service-updater__submit" type="submit">Редагувати</button>
    </div>

    <success-or-fail-modal-window
        class="service-updater__result-window result-window"
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
  name: "ServiceUpdater",

  data() {
    return {
      isVisibleContent: false,
      serviceID: 0,
      name: '',
      type: '',
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
    showContentForUpdate() {
      this.isVisibleContent = true;
    },
    sendData() {
      this.result.errors = {};
      const formData = new FormData();
      formData.append('serviceID', this.serviceID);
      formData.append('type', this.type);
      formData.append('name', this.name);
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
            this.name = '';
            this.$refs.imageInput.value = null;
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
.service-updater {
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