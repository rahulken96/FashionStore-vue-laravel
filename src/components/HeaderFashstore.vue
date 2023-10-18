<template>
  <!-- Header Section Begin -->
  <header class="header-section">
    <div class="header-top">
      <div class="container">
        <div class="ht-left">
          <div class="mail-service">
            <i class="fa fa-envelope"></i> hello.fashstore@gmail.com
          </div>
          <div class="phone-service">
            <i class="fa fa-phone"></i> +62 822-081-996
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="inner-header">
        <div class="row">
          <div class="col-lg-2 col-md-2">
            <div class="logo">
              <a href="./index.html">
                <img src="img/logo_website_fashstore.png" alt="" />
              </a>
            </div>
          </div>
          <div class="col-lg-7 col-md-7"></div>
          <div class="col-lg-3 text-right col-md-3">
            <ul class="nav-right">
              <li class="cart-icon">
                Keranjang Belanja &nbsp;
                <a href="#">
                  <i class="icon_bag_alt"></i>
                  <span>{{ keranjangUser.length }}</span>
                </a>
                <div class="cart-hover">
                  <div class="select-items">
                    <table>
                      <tbody v-if="keranjangUser.length > 0">
                        <tr v-for="item in keranjangUser" :key="item.id">
                          <td class="si-pic">
                            <img class="photo-item" :src="item.foto" alt="" />
                          </td>
                          <td class="si-text">
                            <div class="product-selected">
                              <p>Rp {{ item.harga }} x 1</p>
                              <h6>{{ item.nama }}</h6>
                            </div>
                          </td>
                          <td @click="hapusItem(keranjangUser.index)" class="si-close" >
                            <i class="ti-close"></i>
                          </td>
                        </tr>
                      </tbody>
                      <tbody v-else>
                        <tr>
                          <td>Keranjang Kosong...</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="select-total">
                    <span>total:</span>
                    <h5>Rp {{ totalHarga }}</h5>
                  </div>
                  <div class="select-button">
                    
                    <a href="#" class="btn primary-btn view-card"><router-link to="/cart" style="color: white">VIEW CARD</router-link></a>
                    <a href="#" class="primary-btn checkout-btn">CHECK OUT</a>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </header>
  <!-- Header End -->
</template>

<script>
export default {
  name: "HeaderFashstore",
  data() {
    return {
      gambar_default: "",
      detail_produk: [],
      keranjangUser: [],
    };
  },
  methods:{
    hapusItem(index){
      this.keranjangUser.splice(index, 1);
      const data = JSON.stringify(this.keranjangUser);
      localStorage.setItem('keranjangUser', data);
    }
  },
  mounted() {
    if (localStorage.getItem('keranjangUser')) {
      try {
        this.keranjangUser = JSON.parse(localStorage.getItem('keranjangUser'));
      } catch(e) {
        localStorage.removeItem('keranjangUser');
      }
    }
  },
  computed: {
    totalHarga() {
      return this.keranjangUser.reduce(function(val, key) {
        return val + key.harga;
      }, 0);  
    },
  }
};
</script>
<style scoped>
  .photo-item{
    width: 80px;
    height: 80px;
  }
</style>