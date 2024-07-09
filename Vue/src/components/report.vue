<!-- <script setup lang="ts">
import { ref } from 'vue'
// @ts-ignore
import VueApexCharts from 'vue3-apexcharts'

const chartData = {
  series: [
    {
      name: 'Product One',
      data: [23, 11, 22, 27, 13, 22, 37, 21, 44, 22, 30, 45]
    },

    {
      name: 'Product Two',
      data: [30, 25, 36, 30, 45, 35, 64, 52, 59, 36, 39, 51]
    }
  ],
  labels: ['Sep', 'Oct', 'Nov', 'Dec', 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug']
}

const chart = ref(null)

const apexOptions = {
  legend: {
    show: false,
    position: 'top',
    horizontalAlign: 'left'
  },
  colors: ['#3C50E0', '#80CAEE'],
  chart: {
    fontFamily: 'Satoshi, sans-serif',
    height: 335,
    type: 'area',
    dropShadow: {
      enabled: true,
      color: '#623CEA14',
      top: 10,
      blur: 4,
      left: 0,
      opacity: 0.1
    },

    toolbar: {
      show: false
    }
  },
  responsive: [
    {
      breakpoint: 1024,
      options: {
        chart: {
          height: 300
        }
      }
    },
    {
      breakpoint: 1366,
      options: {
        chart: {
          height: 350
        }
      }
    }
  ],
  stroke: {
    width: [2, 2],
    curve: 'straight'
  },

  labels: {
    show: false,
    position: 'top'
  },
  grid: {
    xaxis: {
      lines: {
        show: true
      }
    },
    yaxis: {
      lines: {
        show: true
      }
    }
  },
  dataLabels: {
    enabled: false
  },
  markers: {
    size: 4,
    colors: '#fff',
    strokeColors: ['#3056D3', '#80CAEE'],
    strokeWidth: 3,
    strokeOpacity: 0.9,
    strokeDashArray: 0,
    fillOpacity: 1,
    discrete: [],
    hover: {
      size: undefined,
      sizeOffset: 5
    }
  },
  xaxis: {
    type: 'category',
    categories: chartData.labels,
    axisBorder: {
      show: false
    },
    axisTicks: {
      show: false
    }
  },
  yaxis: {
    title: {
      style: {
        fontSize: '0px'
      }
    },
    min: 0,
    max: 100
  }
}
</script>

<template>
  <div
    class="col-span-12 rounded-sm border border-stroke bg-white px-5 pt-7.5 pb-5 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5 xl:col-span-8"
  >
    <div class="flex flex-wrap items-start justify-between gap-3 sm:flex-nowrap">
      <div class="flex w-full flex-wrap gap-3 sm:gap-5">
        <div class="flex min-w-47.5">
          <span
            class="mt-1 mr-2 flex h-4 w-full max-w-4 items-center justify-center rounded-full border border-primary"
          >
            <span class="block h-2.5 w-full max-w-2.5 rounded-full bg-primary"></span>
          </span>
          <div class="w-full">
            <p class="font-semibold text-primary">Total Revenue</p>
            <p class="text-sm font-medium">12.04.2022 - 12.05.2022</p>
          </div>
        </div>
        <div class="flex min-w-47.5">
          <span
            class="mt-1 mr-2 flex h-4 w-full max-w-4 items-center justify-center rounded-full border border-secondary"
          >
            <span class="block h-2.5 w-full max-w-2.5 rounded-full bg-secondary"></span>
          </span>
          <div class="w-full">
            <p class="font-semibold text-secondary">Total Sales</p>
            <p class="text-sm font-medium">12.04.2022 - 12.05.2022</p>
          </div>
        </div>
      </div>
      <div class="flex w-full max-w-45 justify-end">
        <div class="inline-flex items-center rounded-md bg-whiter p-1.5 dark:bg-meta-4">
          <button
            class="rounded bg-white py-1 px-3 text-xs font-medium text-black shadow-card hover:bg-white hover:shadow-card dark:bg-boxdark dark:text-white dark:hover:bg-boxdark"
          >
            Day
          </button>
          <button
            class="rounded py-1 px-3 text-xs font-medium text-black hover:bg-white hover:shadow-card dark:text-white dark:hover:bg-boxdark"
          >
            Week
          </button>
          <button
            class="rounded py-1 px-3 text-xs font-medium text-black hover:bg-white hover:shadow-card dark:text-white dark:hover:bg-boxdark"
          >
            Month
          </button>
        </div>
      </div>
    </div>
    <div>
      <div id="chartOne" class="-ml-5">
        <VueApexCharts
          type="area"
          height="350"
          :options="apexOptions"
          :series="chartData.series"
          ref="chart"
        />
      </div>
    </div>
  </div>
</template> -->

<!-- <script setup lang="ts">
import { ref } from "vue";
// @ts-ignore
import VueApexCharts from "vue3-apexcharts";

const chartData = {
    series: [65, 34, 45, 12],
    labels: ["Desktop", "Tablet", "Mobile", "Unknown"],
};

const chart = ref(null);

const apexOptions = {
    chart: {
        type: "donut",
        width: 380,
    },
    colors: ["#3C50E0", "#6577F3", "#8FD0EF", "#0FADCF"],
    labels: chartData.labels,
    legend: {
        show: false,
        position: "bottom",
    },
    plotOptions: {
        pie: {
            donut: {
                size: "65%",
                background: "transparent",
            },
        },
    },
    dataLabels: {
        enabled: false,
    },
    responsive: [
        {
            breakpoint: 640,
            options: {
                chart: {
                    width: 200,
                },
            },
        },
    ],
};
</script>

<template>
    <div
        class="col-span-12 rounded-sm border border-stroke bg-white px-5 pt-7.5 pb-5 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5 xl:col-span-5"
    >
        <div class="mb-3 justify-between gap-4 sm:flex">
            <div>
                <h4 class="text-xl font-bold text-black dark:text-white">
                    Visitors Analytics
                </h4>
            </div>
            <div>
                <div class="relative z-20 inline-block">
                    <select
                        name=""
                        id=""
                        class="relative z-20 inline-flex appearance-none bg-transparent py-1 pl-3 pr-8 text-sm font-medium outline-none"
                    >
                        <option value="">Monthly</option>
                        <option value="">Yearly</option>
                    </select>
                    <span
                        class="absolute top-1/2 right-3 z-10 -translate-y-1/2"
                    >
                        <svg
                            width="10"
                            height="6"
                            viewBox="0 0 10 6"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M0.47072 1.08816C0.47072 1.02932 0.500141 0.955772 0.54427 0.911642C0.647241 0.808672 0.809051 0.808672 0.912022 0.896932L4.85431 4.60386C4.92785 4.67741 5.06025 4.67741 5.14851 4.60386L9.09079 0.896932C9.19376 0.793962 9.35557 0.808672 9.45854 0.911642C9.56151 1.01461 9.5468 1.17642 9.44383 1.27939L5.50155 4.98632C5.22206 5.23639 4.78076 5.23639 4.51598 4.98632L0.558981 1.27939C0.50014 1.22055 0.47072 1.16171 0.47072 1.08816Z"
                                fill="#637381"
                            />
                            <path
                                fill-rule="evenodd"
                                clip-rule="evenodd"
                                d="M1.22659 0.546578L5.00141 4.09604L8.76422 0.557869C9.08459 0.244537 9.54201 0.329403 9.79139 0.578788C10.112 0.899434 10.0277 1.36122 9.77668 1.61224L9.76644 1.62248L5.81552 5.33722C5.36257 5.74249 4.6445 5.7544 4.19352 5.32924C4.19327 5.32901 4.19377 5.32948 4.19352 5.32924L0.225953 1.61241C0.102762 1.48922 -4.20186e-08 1.31674 -3.20269e-08 1.08816C-2.40601e-08 0.905899 0.0780105 0.712197 0.211421 0.578787C0.494701 0.295506 0.935574 0.297138 1.21836 0.539529L1.22659 0.546578ZM4.51598 4.98632C4.78076 5.23639 5.22206 5.23639 5.50155 4.98632L9.44383 1.27939C9.5468 1.17642 9.56151 1.01461 9.45854 0.911642C9.35557 0.808672 9.19376 0.793962 9.09079 0.896932L5.14851 4.60386C5.06025 4.67741 4.92785 4.67741 4.85431 4.60386L0.912022 0.896932C0.809051 0.808672 0.647241 0.808672 0.54427 0.911642C0.500141 0.955772 0.47072 1.02932 0.47072 1.08816C0.47072 1.16171 0.50014 1.22055 0.558981 1.27939L4.51598 4.98632Z"
                                fill="#637381"
                            />
                        </svg>
                    </span>
                </div>
            </div>
        </div>
        <div class="mb-2">
            <div id="chartThree" class="mx-auto flex justify-center">
                <VueApexCharts
                    type="donut"
                    width="340"
                    :options="apexOptions"
                    :series="chartData.series"
                    ref="chart"
                />
            </div>
        </div>
        <div class="-mx-8 flex flex-wrap items-center justify-center gap-y-3">
            <div class="w-full px-8 sm:w-1/2">
                <div class="flex w-full items-center">
                    <span
                        class="mr-2 block h-3 w-full max-w-3 rounded-full bg-primary"
                    ></span>
                    <p
                        class="flex w-full justify-between text-sm font-medium text-black dark:text-white"
                    >
                        <span> Desktop </span>
                        <span> 65% </span>
                    </p>
                </div>
            </div>
            <div class="w-full px-8 sm:w-1/2">
                <div class="flex w-full items-center">
                    <span
                        class="mr-2 block h-3 w-full max-w-3 rounded-full bg-[#6577F3]"
                    ></span>
                    <p
                        class="flex w-full justify-between text-sm font-medium text-black dark:text-white"
                    >
                        <span> Tablet </span>
                        <span> 34% </span>
                    </p>
                </div>
            </div>
            <div class="w-full px-8 sm:w-1/2">
                <div class="flex w-full items-center">
                    <span
                        class="mr-2 block h-3 w-full max-w-3 rounded-full bg-[#8FD0EF]"
                    ></span>
                    <p
                        class="flex w-full justify-between text-sm font-medium text-black dark:text-white"
                    >
                        <span> Mobile </span>
                        <span> 45% </span>
                    </p>
                </div>
            </div>
            <div class="w-full px-8 sm:w-1/2">
                <div class="flex w-full items-center">
                    <span
                        class="mr-2 block h-3 w-full max-w-3 rounded-full bg-[#0FADCF]"
                    ></span>
                    <p
                        class="flex w-full justify-between text-sm font-medium text-black dark:text-white"
                    >
                        <span> Unknown </span>
                        <span> 12% </span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</template> -->

<script setup lang="ts">
import { ref } from "vue";
// @ts-ignore
import VueApexCharts from "vue3-apexcharts";

const chartData = {
    series: [
        {
            name: "Sales",
            data: [44, 55, 41, 67, 22, 43, 65],
        },
        {
            name: "Revenue",
            data: [13, 23, 20, 8, 13, 27, 15],
        },
    ],
    labels: ["M", "T", "W", "T", "F", "S", "S"],
};

const chart = ref(null);

const apexOptions = {
    colors: ["#3056D3", "#80CAEE"],
    chart: {
        type: "bar",
        height: 335,
        stacked: true,
        toolbar: {
            show: false,
        },
        zoom: {
            enabled: false,
        },
    },
    responsive: [
        {
            breakpoint: 1536,
            options: {
                plotOptions: {
                    bar: {
                        borderRadius: 0,
                        columnWidth: "25%",
                    },
                },
            },
        },
    ],
    plotOptions: {
        bar: {
            horizontal: false,
            borderRadius: 0,
            columnWidth: "25%",
            borderRadiusApplication: "end",
            borderRadiusWhenStacked: "last",
        },
    },
    dataLabels: {
        enabled: false,
    },
    xaxis: {
        type: "category",
        categories: chartData.labels,
    },
    legend: {
        position: "top",
        horizontalAlign: "left",
        fontFamily: "Satoshi",
        fontWeight: 500,
        fontSize: "14px",

        markers: {
            radius: 99,
        },
    },
    fill: {
        opacity: 1,
    },
};
</script>

<template>
    <div
        class="col-span-12 rounded-sm border border-stroke bg-white p-7.5 shadow-default dark:border-strokedark dark:bg-boxdark xl:col-span-4"
    >
        <div class="mb-4 justify-between gap-4 sm:flex">
            <div>
                <h4 class="text-xl font-bold text-black dark:text-white">
                    Profit this week
                </h4>
            </div>
            <div>
                <div class="relative z-20 inline-block">
                    <select
                        name="#"
                        id="#"
                        class="relative z-20 inline-flex appearance-none bg-transparent py-1 pl-3 pr-8 text-sm font-medium outline-none"
                    >
                        <option value="">This Week</option>
                        <option value="">Last Week</option>
                    </select>
                    <span
                        class="absolute top-1/2 right-3 z-10 -translate-y-1/2"
                    >
                        <svg
                            width="10"
                            height="6"
                            viewBox="0 0 10 6"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M0.47072 1.08816C0.47072 1.02932 0.500141 0.955772 0.54427 0.911642C0.647241 0.808672 0.809051 0.808672 0.912022 0.896932L4.85431 4.60386C4.92785 4.67741 5.06025 4.67741 5.14851 4.60386L9.09079 0.896932C9.19376 0.793962 9.35557 0.808672 9.45854 0.911642C9.56151 1.01461 9.5468 1.17642 9.44383 1.27939L5.50155 4.98632C5.22206 5.23639 4.78076 5.23639 4.51598 4.98632L0.558981 1.27939C0.50014 1.22055 0.47072 1.16171 0.47072 1.08816Z"
                                fill="#637381"
                            />
                            <path
                                fill-rule="evenodd"
                                clip-rule="evenodd"
                                d="M1.22659 0.546578L5.00141 4.09604L8.76422 0.557869C9.08459 0.244537 9.54201 0.329403 9.79139 0.578788C10.112 0.899434 10.0277 1.36122 9.77668 1.61224L9.76644 1.62248L5.81552 5.33722C5.36257 5.74249 4.6445 5.7544 4.19352 5.32924C4.19327 5.32901 4.19377 5.32948 4.19352 5.32924L0.225953 1.61241C0.102762 1.48922 -4.20186e-08 1.31674 -3.20269e-08 1.08816C-2.40601e-08 0.905899 0.0780105 0.712197 0.211421 0.578787C0.494701 0.295506 0.935574 0.297138 1.21836 0.539529L1.22659 0.546578ZM4.51598 4.98632C4.78076 5.23639 5.22206 5.23639 5.50155 4.98632L9.44383 1.27939C9.5468 1.17642 9.56151 1.01461 9.45854 0.911642C9.35557 0.808672 9.19376 0.793962 9.09079 0.896932L5.14851 4.60386C5.06025 4.67741 4.92785 4.67741 4.85431 4.60386L0.912022 0.896932C0.809051 0.808672 0.647241 0.808672 0.54427 0.911642C0.500141 0.955772 0.47072 1.02932 0.47072 1.08816C0.47072 1.16171 0.50014 1.22055 0.558981 1.27939L4.51598 4.98632Z"
                                fill="#637381"
                            />
                        </svg>
                    </span>
                </div>
            </div>
        </div>

        <div>
            <div id="chartTwo" class="-ml-5 -mb-9">
                <VueApexCharts
                    type="bar"
                    height="335"
                    :options="apexOptions"
                    :series="chartData.series"
                    ref="chart"
                />
            </div>
        </div>
    </div>
</template>
