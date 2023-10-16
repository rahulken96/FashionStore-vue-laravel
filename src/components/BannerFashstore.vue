<template>
  <!-- Women Banner Section Begin -->
  <section class="women-banner spad">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12 mt-5" v-if="produk.length > 0">
          <carousel class="product-slider" :items="3" :nav="false" :autoplay="true" :loop="true" :dots="false">
            <div class="product-item" v-for="item in produk" v-bind:key="item.produk_id">
              <div class="pi-pic">
                <img v-bind:src="item.galeri[0].foto_produk" alt="Foto Produk"/>
                <ul>
                  <li class="w-icon active">
                    <a :href="product"><i class="icon_bag_alt"></i></a>
                  </li>
                  <li class="quick-view">
                    <router-link v-bind:to="'/product/' + item.produk_id">+ Quick View</router-link>
                  </li>
                </ul>
              </div>
              <div class="pi-text">
                <div class="catagory-name">{{ item.tipe_produk }}</div>
                <a :href="product">
                  <h5>{{ item.nama_produk }}</h5>
                </a>
                <div class="product-price">
                  Rp {{ item.harga_produk }}
                  <span>Rp {{ item.harga_produk + 15000 }}</span>
                </div>
              </div>
            </div>
          </carousel>
        </div>
        <div class="col-lg-12" v-else>
          <p> Produk terbaru belum tersedia. </p>
        </div>
      </div>
    </div>
  </section>
  <!-- Women Banner Section End -->
</template>

<script>
import carousel from "vue-owl-carousel";
import axios from 'axios';

export default {
  name: "BannerFashstore",
  components: {
    carousel,
  },
  data (){
      return{
        produk : [],
    };
  },
  mounted() {
    axios
    .get("http://127.0.0.1:8000/api/produk")
    .then(res => (this.produk = res.data.data))
    // eslint-disable-next-line no-console
    .catch(err => console.log(err));
  },
};
</script>

<style scoped>
.product-item {
  margin-right: 25px;
}
</style>