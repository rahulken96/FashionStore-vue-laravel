<template>
  <div class="product">
    <HeaderFashstore />
    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section text-left">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="breadcrumb-text product-more">
              <router-link to="/">
                <i class="fa fa-home"></i> Home
              </router-link>
              <span>Detail</span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Breadcrumb Section Begin -->

    <!-- Product Shop Section Begin -->
    <section class="product-shop spad page-details">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="row">
              <div class="col-lg-6">
                <div class="product-pic-zoom">
                  <img class="product-big-img" :src="gambar_default" alt="" />
                </div>
                <div
                  class="product-thumbs"
                  v-if="detail_produk.galeri.length > 0"
                >
                  <carousel
                    class="product-thumbs-track ps-slider"
                    :nav="false"
                    :dots="false"
                    :item="3"
                  >
                    <div
                      v-for="foto in detail_produk.galeri"
                      :key="foto.produk_galeri_id"
                      class="pt"
                      @click="ubahGambar(foto.foto_produk)"
                      :class="
                        foto.foto_produk == gambar_default ? 'active' : ''
                      "
                    >
                      <img :src="foto.foto_produk" alt="Foto Produk" />
                    </div>
                  </carousel>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="product-details text-left">
                  <div class="pd-title">
                    <span>{{ detail_produk.tipe_produk }}</span>
                    <h3>{{ detail_produk.nama_produk }}</h3>
                  </div>
                  <div class="pd-desc">
                    <p v-html="detail_produk.deskripsi_produk"></p>
                    <h4>Rp {{ detail_produk.harga_produk }}</h4>
                  </div>
                  <div class="quantity">
                    <router-link to="/cart">
                      <a
                        href="#"
                        @click="
                          masukKeranjang(
                            detail_produk.produk_id,
                            detail_produk.nama_produk,
                            detail_produk.harga_produk,
                            detail_produk.galeri[0].foto_produk
                          )
                        "
                        class="primary-btn pd-cart"
                        >Add To Cart</a
                      >
                    </router-link>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Product Shop Section End -->
    <RelatedProducts />
    <FooterFashstore />
  </div>
</template>

<script>
// @ is an alias to /src
import HeaderFashstore from "@/components/HeaderFashstore.vue";
import FooterFashstore from "@/components/FooterFashstore.vue";
import RelatedProducts from "@/components/RelatedProducts.vue";

import carousel from "vue-owl-carousel";
import axios from "axios";

export default {
  name: "ProductView",
  components: {
    HeaderFashstore,
    RelatedProducts,
    FooterFashstore,
    carousel,
  },
  data() {
    return {
      gambar_default: "",
      detail_produk: [],
      keranjangUser: [],
    };
  },
  methods: {
    ubahGambar(url) {
      this.gambar_default = url;
    },
    setDataGambar(data) {
      this.detail_produk = data;
      this.gambar_default = data.galeri[0].foto_produk;
    },
    masukKeranjang(produkID, namaProduk, hargaProduk, fotoProduk) {
      let produkStored = {
        id: produkID,
        nama: namaProduk,
        harga: hargaProduk,
        foto: fotoProduk,
      };

      this.keranjangUser.push(produkStored);
      const data = JSON.stringify(this.keranjangUser);
      localStorage.setItem("keranjangUser", data);
    },
  },
  mounted() {
    if (localStorage.getItem("keranjangUser")) {
      try {
        this.keranjangUser = JSON.parse(localStorage.getItem("keranjangUser"));
      } catch (e) {
        localStorage.removeItem("keranjangUser");
      }
    }

    axios.get("http://127.0.0.1:8000/api/produk", {
        params: {
          id: this.$route.params.id,
        },
      })
      .then((res) => this.setDataGambar(res.data.data))
      // eslint-disable-next-line no-console
      .catch((err) => console.log(err));
  },
};
</script>
<style scoped>
.product-thumbs .pt {
  margin-right: 10px;
}
</style>
