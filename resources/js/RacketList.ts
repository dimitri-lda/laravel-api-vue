import { ref, onMounted, computed } from 'vue'
import axios from 'axios'

interface Brand { /* … */ }
interface VariantRaw { /* … */ }
interface ModelRaw { /* … */ }
interface VariantFlat extends VariantRaw { /* … */ }

export default function useRacketList() {
    const models = ref<ModelRaw[]>([])
    const brands = ref<Brand[]>([])
    const selectedBrands = ref<number[]>([])
    const showBrands = ref(false)

    const loading = ref(false)
    const error = ref<string | null>(null)

    async function fetchModels() {
        loading.value = true
        try {
            const res = await axios.get<ModelRaw[]>(
                `${import.meta.env.VITE_API_URL}/v1/racket_models`
            )
            models.value = res.data
        } catch (e: any) {
            error.value = e.message
        } finally {
            loading.value = false
        }
    }

    async function fetchBrands() {
        try {
            const res = await axios.get<Brand[]>(
                `${import.meta.env.VITE_API_URL}/v1/brands`
            )
            brands.value = res.data
        } catch {
            // silent
        }
    }

    onMounted(() => {
        fetchModels()
        fetchBrands()
    })

    const variants = computed<VariantFlat[]>(() =>
        models.value.flatMap(m =>
            m.variants.map(v => ({
                ...v,
                modelName: m.name,
                logoUrl: m.logoUrl,
                brand: m.brand
            }))
        )
    )

    const filteredVariants = computed<VariantFlat[]>(() =>
        variants.value.filter(v =>
            selectedBrands.value.length === 0 ||
            selectedBrands.value.includes(v.brand.id)
        )
    )

    return {
        brands,
        selectedBrands,
        showBrands,
        filteredVariants,
        loading,
        error
    }
}
