<template>
  <div class="p-8 bg-gray-50 min-h-screen">
    <div class="mb-8 flex justify-between items-end border-b pb-6">
      <div>
        <h1 class="text-3xl font-bold text-gray-800 italic">MetricHub</h1>
        <p v-if="lastUpdated" class="text-sm text-gray-500 mt-1">
          Last check: {{ lastUpdated }}
        </p>
      </div>
      <button 
        @click="fetchData" 
        class="bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded shadow-sm transition text-sm font-medium"
      >
        Refresh Now
      </button>
    </div>

    <div v-if="monitors.length === 0" class="text-center py-20 text-gray-400">
      No monitors found. Add monitors via the database or terminal to see them here.
    </div>

    <div v-for="monitor in monitors" :key="monitor.id" class="mb-8 bg-white p-6 rounded-xl shadow-lg border border-gray-100">
      <div class="flex items-center justify-between mb-6">
        <div>
          <h2 class="text-xl font-bold text-gray-800">{{ monitor.name }}</h2>
          <a :href="monitor.url" target="_blank" class="text-xs text-indigo-500 hover:underline">{{ monitor.url }}</a>
        </div>
        
        <div class="flex items-center space-x-4">
          <span v-if="monitor.check_logs?.length" 
                :class="monitor.check_logs[0].status_code === 200 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700'" 
                class="px-3 py-1 rounded-full text-xs font-bold uppercase">
            {{ monitor.check_logs[0].status_code === 200 ? 'Online' : 'Offline' }}
          </span>

          <button @click="deleteMonitor(monitor.id)" class="text-gray-300 hover:text-red-500 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
            </svg>
          </button>
        </div>
      </div>

      <div class="h-64 w-full">
        <LineChart 
          v-if="monitor.check_logs && monitor.check_logs.length > 0" 
          :chart-data="formatChartData(monitor.check_logs)" 
        />
        <div v-else class="h-full flex items-center justify-center bg-gray-50 rounded-lg border border-dashed border-gray-300 text-gray-400 text-sm">
          No data collected yet.
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import axios from 'axios';
import LineChart from './LineChart.vue';

const monitors = ref([]);
const lastUpdated = ref(null);
let interval = null;

const fetchData = async () => {
  try {
    const response = await axios.get('/api/monitors');
    monitors.value = response.data;
    lastUpdated.value = new Date().toLocaleTimeString();
  } catch (e) {
    console.error("Fetch Error:", e);
  }
};

const deleteMonitor = async (id) => {
  if (confirm('Delete this monitor?')) {
    await axios.delete(`/api/monitors/${id}`);
    fetchData();
  }
};

const formatChartData = (logs) => {
  const sortedLogs = [...logs].slice(0, 20).reverse();
  
  return {
    labels: sortedLogs.map(log => new Date(log.created_at).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })),
    datasets: [{
      label: 'Latency (ms)',
      data: sortedLogs.map(log => log.response_time),
      borderColor: '#4f46e5',
      backgroundColor: 'rgba(79, 70, 229, 0.1)',
      fill: true,
      tension: 0.3,
      pointRadius: 2
    }]
  };
};

onMounted(() => {
  fetchData();
  interval = setInterval(fetchData, 30000); 
});

onUnmounted(() => {
  clearInterval(interval);
});
</script>