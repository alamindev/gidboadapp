<template>
  <section id="upload">
     <!--UPLOAD--> 
        <h5>Upload Photo <span class="text-danger">(Not Required)</span></h5>
        <p class="text-danger">Photo size Must be:- Width: 500px And height: 600px</p>
        <div class="dropbox" v-show="image == null ">
          <input type="file" name="upload"  class="input-file" @change="onFileChange" accept="image/*" >  
            <p >
              Drag your file(s) here to begin<br> or click to browse
            </p> 
        </div>  
        <img  v-if="image != null " :src="image" alt="image" class="img-fluid"> 
        <button v-if="image != null" @click.prevent="reset" class="btn  btn-raised bg-deep-orange waves-effect">reset</button> 
  </section>
</template>

<script>
const STATUS_INITIAL = 0,
  STATUS_SAVING = 1,
  STATUS_SUCCESS = 2,
  STATUS_FAILED = 3;

export default {
  name: "upload",
  data() {
    return {
      image: null,
      currentStatus: null
    };
  },
  methods: {
    reset() {
      // reset form to initial state
      this.currentStatus = STATUS_INITIAL;
      this.image = null;
    },
    onFileChange(e) {
      let files = e.target.files || e.dataTransfer.files;
      if (!files.length) return;
      this.createImage(files[0]);
    },
    createImage(file) {
      let reader = new FileReader();
      let vm = this;
      reader.onload = e => {
        vm.image = e.target.result;
      };
      reader.readAsDataURL(file);
    }
  },
  created() {
    this.reset();
  }
};
</script>

<style>
.dropbox {
  outline: 2px dashed grey; /* the dash box */
  outline-offset: -10px;
  background: lightcyan;
  color: dimgray;
  padding: 10px 10px;
  min-height: 200px; /* minimum height */
  position: relative;
  cursor: pointer;
  margin-bottom: 15px;
}

.input-file {
  opacity: 0; /* invisible but it's there! */
  width: 100%;
  height: 200px;
  position: absolute;
  cursor: pointer;
}

.dropbox:hover {
  background: lightblue; /* when mouse over to the drop zone, change color */
}

.dropbox p {
  font-size: 1.2em;
  text-align: center;
  padding: 50px 0;
}
.thumbnail {
  position: relative;
}
.thumbnail span {
  position: absolute;
  right: -9px;
  top: -12px;
  background: #ff86eb;
  color: #040010;
  padding: 5px 12px;
  border-radius: 500%;
  cursor: pointer;
  opacity: 0;
}
.thumbnail:hover span {
  opacity: 1;
}
.loading-post {
  position: fixed;
  left: 208px;
  right: 0;
  top: 75px;
  bottom: 0;
  background: rgba(0, 0, 0, 0.4);
  z-index: 99999999999999999;
}
.loading-post .loading-img {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 100%;
  height: 100vh;
}
</style>
