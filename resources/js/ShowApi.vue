<template>
    <div class="container">
        <div class="card">
            <h2>Enter your text:</h2>
            <div class="input-group">
                <input type="text" v-model="inputId" placeholder="Enter text" />
                <button @click="sendRequest">Send</button>
            </div>
            <h2>API Response for /api/example:</h2>
            <p v-if="loading" class="loading">Loading...</p>
            <p v-else-if="error" class="error">{{ error }}</p>
            <pre v-else-if="!data" class="center-text">Push Send Button</pre>
            <pre v-else>{{ data }}</pre>
        </div>
    </div>
</template>

<script setup lang="ts">
import { useApi } from "./showApi";

const baseApiUrl = import.meta.env.VITE_API_URL;
const { inputId, data, loading, error, sendRequest } = useApi(baseApiUrl + '/example');
</script>

