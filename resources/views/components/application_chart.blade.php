@props(['labels', 'values'])

<div
    x-data="{
        labels: @js($labels),
        values: @js($values),
        init() {
            new Chart(this.$refs.canvas.getContext('2d'), {
                type: 'bar',
                data: {
                    labels: this.labels,
                    datasets: [
                        {
                            label: 'Applications',
                            data: this.values,
                            backgroundColor: '#4f46e5',
                            borderRadius: 0,
                            borderSkipped: false,
                        },
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        y: { beginAtZero: true, grid: { drawBorder: false } },
                        x: { grid: { display: false } }
                    }
                }
            });
        }
    }"
    class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
    <main class="flex flex-col gap-4">
        <div class="flex justify-between items-center px-10">
            <aside class="flex flex-col">
                <h1 class="text-heading text-2xl">Job Performance</h1>
                <span class="text-gray-500 text-[12px] font-medium">Applications trend over the last 30 days</span>
            </aside>
            <h1 class="px-3 py-1 bg-gray-200">Last 30 Days</h1>
        </div>
        <div class="relative h-64 w-full">
            <canvas x-ref="canvas"></canvas>
        </div>
    </main>
</div>