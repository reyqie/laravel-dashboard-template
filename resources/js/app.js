import ApexCharts from 'apexcharts';

const root = document.documentElement;
const themeKey = 'aurelia-theme';
const colorScheme = window.matchMedia('(prefers-color-scheme: dark)');

const savedTheme = () => {
    const value = localStorage.getItem(themeKey);

    return ['light', 'dark', 'system'].includes(value) ? value : 'system';
};

const resolvedTheme = (theme = savedTheme()) => {
    if (theme === 'system') {
        return colorScheme.matches ? 'dark' : 'light';
    }

    return theme;
};

const cssVar = (name) => getComputedStyle(root).getPropertyValue(name).trim();

const applyTheme = (theme, { persist = true } = {}) => {
    const resolved = resolvedTheme(theme);

    root.classList.toggle('dark', resolved === 'dark');
    root.style.colorScheme = resolved;

    if (persist) {
        localStorage.setItem(themeKey, theme);
    }

    document.querySelectorAll('[data-theme-choice]').forEach((choice) => {
        const active = choice.dataset.themeChoice === theme;
        choice.classList.toggle('is-active', active);
        choice.setAttribute('aria-checked', String(active));
    });

    window.dispatchEvent(new CustomEvent('aurelia:theme-changed'));
};

const charts = new Map();

const chartPalette = (element, count) => {
    const requested = element.dataset.colors ? JSON.parse(element.dataset.colors) : [];
    const fallback = ['--chart-1', '--chart-2', '--chart-3', '--chart-4', '--chart-5'];

    return Array.from({ length: count }, (_, index) => {
        const color = requested[index] ?? fallback[index];

        return color.startsWith('--') ? cssVar(color) : color;
    });
};

const validNumber = (value, fallback) => (Number.isFinite(Number(value)) ? Number(value) : fallback);

const chartBase = (element) => {
    const dark = root.classList.contains('dark');

    return {
        chart: {
            background: 'transparent',
            fontFamily: cssVar('--font-sans') || 'Instrument Sans',
            toolbar: { show: false },
            zoom: { enabled: false },
            animations: {
                enabled: !window.matchMedia('(prefers-reduced-motion: reduce)').matches,
                speed: 600,
            },
        },
        theme: { mode: dark ? 'dark' : 'light' },
        foreColor: cssVar('--faint'),
        colors: chartPalette(element, 2),
        dataLabels: { enabled: false },
        legend: { show: false },
        grid: {
            borderColor: cssVar('--grid-line'),
            strokeDashArray: 4,
            padding: { top: 4, right: 8, bottom: 0, left: 8 },
            xaxis: { lines: { show: false } },
            yaxis: { lines: { show: true } },
        },
        tooltip: {
            theme: dark ? 'dark' : 'light',
            shared: true,
            intersect: false,
        },
        xaxis: {
            categories: [],
            axisBorder: { show: false },
            axisTicks: { show: false },
            labels: {
                style: { colors: cssVar('--faint'), fontSize: '11px', fontWeight: 500 },
            },
            tooltip: { enabled: false },
        },
        yaxis: {
            labels: {
                style: { colors: cssVar('--faint'), fontSize: '11px', fontWeight: 500 },
            },
        },
    };
};

const axisFormatter = (element) => {
    const prefix = element.dataset.prefix ?? '';
    const suffix = element.dataset.suffix ?? '';

    return (value) => `${prefix}${value}${suffix}`;
};

const renderAreaChart = (element, labels, series) => {
    const base = chartBase(element);
    const colors = chartPalette(element, Math.max(series.length, 2));
    const dashed = (element.dataset.dash ?? '').split(',').map(Number);

    return {
        ...base,
        series: series.map((item) => ({ name: item.name, data: item.data })),
        chart: {
            ...base.chart,
            type: 'area',
            height: validNumber(element.dataset.height, 300),
        },
        colors,
        stroke: {
            curve: 'smooth',
            width: series.length > 1 ? [2.75, 2] : 2.75,
            dashArray: series.length > 1 ? [0, dashed[1] || 5] : 0,
        },
        fill: {
            type: 'gradient',
            gradient: {
                shadeIntensity: 0.2,
                opacityFrom: 0.3,
                opacityTo: 0.02,
                stops: [0, 90, 100],
            },
        },
        markers: {
            size: 0,
            strokeWidth: 2,
            hover: { size: 5 },
        },
        xaxis: {
            ...base.xaxis,
            categories: labels,
        },
        yaxis: {
            ...base.yaxis,
            labels: {
                ...base.yaxis.labels,
                formatter: axisFormatter(element),
            },
        },
        tooltip: {
            ...base.tooltip,
            y: { formatter: axisFormatter(element) },
        },
    };
};

