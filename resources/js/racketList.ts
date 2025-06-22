import { ref, onMounted, computed } from 'vue'
import axios from 'axios'

interface FilterOption<T> {
    value: T
    label: string
}

export default function racketList() {
    const models = ref<ModelRaw[]>([])
    const brands = ref<Brand[]>([])
    const headSizes = ref<FilterOption<number>[]>([])
    const balances = ref<FilterOption<number>[]>([])
    const weights = ref<FilterOption<number>[]>([])
    const stringPatterns = ref<FilterOption<string>[]>([])
    const frameProfiles = ref<FilterOption<string>[]>([])
    const years = ref<FilterOption<number>[]>([])

    const selectedBrands = ref<number[]>([])
    const selectedHeadSizes = ref<number[]>([])
    const selectedBalances = ref<number[]>([])
    const selectedWeights = ref<number[]>([])
    const selectedStringPatterns = ref<string[]>([])
    const selectedFrameProfiles = ref<string[]>([])
    const selectedYears = ref<number[]>([])

    const showBrands = ref(false)
    const showHeadSize = ref(false)
    const showBalance = ref(false)
    const showWeight = ref(false)
    const showStringPattern = ref(false)
    const showFrameProfile = ref(false)
    const showYear = ref(false)

    const loading = ref(false)
    const error = ref<string | null>(null)

    // === вернуть реальные реализации ===

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
        } catch {}
    }

    async function fetchHeadSizes() {
        try {
            const res = await axios.get<FilterOption<number>[]>(
                `${import.meta.env.VITE_API_URL}/v1/filters/head-sizes`
            )
            headSizes.value = res.data
        } catch {}
    }

    async function fetchBalances() {
        try {
            const res = await axios.get<FilterOption<number>[]>(
                `${import.meta.env.VITE_API_URL}/v1/filters/balances`
            )
            balances.value = res.data
        } catch {}
    }

    async function fetchWeights() {
        try {
            const res = await axios.get<FilterOption<number>[]>(
                `${import.meta.env.VITE_API_URL}/v1/filters/weights`
            )
            weights.value = res.data
        } catch {}
    }

    async function fetchStringPatterns() {
        try {
            const res = await axios.get<FilterOption<string>[]>(
                `${import.meta.env.VITE_API_URL}/v1/filters/string-patterns`
            )
            stringPatterns.value = res.data
        } catch {}
    }

    async function fetchFrameProfiles() {
        try {
            const res = await axios.get<FilterOption<string>[]>(
                `${import.meta.env.VITE_API_URL}/v1/filters/frame-profiles`
            )
            frameProfiles.value = res.data
        } catch {}
    }

    async function fetchYears() {
        try {
            const res = await axios.get<FilterOption<number>[]>(
                `${import.meta.env.VITE_API_URL}/v1/filters/years`
            )
            years.value = res.data
        } catch {}
    }

    function resetFilters() {
        selectedBrands.value = []
        selectedHeadSizes.value = []
        selectedBalances.value = []
        selectedWeights.value = []
        selectedStringPatterns.value = []
        selectedFrameProfiles.value = []
        selectedYears.value = []
    }

    // === здесь был закомментированный computed — восстанавливаем его ===

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
            const matchesBrand =
                !selectedBrands.value.length || selectedBrands.value.includes(v.brand.id)
            const matchesHeadSize =
                !selectedHeadSizes.value.length ||
                selectedHeadSizes.value.includes(v.headSize)
            const matchesBalance =
                !selectedBalances.value.length ||
                selectedBalances.value.includes(v.balance)
            const matchesWeight =
                !selectedWeights.value.length ||
                selectedWeights.value.includes(v.weight)
            const matchesStringPattern =
                !selectedStringPatterns.value.length ||
                selectedStringPatterns.value.includes(v.stringPattern)
            const matchesFrameProfile =
                !selectedFrameProfiles.value.length ||
                selectedFrameProfiles.value.includes(v.frameProfile)
            const matchesYear =
                !selectedYears.value.length || selectedYears.value.includes(v.year)

            return (
                matchesBrand &&
                matchesHeadSize &&
                matchesBalance &&
                matchesWeight &&
                matchesStringPattern &&
                matchesFrameProfile &&
                matchesYear
            )
        })
    )

    onMounted(() => {
        fetchModels()
        fetchBrands()
        fetchHeadSizes()
        fetchBalances()
        fetchWeights()
        fetchStringPatterns()
        fetchFrameProfiles()
        fetchYears()
    })

    return {
        brands,
        headSizes,
        balances,
        weights,
        stringPatterns,
        frameProfiles,
        years,

        selectedBrands,
        selectedHeadSizes,
        selectedBalances,
        selectedWeights,
        selectedStringPatterns,
        selectedFrameProfiles,
        selectedYears,

        showBrands,
        showHeadSize,
        showBalance,
        showWeight,
        showStringPattern,
        showFrameProfile,
        showYear,

        filteredVariants,
        resetFilters,
        loading,
        error
    }
}
