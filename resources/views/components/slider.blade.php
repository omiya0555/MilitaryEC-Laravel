<div x-data="{ currentSlide: 0, slides: ['logo-laravel-1024.png', 'logo-laravel-1024.png', 'logo-laravel-1024.png'], interval: 7000 }" 
     x-init="setInterval(() => currentSlide = (currentSlide + 1) % slides.length, interval)"
     class="relative w-full h-80 overflow-hidden">
    
    <!-- Slides -->
    <template x-for="(slide, index) in slides" :key="index">
        <div x-show="currentSlide === index"
             class="absolute inset-0 transition-all transform"
             x-transition:enter="transition ease-out duration-500"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-500"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95">
            <img :src="slide" alt="Slide" class="w-full h-full object-cover">
        </div>
    </template>

    <!-- Navigation -->
    <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-2">
        <template x-for="(slide, index) in slides" :key="index">
            <button @click="currentSlide = index"
                    :class="currentSlide === index ? 'bg-white' : 'bg-gray-500'"
                    class="w-4 h-4 rounded-full"></button>
        </template>
    </div>
</div>
