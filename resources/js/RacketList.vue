<template>
    <div class="container">
        <h2 class="title">{{ $t('rackets.title') }}</h2>
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
                            <li><strong>{{ $t('rackets.weight') }}:</strong> {{ variant.weight }} {{ $t('rackets.grams') }}</li>
                            <li><strong>{{ $t('rackets.headSize') }}:</strong> {{ variant.headSize }} {{ $t('rackets.cm2') }}</li>
                            <li><strong>{{ $t('rackets.balance') }}:</strong> {{ variant.balance }} {{ $t('rackets.mm') }}</li>
                            <li><strong>{{ $t('rackets.length') }}:</strong> {{ variant.length }} {{ $t('rackets.cm') }}</li>
                            <li><strong>{{ $t('rackets.stringPattern') }}:</strong> {{ variant.stringPattern }}</li>
                            <li><strong>{{ $t('rackets.stiffness') }}:</strong> {{ variant.stiffness }}</li>
                            <li><strong>{{ $t('rackets.frameProfile') }}:</strong> {{ variant.frameProfile }}</li>
                            <li><strong>{{ $t('rackets.year') }}:</strong> {{ variant.year }}</li>
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

<style scoped>
.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 24px;
}
.title {
    font-size: 1.5rem;
    font-weight: bold;
    margin-bottom: 16px;
}
.rackets-grid {
    display: flex;
    flex-wrap: wrap;
    gap: 24px;
}
.racket-card {
    flex: 0 1 calc(25% - 18px);
    min-width: 250px;
}
.card {
    display: flex;
    flex-direction: column;
    height: 100%;
    border: 1px solid #dee2e6;
    border-radius: 0.375rem;
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    transition: transform 0.2s;
}
.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
}
.card-img-top {
    width: 100%;
    height: 160px;
    object-fit: contain;
    background-color: #f9fafb;
}
.card-body {
    display: flex;
    flex-direction: column;
    padding: 16px;
}
.card-title {
    margin-bottom: 8px;
    font-size: 1.125rem;
}
.card-subtitle {
    margin-bottom: 12px;
    color: #6c757d;
}
.details-list {
    list-style: none;
    padding: 0;
    margin: 0 0 16px;
    flex-grow: 1;
}
.details-list li {
    margin-bottom: 4px;
    font-size: 0.875rem;
}
.btn-primary {
    background-color: #007bff;
    border: none;
    color: #fff;
    padding: 8px 16px;
    border-radius: 4px;
    cursor: pointer;
    text-align: center;
    transition: background-color 0.2s;
}
.btn-primary:hover {
    background-color: #0056b3;
}
</style>
