<template>
  <div class="home">
    <HeaderFashstore />
    <HeroFashstore />
    <BannerFashstore />
    <InstagramFashstore />
    <PartnerFashstore />
    <FooterFashstore />
  </div>
</template>

<script>
// @ is an alias to /src
import HeaderFashstore from "@/components/HeaderFashstore.vue";
import HeroFashstore from "@/components/HeroFashstore.vue";
import BannerFashstore from "@/components/BannerFashstore.vue";
import InstagramFashstore from "@/components/InstagramFashstore.vue";
import PartnerFashstore from "@/components/PartnerFashstore.vue";
import FooterFashstore from "@/components/FooterFashstore.vue";


export default {
  name: "HomeView",
  components: {
    HeaderFashstore,
    HeroFashstore,
    BannerFashstore,
    InstagramFashstore,
    PartnerFashstore,
    FooterFashstore,
  },
};
</script>
