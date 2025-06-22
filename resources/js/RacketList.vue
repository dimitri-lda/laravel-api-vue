<template>
    <div class="container">
        <h2 class="title">{{ t('rackets.title') }}</h2>

        <div class="catalog-layout">
            <aside class="filters-sidebar">
                <div class="filter-section">
                    <button
                        class="filter-header"
                        @click="showBrands = !showBrands"
                        :class="{ active: showBrands }"
                    >
                        <span>{{ t('rackets.filter.brand') }}</span>
                        <span class="filter-arrow">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 25 24">
                                <path d="M16.7902 8.29492L12.2002 12.8749L7.6102 8.29492L6.2002 9.70492L12.2002 15.7049L18.2002 9.70492L16.7902 8.29492Z"/>
                            </svg>
                        </span>
                    </button>

                    <div v-if="showBrands" class="filter-content">
                        <div v-for="b in brands" :key="b.id" class="form-check">
                            <input
                                class="form-check-input"
                                type="checkbox"
                                :value="b.id"
                                v-model="selectedBrands"
                                :id="`brand-${b.id}`"
                            />
                            <label class="form-check-label" :for="`brand-${b.id}`">
                                {{ b.name }}
                            </label>
                        </div>
                    </div>
                </div>

                <div class="filter-section">
                    <button
                        class="filter-header"
                        @click="showHeadSize = !showHeadSize"
                        :class="{ active: showHeadSize }"
                    >
                        <span>{{ t('rackets.filter.headSize') }}</span>
                        <span class="filter-arrow">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 25 24">
                <path d="M16.7902 8.29492L12.2002 12.8749L7.6102 8.29492L6.2002 9.70492L12.2002 15.7049L18.2002 9.70492L16.7902 8.29492Z"/>
            </svg>
        </span>
                    </button>

                    <div v-if="showHeadSize" class="filter-content">
                        <div v-for="size in headSizes" :key="size.value" class="form-check">
                            <input
                                class="form-check-input"
                                type="checkbox"
                                :value="size.value"
                                v-model="selectedHeadSizes"
                                :id="`head-size-${size.value}`"
                            />
                            <label class="form-check-label" :for="`head-size-${size.value}`">
                                {{ size.label }}
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Дополнительные фильтры (заготовки) -->
                <div class="filter-section">
                    <button class="filter-header">
                        <span>{{ t('rackets.filter.price') }}</span>
                        <span class="filter-arrow">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 25 24">
                                <path d="M16.7902 8.29492L12.2002 12.8749L7.6102 8.29492L6.2002 9.70492L12.2002 15.7049L18.2002 9.70492L16.7902 8.29492Z"/>
                            </svg>
                        </span>
                    </button>
                </div>

                <div class="filter-section">
                    <button class="filter-header">
                        <span>{{ t('rackets.filter.color') }}</span>
                        <span class="filter-arrow">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 25 24">
                                <path d="M16.7902 8.29492L12.2002 12.8749L7.6102 8.29492L6.2002 9.70492L12.2002 15.7049L18.2002 9.70492L16.7902 8.29492Z"/>
                            </svg>
                        </span>
                    </button>
                </div>

                <div class="filter-section">
                    <button class="filter-header">
                        <span>{{ t('rackets.filter.availability') }}</span>
                        <span class="filter-arrow">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 25 24">
                                <path d="M16.7902 8.29492L12.2002 12.8749L7.6102 8.29492L6.2002 9.70492L12.2002 15.7049L18.2002 9.70492L16.7902 8.29492Z"/>
                            </svg>
                        </span>
                    </button>
                </div>

                <button class="reset-filters-btn" @click="resetFilters">
                    {{ t('rackets.filter.reset') }}
                </button>
            </aside>

            <main class="products-section">
                <div class="products-header">
                    <div class="products-count">
                        {{ t('rackets.productsFound', { count: filteredVariants.length }) }}
                    </div>
                    <div class="sort-controls">
                        <select class="sort-select">
                            <option>{{ t('rackets.sort.popularity') }}</option>
                            <option>{{ t('rackets.sort.priceAsc') }}</option>
                            <option>{{ t('rackets.sort.priceDesc') }}</option>
                            <option>{{ t('rackets.sort.newest') }}</option>
                        </select>
                    </div>
                </div>

                <div class="rackets-grid">
                    <div
                        v-for="variant in filteredVariants"
                        :key="variant.id"
                        class="racket-card"
                    >
                        <div class="card">
                            <div class="card-image-wrapper">
                                <img
                                    :src="variant.logoUrl"
                                    class="card-img-top"
                                    :alt="t('rackets.modelLogoAlt', { name: variant.modelName })"
                                />
                                <button class="wishlist-btn">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </button>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ variant.modelName }}</h5>
                                <h6 class="card-subtitle">{{ variant.brand.name }}</h6>

                                <ul class="details-list">
                                    <li><strong>{{ t('rackets.article') }}:</strong> {{ variant.articleNumber }}</li>
                                    <li><strong>{{ t('rackets.color') }}:</strong> {{ variant.color }}</li>
                                </ul>

                                <div class="card-footer">
                                    <div class="price">99,99 zł</div>
                                    <button class="btn-primary">{{ t('rackets.details') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</template>

<script setup lang="ts">
import { useI18n } from 'vue-i18n'
import racketList from './racketList'

const { t } = useI18n()
const {
    brands,
    headSizes,
    selectedBrands,
    selectedHeadSizes,
    showBrands,
    showHeadSize,
    filteredVariants,
    resetFilters
} = racketList()
</script>