const renderBarChart = (element, labels, series) => {
    const base = chartBase(element);
    const colors = chartPalette(element, Math.max(series.length, 2));

    return {
        ...base,
        series: series.map((item) => ({ name: item.name, data: item.data })),
        chart: {
            ...base.chart,
            type: 'bar',
            height: validNumber(element.dataset.height, 300),
        },
        colors,
        plotOptions: {
            bar: {
                borderRadius: 7,
                borderRadiusApplication: 'end',
                columnWidth: '46%',
            },
        },
        stroke: { show: false, width: 0 },
        xaxis: {
            ...base.xaxis,
            categories: labels,
        },
        yaxis: {
            ...base.yaxis,
            labels: {
                ...base.yaxis.labels,
                formatter: axisFormatter(element),
            },
        },
        tooltip: {
            ...base.tooltip,
            shared: true,
            y: { formatter: axisFormatter(element) },
        },
    };
};

const renderDonutChart = (element, labels, series) => {
    const base = chartBase(element);
    const total = element.dataset.total ?? '';
    const totalLabel = element.dataset.totalLabel ?? 'Total';

    return {
        ...base,
        series,
        labels,
        colors: chartPalette(element, series.length),
        chart: {
            ...base.chart,
            type: 'donut',
            height: validNumber(element.dataset.height, 260),
        },
        stroke: { width: 0 },
        plotOptions: {
            pie: {
                expandOnClick: false,
                donut: {
                    size: '76%',
                    labels: {
                        show: true,
                        name: {
                            show: true,
                            offsetY: -6,
                            color: cssVar('--faint'),
                            fontSize: '11px',
                            fontWeight: 500,
                        },
                        value: {
                            show: false,
                        },
                        total: {
                            show: true,
                            showAlways: true,
                            label: totalLabel,
                            color: cssVar('--faint'),
                            fontSize: '11px',
                            fontWeight: 500,
                            formatter: () => total,
                        },
                    },
                },
            },
        },
        dataLabels: { enabled: false },
        tooltip: {
            ...base.tooltip,
            shared: false,
            y: { formatter: (value) => `${value}%` },
        },
        states: {
            hover: { filter: { type: 'darken', value: 0.94 } },
        },
    };
};

const renderChart = (element) => {
    if (!element.id || element.dataset.chartInitialized === 'true') {
        return;
    }

    const type = element.dataset.chart ?? 'area';
    const labels = element.dataset.labels ? JSON.parse(element.dataset.labels) : [];
    const series = element.dataset.series ? JSON.parse(element.dataset.series) : [];

    let options;

    if (type === 'donut') {
        options = renderDonutChart(element, labels, series);
    } else if (type === 'bar') {
        options = renderBarChart(element, labels, series);
    } else {
        options = renderAreaChart(element, labels, series);
    }

    const chart = new ApexCharts(element, options);
    chart.render();

    charts.set(element.id, chart);
    element.dataset.chartInitialized = 'true';
    element.__aureliaData = { labels, series };
};

const applyChartRange = (element, points) => {
    const chart = charts.get(element.id);

    if (!chart || !element.__aureliaData) {
        return;
    }

    const { labels, series } = element.__aureliaData;

    chart.updateOptions({ xaxis: { categories: labels.slice(-points) } });
    chart.updateSeries(series.map((item) => ({ name: item.name, data: item.data.slice(-points) })));
};

