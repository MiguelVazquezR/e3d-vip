<template>
   <!-- component -->
<div class="flex items-center justify-center">
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4">

        <!-- 1 card/cine -->
        <div v-for="(award,index) in awards" :key="award.id" class="relative bg-white py-6 px-6 rounded-3xl w-64 my-4 shadow-xl">
            <div :class="categoryProps(index).color" class=" text-white flex items-center justify-center absolute rounded-full py-4 px-4 shadow-xl w-16 h-16 left-4 -top-6">
                 <i :class="categoryProps(index).icon" class="text-white text-2xl"></i>
            </div>
            <div class="mt-8">
                <p class="text-xl font-semibold my-2">{{ award.title }}</p>
                <div class="flex space-x-2 text-gray-400 text-sm">
                <i class="fa-solid fa-location-dot"></i>
                     <p>{{ award.location }}</p> 
                </div>
                <div class="flex space-x-2 text-gray-400 text-sm my-3">
                     <i class="fa-solid fa-gift"></i>
                     <p>{{ award.description }}</p> 
                </div>
                <div class="flex space-x-2 text-gray-400 text-sm my-3">
                     <i class="fa-solid fa-right-left"></i>
                     <p>{{ award.points }} Puntos</p> 
                </div>
                <div class="border-t-2"></div>

                <div class="text-center pt-4">
                    <button @click="emitExchange" class="btn-primary">Canjear</button>
                </div>
            </div>
        </div>
        
    </div>
</div>

</template>

<script>
export default {
    data() {
        return {
            awards:[
                {
                    title:'Entradas de cine',
                    location:'Cinepolis la normal',
                    description:'Dos entradas para adulto',
                    points:20,
                    category:1,
                },
                {
                    title:'Restaurant',
                    location:'Tacos el cuñao',
                    description:'Reservacion para dos personas',
                    points:35,
                    category:2,
                },
                {
                    title:'Viaje',
                    location:'Cancun',
                    description:'Viaje para dos adultos',
                    points:55,
                    category:3,
                },
                {
                    title:'Producto',
                    location:'coopel',
                    description:'una licuadora nueva',
                    points:12,
                    category:4,
                },
            ]
        }
    },
    methods:{
      categoryProps(index){
        if(this.awards[index].category==1){
          return {color: 'bg-blue-500', icon: 'fa-solid fa-tv'};
        }else if(this.awards[index].category==2){
          return {color:'bg-red-500', icon: 'fa-solid fa-utensils'};
        }else if(this.awards[index].category==3){
          return {color:'bg-sky-400', icon: 'fa-solid fa-plane'};
        }else{
          return {color:'bg-yellow-500', icon: 'fa-solid fa-box-open'};
        }
      },
      emitExchange(){
        this.$emit('exchange');
      }
    }
}
</script>