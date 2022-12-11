<template>
   <!-- component -->

        <!-- 1 card/cine -->
        <div class="relative bg-white py-6 px-6 rounded-3xl w-64 my-4 shadow-xl">
            <div :class="categoryProps(award.category).color" class=" text-white flex items-center justify-center absolute rounded-full py-4 px-4 shadow-xl w-16 h-16 left-4 -top-6">
                 <i :class="categoryProps(award.category).icon" class="text-white text-2xl"></i>
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
                
                <div v-if="changed" class="text-center">
                    <span class="text-orange-400 " v-if="award.pivot.status==1"> Procesando</span>
                    <span class="text-green-500" v-if="award.pivot.status==2"> Canjeado</span>
                    
                </div>
                <div v-else-if="$page.props.user.points >= award.points" class="text-center pt-4">
                    <button @click="$emit('exchange',award.id)" class="btn-primary">Canjear</button>
                </div>
                
            </div>
        </div>
        

</template>

<script>
export default {
    data() {
        return {
            
        }
    },
    methods:{
      categoryProps(category){
        if(category == 1){
          return {color: 'bg-blue-500', icon: 'fa-solid fa-tv'};
        }else if(category == 2){
          return {color:'bg-red-500', icon: 'fa-solid fa-utensils'};
        }else if(category == 3){
          return {color:'bg-sky-400', icon: 'fa-solid fa-plane'};
        }else{
          return {color:'bg-yellow-500', icon: 'fa-solid fa-box-open'};
        }
      },
    },
    props:{
      award: Object,
      changed: Boolean,
    }
}
</script>