const refreshCharts = () => {
    charts.forEach((chart) => {
        try {
            chart.destroy();
        } catch {
            // The chart may have been unmounted already.
        }
    });
    charts.clear();

    document.querySelectorAll('[data-chart]').forEach((element) => {
        element.dataset.chartInitialized = 'false';
        renderChart(element);

        const card = element.closest('[data-chart-card]');
        const activeRange = card?.querySelector('[data-chart-range].is-active');
        const points = Number(activeRange?.dataset.chartRange ?? 0);

        if (points > 0 && element.__aureliaData && points < element.__aureliaData.labels.length) {
            requestAnimationFrame(() => applyChartRange(element, points));
        }
    });
};

const initCharts = () => {
    document.querySelectorAll('[data-chart]').forEach(renderChart);
};

const initTheme = () => {
    applyTheme(savedTheme(), { persist: false });

    document.querySelectorAll('[data-theme-toggle]').forEach((button) => {
        button.addEventListener('click', () => {
            applyTheme(resolvedTheme() === 'dark' ? 'light' : 'dark');
        });
    });

    document.querySelectorAll('[data-theme-choice]').forEach((choice) => {
        choice.addEventListener('click', () => applyTheme(choice.dataset.themeChoice));
    });

    colorScheme.addEventListener('change', () => {
        if (savedTheme() === 'system') {
            applyTheme('system', { persist: false });
        }
    });

    window.addEventListener('aurelia:theme-changed', refreshCharts);
};

const initSidebar = () => {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebar-overlay');

    if (!sidebar) {
        return;
    }

    const open = () => {
        sidebar.classList.add('is-open');
        overlay?.classList.remove('hidden');
        document.body.classList.add('overflow-hidden', 'lg:overflow-auto');
    };

    const close = () => {
        sidebar.classList.remove('is-open');
        overlay?.classList.add('hidden');
        document.body.classList.remove('overflow-hidden', 'lg:overflow-auto');
    };

    document.querySelectorAll('[data-sidebar-open]').forEach((button) => button.addEventListener('click', open));
    document.querySelectorAll('[data-sidebar-close]').forEach((button) => button.addEventListener('click', close));
    overlay?.addEventListener('click', close);

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
            close();
        }
    });

    window.addEventListener('resize', () => {
        if (window.innerWidth >= 1024) {
            close();
        }
    });
};

const initDropdowns = () => {
    const dropdowns = Array.from(document.querySelectorAll('[data-dropdown-panel]'))
        .map((panel) => ({ panel, trigger: panel.parentElement.querySelector('[data-dropdown-trigger]') }))
        .filter((dropdown) => dropdown.trigger);

    const closeAll = (except = null) => {
        dropdowns.forEach(({ panel, trigger }) => {
            if (panel === except) {
                return;
            }

            panel.classList.add('hidden');
            trigger.setAttribute('aria-expanded', 'false');
        });
    };

    dropdowns.forEach(({ panel, trigger }) => {
        trigger.addEventListener('click', (event) => {
            event.stopPropagation();
            const willOpen = panel.classList.contains('hidden');

            closeAll(willOpen ? panel : null);
            panel.classList.toggle('hidden', !willOpen);
            trigger.setAttribute('aria-expanded', String(willOpen));
        });

        panel.addEventListener('click', (event) => event.stopPropagation());
    });

    document.addEventListener('click', () => closeAll());
    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
            closeAll();
        }
    });
};

const initSearchShortcut = () => {
    document.addEventListener('keydown', (event) => {
        if ((event.metaKey || event.ctrlKey) && event.key.toLowerCase() === 'k') {
            const search = document.getElementById('global-search');

            if (search) {
                event.preventDefault();
                search.focus();
                search.select();
            }
        }
    });
};

const initChartRanges = () => {
    document.querySelectorAll('[data-chart-range]').forEach((button) => {
        button.addEventListener('click', () => {
            const card = button.closest('[data-chart-card]');
            const element = card?.querySelector('[data-chart]');

            if (!element) {
                return;
            }

            const points = validNumber(button.dataset.chartRange, 12);

            applyChartRange(element, points);

            card.querySelectorAll('[data-chart-range]').forEach((rangeButton) => {
                rangeButton.classList.toggle('is-active', rangeButton === button);
                rangeButton.setAttribute('aria-pressed', String(rangeButton === button));
            });
        });
    });
};

