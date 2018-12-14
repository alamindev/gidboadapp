<template>
  <section>
    <div class="row">
      <div class="col-lg-6">
        <form @submit.prevent="onUpload">
          <div class="alert alert-danger" v-if="success" role="alert">{{ success }}</div>
          <div class="alert alert-danger" v-if="deleteMsg" role="alert">{{ deleteMsg }}</div>
          <div class="alert alert-danger" v-if="hasError" role="alert">{{ hasError }}</div>
          <div class="form-group">
            <label for="images">Upload Image</label>
            <div v-if="uploadFile.images == ''">
              <input
                style="display:none"
                type="file"
                name="images"
                @change="OnFileSelected"
                ref="fileinput"
              >
              <button
                type="button"
                class="btn btn-raised bg-pink btn-lg waves-effect"
                @click="$refs.fileinput.click()"
              >Select Photo</button>
            </div>
            <button
              v-if="uploadFile.images !== ''"
              type="submit"
              class="btn btn-raised btn-info waves-effect btn-lg text-white button-item"
            >Upload</button>
            <button
              v-if="uploadFile.images !== ''"
              type="button"
              @click="reset"
              class="btn btn-raised btn-danger waves-effect btn-lg text-white button-item ml-5"
            >reset</button>
          </div>
          <div class="progress-bar-main" v-if="progress">
            <div class="progress m-b-10">
              <div class="progress-bar progress-bar-success" :style="progress"></div>
            </div>
            <div>
              uploding....
              <span>{{ value }}</span>
            </div>
          </div>
        </form>
      </div>
      <div class="col-lg-6">
        <img width="200" :src="uploadFile.images" v-if="uploadFile.images !== ''" alt="images">
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <button
          type="button"
          class="btn btn-raised bg-cyan waves-effect"
          @click="getAllImage"
        >Get Image Link</button>
        <div class="alert alert-danger" v-if="errorImg" role="alert">{{ errorImg }}</div>
        <div class="show_img_link" v-if="showImages">
          <div class="img-inline" v-for="getImg in showImages" v-bind:key="getImg.id">
            <div class="img">
              <img :src="'/uploads/media/'+ getImg.image" alt="image">
            </div>
            <div class="input_field">
              <input
                type="text"
                :id="'url'+getImg.id"
                :value="base_url + '/uploads/media/'+ getImg.image"
                name="link"
              >
            </div>
            <div class="button-link">
              <button
                type="button"
                class="btn btn-raised bg-deep-orange btn-sm waves-effect"
                @click.stop.prevent="copyUrl(getImg.id)"
              >Copy</button>
              <button
                type="button"
                class="btn btn-raised bg-deep-danger btn-sm waves-effect"
                @click="DeleteData(getImg.id)"
              >Delete</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  data() {
    return {
      uploadFile: {
        images: ""
      },
      hasError: "",
      progress: "",
      value: "",
      success: "",
      showImages: "",
      base_url: "",
      deleteMsg: "",
      errorImg: "",
      uploadReady: true
    };
  },
  methods: {
    OnFileSelected(event) {
      var fileReader = new FileReader();
      fileReader.readAsDataURL(event.target.files[0]);
      fileReader.onload = e => {
        this.uploadFile.images = e.target.result;
      };
    },
    onUpload() {
      let vm = this;
      let url = "howtos/upload";
      axios
        .post(url, this.uploadFile, {
          onUploadProgress: uploadEvent => {
            this.progress =
              "width: " +
              Math.round((uploadEvent.loaded / uploadEvent.total) * 100) +
              "%";
            this.value =
              Math.round((uploadEvent.loaded / uploadEvent.total) * 100) + "%";
          }
        })
        .then(res => {
          this.success = res.data[1];
          this.progress = "";
          this.getAllImage();
          this.deleteMsg = "";
        })
        .catch(error => {
          this.hasError = error.response.data.errors.images[0];
        });
    },
    getAllImage() {
      let vm = this;
      let url = "howtos/upload/all";
      axios.get(url).then(res => {
        let data = res.data;
        if (data.length !== 0) {
          this.showImages = data;
          this.errorImg = "";
        } else {
          this.showImages = "";
          this.errorImg = "No Image found! Please Upload";
        }
      });
    },
    copyUrl(id) {
      let url = document.querySelector("#url" + id);
      url.setAttribute("type", "text");
      url.select();
      window.getSelection().removeAllRanges();
    },
    DeleteData(id) {
      var con = confirm("are you sure!");
      if (con) {
        let vm = this;
        let url = "howtos/upload/delete/" + id;
        axios.get(url).then(res => {
          this.getAllImage();
          this.deleteMsg = res.data.delete;
          this.success = "";
        });
      }
    },
    reset() {
      this.uploadFile.images = "";
    },
    baseUrl() {
      let vm = this;
      let url = "howtos/base-url";
      axios.get(url).then(res => {
        this.base_url = res.data;
      });
    }
  },
  created() {
    this.baseUrl();
  }
};
</script>

<style lang="scss">
.progress-bar-main {
  width: 50%;
}
.progress-bar-main .progress-bar {
  transition: all 0.5s ease;
}
.show_img_link {
  margin-top: 10px;
  border-top: 1px solid #ccc;
}
.img-inline {
  padding-top: 10px;
  display: flex;
  align-items: center;
  .img {
    width: 200px;
    height: auto;
    img {
      width: 100%;
      max-width: 100px;
    }
  }
}
.input_field {
  input {
    width: 200px;
    padding: 5px;
    border-radius: 5px;
    border: 1px solid #ccc;
    margin: 0px 10px;
  }
}
.form-group {
  width: 100%;
  margin-bottom: 0 !important;
}
</style>
