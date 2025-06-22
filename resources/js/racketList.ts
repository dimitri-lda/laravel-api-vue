import { ref, onMounted, computed } from 'vue'
import axios from 'axios'

interface Brand {
    id: number
    name: string
    logoUrl: string
    countryCode: string
}

interface HeadSize {
    value: number
    label: string
}

interface VariantRaw {
    id: number
    articleNumber: string
    color: string
    weight: number
    headSize: number
    balance: number
    stringPattern: string
    stiffness: number
    length: number
    frameProfile: string
    year: number
}

interface ModelRaw {
    id: number
    name: string
    logoUrl: string
    brand: Brand
    variants: VariantRaw[]
}

interface VariantFlat extends VariantRaw {
    modelName: string
    logoUrl: string
    brand: Brand
}

export default function racketList() {
    const models = ref<ModelRaw[]>([])
    const brands = ref<Brand[]>([])
    const headSizes = ref<HeadSize[]>([])

    const selectedBrands = ref<number[]>([])
    const selectedHeadSizes = ref<number[]>([])

    const showBrands = ref(false)
    const showHeadSize = ref(false)

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

    async function fetchHeadSizes() {
        try {
            const res = await axios.get<HeadSize[]>(
                `${import.meta.env.VITE_API_URL}/v1/filters/head-sizes`
            )
            headSizes.value = res.data
        } catch {
            // silent
        }
    }

    function resetFilters() {
        selectedBrands.value = []
        selectedHeadSizes.value = []
    }

    onMounted(() => {
        fetchModels()
        fetchBrands()
        fetchHeadSizes()
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
        variants.value.filter(v => {
            const matchesBrand = selectedBrands.value.length === 0 ||
                selectedBrands.value.includes(v.brand.id)

            const matchesHeadSize = selectedHeadSizes.value.length === 0 ||
                selectedHeadSizes.value.includes(v.headSize)

            return matchesBrand && matchesHeadSize
        })
    )

    return {
        brands,
        headSizes,
        selectedBrands,
        selectedHeadSizes,
        showBrands,
        showHeadSize,
        filteredVariants,
        resetFilters,
        loading,
        error
    }
}
