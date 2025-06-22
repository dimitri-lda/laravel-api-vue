<template>
    <div class="container">
<!--        <h2 class="title">{{ $t('rackets.title') }}</h2>-->
        <div class="rackets-grid">
            <div
                v-for="variant in variants"
                :key="variant.id"
                class="racket-card"
            >
                <div class="card h-100 d-flex flex-column">
                    <img
                        :src="variant.logoUrl"
                        class="card-img-top"
                        :alt="$t('rackets.modelLogoAlt', { name: variant.modelName })"
                    />
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ variant.modelName }}</h5>
                        <h6 class="card-subtitle">{{ variant.brand.name }}</h6>

                        <ul class="details-list flex-grow-1">
                            <li><strong>{{ $t('rackets.article') }}:</strong> {{ variant.articleNumber }}</li>
                            <li><strong>{{ $t('rackets.color') }}:</strong> {{ variant.color }}</li>
<!--                            <li><strong>{{ $t('rackets.weight') }}:</strong> {{ variant.weight }} {{ $t('rackets.grams') }}</li>-->
<!--                            <li><strong>{{ $t('rackets.headSize') }}:</strong> {{ variant.headSize }} {{ $t('rackets.cm2') }}</li>-->
<!--                            <li><strong>{{ $t('rackets.balance') }}:</strong> {{ variant.balance }} {{ $t('rackets.mm') }}</li>-->
<!--                            <li><strong>{{ $t('rackets.length') }}:</strong> {{ variant.length }} {{ $t('rackets.cm') }}</li>-->
<!--                            <li><strong>{{ $t('rackets.stringPattern') }}:</strong> {{ variant.stringPattern }}</li>-->
<!--                            <li><strong>{{ $t('rackets.stiffness') }}:</strong> {{ variant.stiffness }}</li>-->
<!--                            <li><strong>{{ $t('rackets.frameProfile') }}:</strong> {{ variant.frameProfile }}</li>-->
<!--                            <li><strong>{{ $t('rackets.year') }}:</strong> {{ variant.year }}</li>-->
                        </ul>

                        <button class="btn btn-primary mt-auto">{{ $t('rackets.details') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue'
import { useI18n } from 'vue-i18n'
import axios from 'axios'

const { t } = useI18n()
const models = ref([])
const loading = ref(false)
const error = ref(null)

onMounted(async () => {
    loading.value = true
    try {
        const res = await axios.get(import.meta.env.VITE_API_URL + '/v1/racket_models')
        models.value = res.data
    } catch (e) {
        error.value = e.message
    } finally {
        loading.value = false
    }
})

const variants = computed(() =>
    models.value.flatMap(m =>
        m.variants.map(v => ({
            ...v,
            modelName: m.name,
            logoUrl: m.logoUrl,
            brand: m.brand,
        }))
    )
)
</script>
