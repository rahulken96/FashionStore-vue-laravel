<template>
  <div class="cart">
    <HeaderFashstore />
    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-left">
            <div class="breadcrumb-text product-more">
              <router-link to="/"><i class="fa fa-home"></i> Home</router-link>
              <span>Shopping Cart</span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Breadcrumb Section Begin -->

    <!-- Shopping Cart Section Begin -->
    <section class="shopping-cart spad">
      <div class="container">
        <div class="row">
          <div class="col-lg-8">
            <div class="row">
              <div class="col-lg-12">
                <div class="cart-table">
                  <table>
                    <thead>
                      <tr>
                        <th>Image</th>
                        <th class="p-name text-center">Product Name</th>
                        <th>Price</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="item in keranjangUser" :key="item.id">
                        <td class="cart-pic first-row">
                          <img class="img-cart" :src="item.foto" />
                        </td>
                        <td class="cart-title first-row text-center">
                          <h5>{{ item.nama }}</h5>
                        </td>
                        <td class="p-price first-row">Rp {{ item.harga }}</td>
                        <td @click="hapusItem(keranjangUser.index)" class="delete-item">
                          <a href="#"><i class="material-icons"> close </i></a>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="col-lg-8">
                <h4 class="mb-4 text-left">Informasi Pembeli:</h4>
                <div class="user-checkout text-left">
                  <form>
                    <div class="form-group">
                      <label for="namaLengkap">Nama lengkap</label>
                      <input
                        type="text"
                        class="form-control"
                        id="namaLengkap"
                        aria-describedby="namaHelp"
                        placeholder="Masukan Nama"
                        v-model="infoPembeli.nama"
                      />
                    </div>
                    <div class="form-group">
                      <label for="namaLengkap">Email Address</label>
                      <input
                        type="email"
                        class="form-control"
                        id="emailAddress"
                        aria-describedby="emailHelp"
                        placeholder="Masukan Email"
                        v-model="infoPembeli.email"
                      />
                    </div>
                    <div class="form-group">
                      <label for="namaLengkap">No. HP</label>
                      <input
                        type="text"
                        class="form-control"
                        id="noHP"
                        aria-describedby="noHPHelp"
                        placeholder="Masukan No. HP"
                        v-model="infoPembeli.noHP"
                      />
                    </div>
                    <div class="form-group">
                      <label for="alamatLengkap">Alamat Lengkap</label>
                      <textarea
                        class="form-control"
                        id="alamatLengkap"
                        rows="3"
                        v-model="infoPembeli.alamat"
                      ></textarea>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="row">
              <div class="col-lg-12">
                <div class="proceed-checkout text-left">
                  <ul>
                    <li class="subtotal">
                      ID Transaction <span>#SH12000</span>
                    </li>
                    <li class="subtotal mt-3">Subtotal <span>Rp {{ subTotal }}</span></li>
                    <li class="subtotal mt-3">Pajak <span>11%</span></li>
                    <li class="subtotal mt-3">
                      Total Biaya <span>Rp {{ totalHarga }}</span>
                    </li>
                    <li class="subtotal mt-3">
                      Bank Transfer <span>CIMB NIAGA</span>
                    </li>
                    <li class="subtotal mt-3">
                      No. Rekening <span>7630 8630 0800</span>
                    </li>
                    <li class="subtotal mt-3">
                      Nama Penerima <span>Rahul</span>
                    </li>
                  </ul>
                  <a @click="checkout()" class="proceed-btn">Siap Bayar !</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Shopping Cart Section End -->
    <FooterFashstore />
  </div>
</template>

<script>
// @ is an alias to /src
import HeaderFashstore from "@/components/HeaderFashstore.vue";
import FooterFashstore from "@/components/FooterFashstore.vue";
import axios from "axios";

export default {
  name: "ShoppingCartView",
  components: {
    HeaderFashstore,
    FooterFashstore,
  },
  data() {
    return {
      gambar_default: "",
      detail_produk: [],
      keranjangUser: [],
      infoPembeli: {
        nama: '',
        email: '',
        noHP: '',
        alamat: '',
      },
    };
  },
  methods:{
    hapusItem(index){
      this.keranjangUser.splice(index, 1);
      const data = JSON.stringify(this.keranjangUser);
      localStorage.setItem('keranjangUser', data);
    },
    checkout(){
      let produkID = this.keranjangUser.map(function(val){
        return val.id;
      });

      let checkoutData = {
        'nama': this.infoPembeli.nama,
        'email': this.infoPembeli.email,
        'noHP': this.infoPembeli.noHP,
        'alamat': this.infoPembeli.alamat,
        'total_transaksi': this.totalHarga,
        'status_transaksi': 0,
        'detail_transaksi': produkID
      };

      axios.post("http://127.0.0.1:8000/api/checkout", checkoutData)
      .then(() => this.$router.push('success')) //Redirect ke url /success
      // eslint-disable-next-line no-console
      .catch((err) => console.log(err));
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
    subTotal() {
      return this.keranjangUser.reduce(function(val, key) {
        return val + key.harga;
      }, 0);  
    },
    totalHarga() {
      return (this.subTotal * 0.11) + this.subTotal;  
    },
  }
};
</script>

<style scoped>
  .img-cart{
    width: 100px;
    height: 100px;
  }
</style>
