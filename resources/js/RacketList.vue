<template>
    <div class="container">
        <h2 class="title">{{ t('rackets.title') }}</h2>

        <div class="filter-dropdown">
            <button class="btn-secondary filter-toggle" @click="showBrands = !showBrands">
                {{ t('rackets.filter.brand') }}
                <span
                    class="icon icon-cr-st icon-cr-st-arrow-down-select"
                    :class="{ open: showBrands }"
                >
    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 25 24">
      <path d="M16.7902 8.29492L12.2002 12.8749L7.6102 8.29492L6.2002 9.70492L12.2002 15.7049L18.2002 9.70492L16.7902 8.29492Z"/>
    </svg>
  </span>
            </button>

            <div v-if="showBrands" class="dropdown-menu">
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

        <div class="rackets-grid">
            <div
                v-for="variant in filteredVariants"
                :key="variant.id"
                class="racket-card"
            >
                <div class="card">
                    <img
                        :src="variant.logoUrl"
                        class="card-img-top"
                        :alt="t('rackets.modelLogoAlt', { name: variant.modelName })"
                    />
                    <div class="card-body">
                        <h5 class="card-title">{{ variant.modelName }}</h5>
                        <h6 class="card-subtitle">{{ variant.brand.name }}</h6>

                        <ul class="details-list">
                            <li><strong>{{ t('rackets.article') }}:</strong> {{ variant.articleNumber }}</li>
                            <li><strong>{{ t('rackets.color') }}:</strong> {{ variant.color }}</li>
                        </ul>

                        <button class="btn-primary mt-auto">{{ t('rackets.details') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { useI18n } from 'vue-i18n'
import useRacketList from './RacketList'

const { t } = useI18n()
const {
    brands,
    selectedBrands,
    showBrands,
    filteredVariants
} = useRacketList()
</script>