const initOrderFilters = () => {
    const tabs = Array.from(document.querySelectorAll('[data-order-filter]'));
    const rows = Array.from(document.querySelectorAll('[data-order-row]'));
    const search = document.getElementById('order-search');
    const counter = document.querySelector('[data-order-count]');

    if (!tabs.length || !rows.length) {
        return;
    }

    let activeFilter = 'all';

    const apply = () => {
        const query = (search?.value ?? '').trim().toLowerCase();
        let visible = 0;

        rows.forEach((row) => {
            const matchesStatus = activeFilter === 'all' || row.dataset.status === activeFilter;
            const matchesSearch = !query || (row.dataset.search ?? '').includes(query);
            const show = matchesStatus && matchesSearch;

            row.classList.toggle('hidden', !show);
            visible += show ? 1 : 0;
        });

        if (counter) {
            counter.textContent = String(visible);
        }
    };

    tabs.forEach((tab) => {
        tab.addEventListener('click', () => {
            activeFilter = tab.dataset.orderFilter;
            tabs.forEach((item) => {
                item.classList.toggle('is-active', item === tab);
                item.setAttribute('aria-selected', String(item === tab));
            });
            apply();
        });
    });

    search?.addEventListener('input', apply);
};

const initCustomerFilters = () => {
    const tabs = Array.from(document.querySelectorAll('[data-customer-filter]'));
    const rows = Array.from(document.querySelectorAll('[data-customer-row]'));
    const search = document.getElementById('customer-search');
    const counter = document.querySelector('[data-customer-count]');

    if (!tabs.length || !rows.length) {
        return;
    }

    let activeFilter = 'all';

    const apply = () => {
        const query = (search?.value ?? '').trim().toLowerCase();
        let visible = 0;

        rows.forEach((row) => {
            const matchesStatus = activeFilter === 'all' || row.dataset.status === activeFilter;
            const matchesSearch = !query || (row.dataset.search ?? '').includes(query);
            const show = matchesStatus && matchesSearch;

            row.classList.toggle('hidden', !show);
            visible += show ? 1 : 0;
        });

        if (counter) {
            counter.textContent = String(visible);
        }
    };

    tabs.forEach((tab) => {
        tab.addEventListener('click', () => {
            activeFilter = tab.dataset.customerFilter;
            tabs.forEach((item) => {
                item.classList.toggle('is-active', item === tab);
                item.setAttribute('aria-selected', String(item === tab));
            });
            apply();
        });
    });

    search?.addEventListener('input', apply);
};

const initSelectAll = () => {
    document.querySelectorAll('[data-select-all]').forEach((master) => {
        const rows = Array.from(document.querySelectorAll('[data-select-row]'));
        master.addEventListener('change', () => {
            rows.forEach((row) => {
                row.checked = master.checked;
            });
        });
    });
};

const initSettingsTabs = () => {
    const tabs = Array.from(document.querySelectorAll('[data-settings-tab]'));
    const panels = Array.from(document.querySelectorAll('[data-settings-panel]'));

    if (!tabs.length || !panels.length) {
        return;
    }

    tabs.forEach((tab) => {
        tab.addEventListener('click', () => {
            tabs.forEach((item) => {
                item.classList.toggle('is-active', item === tab);
                item.setAttribute('aria-selected', String(item === tab));
            });

            panels.forEach((panel) => {
                panel.classList.toggle('hidden', panel.dataset.settingsPanel !== tab.dataset.settingsTab);
            });
        });
    });
};

const initCopyButtons = () => {
    document.querySelectorAll('[data-copy]').forEach((button) => {
        button.addEventListener('click', async () => {
            const value = button.dataset.copy;
            const original = button.innerHTML;

            try {
                await navigator.clipboard.writeText(value);
                button.textContent = 'Copied';
                window.setTimeout(() => {
                    button.innerHTML = original;
                }, 1400);
            } catch {
                // Clipboard access can be blocked by the browser.
            }
        });
    });
};

document.addEventListener('DOMContentLoaded', () => {
    initTheme();
    initSidebar();
    initDropdowns();
    initSearchShortcut();
    initCharts();
    initChartRanges();
    initOrderFilters();
    initCustomerFilters();
    initSelectAll();
    initSettingsTabs();
    initCopyButtons();
});
