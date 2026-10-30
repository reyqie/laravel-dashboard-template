<?php

namespace App\Support;

class Demo
{
    /**
     * @return array<string, mixed>
     */
    public static function dashboard(): array
    {
        return [
            'stats' => [
                [
                    'label' => 'Total revenue',
                    'value' => '$128,430',
                    'delta' => '+12.4%',
                    'trend' => 'up',
                    'caption' => 'vs last month',
                    'icon' => 'circle-dollar-sign',
                    'tone' => 'brand',
                    'spark' => [24, 26, 22, 30, 28, 36, 33, 42, 38, 46, 44, 52],
                ],
                [
                    'label' => 'Active customers',
                    'value' => '8,942',
                    'delta' => '+8.1%',
                    'trend' => 'up',
                    'caption' => 'vs last month',
                    'icon' => 'users',
                    'tone' => 'positive',
                    'spark' => [12, 18, 15, 22, 20, 26, 24, 30, 28, 33, 31, 38],
                ],
                [
                    'label' => 'Conversion rate',
                    'value' => '3.84%',
                    'delta' => '-0.6%',
                    'trend' => 'down',
                    'caption' => 'vs last month',
                    'icon' => 'target',
                    'tone' => 'warning',
                    'spark' => [40, 38, 41, 36, 39, 35, 37, 34, 36, 33, 35, 32],
                ],
                [
                    'label' => 'Avg. order value',
                    'value' => '$86.20',
                    'delta' => '+4.2%',
                    'trend' => 'up',
                    'caption' => 'vs last month',
                    'icon' => 'shopping-bag',
                    'tone' => 'info',
                    'spark' => [30, 28, 31, 29, 33, 32, 35, 34, 37, 36, 39, 41],
                ],
            ],
            'revenue' => [
                'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                'series' => [
                    ['name' => 'This year', 'data' => [32, 38, 35, 44, 41, 52, 48, 58, 55, 64, 60, 72]],
                    ['name' => 'Last year', 'data' => [24, 28, 26, 32, 30, 37, 35, 42, 40, 46, 44, 52]],
                ],
            ],
            'goal' => [
                'percent' => 72,
                'achieved' => '$128,430',
                'target' => '$178,000',
                'remaining' => '$49,570',
                'daysLeft' => 12,
            ],
            'channels' => [
                ['name' => 'Direct traffic', 'value' => 42, 'amount' => '10,438', 'color' => 'bg-brand'],
                ['name' => 'Organic search', 'value' => 31, 'amount' => '7,704', 'color' => 'bg-positive'],
                ['name' => 'Referral', 'value' => 18, 'amount' => '4,473', 'color' => 'bg-warning'],
                ['name' => 'Social media', 'value' => 9, 'amount' => '2,237', 'color' => 'bg-[var(--chart-4)]'],
            ],
            'transactions' => [
                ['id' => '#AUR-2048', 'name' => 'Nadia Putri', 'email' => 'nadia@northwind.co', 'date' => 'Oct 30, 2026', 'status' => 'Paid', 'amount' => '$1,248.00', 'method' => 'Visa •• 4242', 'tone' => 'brand'],
                ['id' => '#AUR-2047', 'name' => 'Marcus Chen', 'email' => 'marcus@lumio.io', 'date' => 'Oct 30, 2026', 'status' => 'Paid', 'amount' => '$860.00', 'method' => 'Mastercard •• 8810', 'tone' => 'info'],
                ['id' => '#AUR-2046', 'name' => 'Sofia Reyes', 'email' => 'sofia@atelier.studio', 'date' => 'Oct 29, 2026', 'status' => 'Pending', 'amount' => '$2,140.00', 'method' => 'Bank transfer', 'tone' => 'warning'],
                ['id' => '#AUR-2045', 'name' => 'Daniel Okafor', 'email' => 'daniel@vertexhq.com', 'date' => 'Oct 29, 2026', 'status' => 'Paid', 'amount' => '$412.50', 'method' => 'Visa •• 1139', 'tone' => 'positive'],
                ['id' => '#AUR-2044', 'name' => 'Amara Singh', 'email' => 'amara@thefield.in', 'date' => 'Oct 28, 2026', 'status' => 'Refunded', 'amount' => '$228.00', 'method' => 'PayPal', 'tone' => 'negative'],
                ['id' => '#AUR-2043', 'name' => 'Lucas Weber', 'email' => 'lucas@nordform.de', 'date' => 'Oct 28, 2026', 'status' => 'Paid', 'amount' => '$1,086.00', 'method' => 'Visa •• 7761', 'tone' => 'brand'],
            ],
            'products' => [
                ['name' => 'Aurora Pro Plan', 'category' => 'Subscription', 'sales' => 128, 'revenue' => '$12,800', 'growth' => '+18.2%', 'trend' => 'up', 'tone' => 'brand'],
                ['name' => 'Atlas Analytics', 'category' => 'Add-on', 'sales' => 96, 'revenue' => '$8,640', 'growth' => '+12.4%', 'trend' => 'up', 'tone' => 'info'],
                ['name' => 'Nimbus Storage', 'category' => 'Usage', 'sales' => 74, 'revenue' => '$4,440', 'growth' => '-2.1%', 'trend' => 'down', 'tone' => 'positive'],
                ['name' => 'Orbit Support', 'category' => 'Service', 'sales' => 52, 'revenue' => '$3,120', 'growth' => '+6.8%', 'trend' => 'up', 'tone' => 'warning'],
            ],
            'activities' => [
                ['name' => 'Amara Singh upgraded to Scale', 'meta' => 'Subscription change', 'time' => '2m ago', 'icon' => 'user-plus', 'tone' => 'positive'],
                ['name' => 'Invoice #AUR-2039 paid', 'meta' => '$2,480.00 received', 'time' => '18m ago', 'icon' => 'credit-card', 'tone' => 'brand'],
                ['name' => 'New teammate joined Design', 'meta' => 'Maya Collins accepted invite', 'time' => '1h ago', 'icon' => 'users', 'tone' => 'info'],
                ['name' => 'Payout to bank completed', 'meta' => '$12,600.00 transferred', 'time' => '3h ago', 'icon' => 'wallet', 'tone' => 'warning'],
            ],
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public static function analytics(): array
    {
        return [
            'stats' => [
                ['label' => 'Sessions', 'value' => '248,920', 'delta' => '+18.2%', 'trend' => 'up', 'icon' => 'activity'],
                ['label' => 'Unique visitors', 'value' => '96,420', 'delta' => '+9.4%', 'trend' => 'up', 'icon' => 'users'],
                ['label' => 'Avg. session', 'value' => '4m 32s', 'delta' => '+12s', 'trend' => 'up', 'icon' => 'clock'],
                ['label' => 'Bounce rate', 'value' => '32.8%', 'delta' => '-3.4%', 'trend' => 'down', 'icon' => 'move-right'],
            ],
            'sessions' => [
                'labels' => ['May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
                'series' => [
                    ['name' => 'Sessions', 'data' => [18, 24, 22, 31, 29, 38]],
                    ['name' => 'Conversions', 'data' => [6, 8, 7, 11, 10, 14]],
                ],
            ],
            'devices' => [
                'labels' => ['Desktop', 'Mobile', 'Tablet'],
                'series' => [58, 35, 7],
                'total' => '96.4k',
                'totalLabel' => 'Visitors',
            ],
            'target' => [
                'labels' => ['May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
                'series' => [
                    ['name' => 'Actual', 'data' => [58, 64, 61, 72, 78, 86]],
                    ['name' => 'Target', 'data' => [60, 65, 68, 72, 80, 84]],
                ],
            ],
            'pages' => [
                ['path' => '/pricing', 'title' => 'Pricing plans', 'views' => '42,318', 'unique' => '28,104', 'bounce' => '24.2%', 'delta' => '+18.2%', 'trend' => 'up', 'spark' => [18, 22, 20, 28, 26, 32, 30, 36]],
                ['path' => '/', 'title' => 'Homepage', 'views' => '38,940', 'unique' => '31,882', 'bounce' => '32.6%', 'delta' => '+9.4%', 'trend' => 'up', 'spark' => [26, 24, 28, 27, 31, 30, 34, 33]],
                ['path' => '/docs/getting-started', 'title' => 'Getting started', 'views' => '21,470', 'unique' => '16,220', 'bounce' => '18.4%', 'delta' => '+22.6%', 'trend' => 'up', 'spark' => [12, 15, 14, 18, 17, 21, 23, 25]],
                ['path' => '/blog/design-systems', 'title' => 'Design systems', 'views' => '14,892', 'unique' => '11,408', 'bounce' => '41.1%', 'delta' => '-6.2%', 'trend' => 'down', 'spark' => [22, 20, 21, 19, 20, 18, 19, 17]],
                ['path' => '/changelog', 'title' => 'Product changelog', 'views' => '9,124', 'unique' => '7,860', 'bounce' => '28.8%', 'delta' => '+11.8%', 'trend' => 'up', 'spark' => [8, 10, 9, 12, 13, 12, 15, 16]],
            ],
            'acquisition' => [
                ['label' => 'Organic search', 'value' => 68, 'amount' => '64,208', 'color' => 'bg-brand'],
                ['label' => 'Paid campaigns', 'value' => 42, 'amount' => '39,884', 'color' => 'bg-positive'],
                ['label' => 'Social media', 'value' => 31, 'amount' => '28,410', 'color' => 'bg-warning'],
                ['label' => 'Email flows', 'value' => 24, 'amount' => '21,760', 'color' => 'bg-[var(--chart-4)]'],
                ['label' => 'Referrals', 'value' => 18, 'amount' => '15,930', 'color' => 'bg-info'],
            ],
            'countries' => [
                ['code' => 'US', 'name' => 'United States', 'value' => 38, 'amount' => '36,640'],
                ['code' => 'DE', 'name' => 'Germany', 'value' => 22, 'amount' => '21,218'],
                ['code' => 'ID', 'name' => 'Indonesia', 'value' => 16, 'amount' => '15,432'],
                ['code' => 'GB', 'name' => 'United Kingdom', 'value' => 13, 'amount' => '12,538'],
            ],
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public static function orders(): array
    {
        return [
            'summary' => [
                ['label' => 'Total orders', 'value' => '1,284', 'status' => 'all', 'dot' => 'bg-ink'],
                ['label' => 'Paid', 'value' => '986', 'status' => 'paid', 'dot' => 'bg-positive'],
                ['label' => 'Pending', 'value' => '214', 'status' => 'pending', 'dot' => 'bg-warning'],
                ['label' => 'Refunded', 'value' => '84', 'status' => 'refunded', 'dot' => 'bg-negative'],
            ],
            'orders' => [
                ['id' => '#AUR-2048', 'name' => 'Nadia Putri', 'email' => 'nadia@northwind.co', 'date' => 'Oct 30, 2026', 'time' => '09:42', 'items' => 3, 'total' => '$1,248.00', 'status' => 'paid', 'method' => 'Visa •• 4242', 'tone' => 'brand'],
                ['id' => '#AUR-2047', 'name' => 'Marcus Chen', 'email' => 'marcus@lumio.io', 'date' => 'Oct 30, 2026', 'time' => '08:16', 'items' => 1, 'total' => '$860.00', 'status' => 'paid', 'method' => 'Mastercard •• 8810', 'tone' => 'info'],
                ['id' => '#AUR-2046', 'name' => 'Sofia Reyes', 'email' => 'sofia@atelier.studio', 'date' => 'Oct 29, 2026', 'time' => '21:04', 'items' => 4, 'total' => '$2,140.00', 'status' => 'pending', 'method' => 'Bank transfer', 'tone' => 'warning'],
                ['id' => '#AUR-2045', 'name' => 'Daniel Okafor', 'email' => 'daniel@vertexhq.com', 'date' => 'Oct 29, 2026', 'time' => '17:38', 'items' => 2, 'total' => '$412.50', 'status' => 'paid', 'method' => 'Visa •• 1139', 'tone' => 'positive'],
                ['id' => '#AUR-2044', 'name' => 'Amara Singh', 'email' => 'amara@thefield.in', 'date' => 'Oct 28, 2026', 'time' => '15:12', 'items' => 1, 'total' => '$228.00', 'status' => 'refunded', 'method' => 'PayPal', 'tone' => 'negative'],
                ['id' => '#AUR-2043', 'name' => 'Lucas Weber', 'email' => 'lucas@nordform.de', 'date' => 'Oct 28, 2026', 'time' => '11:56', 'items' => 5, 'total' => '$1,086.00', 'status' => 'paid', 'method' => 'Visa •• 7761', 'tone' => 'brand'],
                ['id' => '#AUR-2042', 'name' => 'Elena Rossi', 'email' => 'elena@studioform.it', 'date' => 'Oct 27, 2026', 'time' => '19:21', 'items' => 2, 'total' => '$534.00', 'status' => 'pending', 'method' => 'Amex •• 3004', 'tone' => 'info'],
                ['id' => '#AUR-2041', 'name' => 'Kai Nakamura', 'email' => 'kai@hikari.jp', 'date' => 'Oct 27, 2026', 'time' => '10:09', 'items' => 3, 'total' => '$742.00', 'status' => 'paid', 'method' => 'Visa •• 5520', 'tone' => 'warning'],
            ],
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public static function customers(): array
    {
        return [
            'summary' => [
                ['label' => 'All customers', 'value' => '8,942', 'delta' => '+8.1%', 'trend' => 'up', 'icon' => 'users', 'tone' => 'brand'],
                ['label' => 'New this month', 'value' => '128', 'delta' => '+14.2%', 'trend' => 'up', 'icon' => 'user-plus', 'tone' => 'positive'],
                ['label' => 'Returning', 'value' => '412', 'delta' => '+3.6%', 'trend' => 'up', 'icon' => 'refresh-cw', 'tone' => 'info'],
                ['label' => 'At risk', 'value' => '36', 'delta' => '-8.4%', 'trend' => 'down', 'icon' => 'triangle-alert', 'tone' => 'warning'],
            ],
            'customers' => [
                ['name' => 'Nadia Putri', 'email' => 'nadia@northwind.co', 'plan' => 'Scale', 'spend' => '$12,480', 'orders' => 42, 'active' => '2 minutes ago', 'status' => 'Active', 'tone' => 'brand'],
                ['name' => 'Marcus Chen', 'email' => 'marcus@lumio.io', 'plan' => 'Pro', 'spend' => '$8,260', 'orders' => 31, 'active' => '1 hour ago', 'status' => 'Active', 'tone' => 'info'],
                ['name' => 'Sofia Reyes', 'email' => 'sofia@atelier.studio', 'plan' => 'Scale', 'spend' => '$7,940', 'orders' => 28, 'active' => '3 hours ago', 'status' => 'Active', 'tone' => 'warning'],
                ['name' => 'Daniel Okafor', 'email' => 'daniel@vertexhq.com', 'plan' => 'Starter', 'spend' => '$2,120', 'orders' => 12, 'active' => 'Yesterday', 'status' => 'Trial', 'tone' => 'positive'],
                ['name' => 'Amara Singh', 'email' => 'amara@thefield.in', 'plan' => 'Pro', 'spend' => '$5,860', 'orders' => 24, 'active' => '3 days ago', 'status' => 'At risk', 'tone' => 'negative'],
                ['name' => 'Lucas Weber', 'email' => 'lucas@nordform.de', 'plan' => 'Pro', 'spend' => '$4,380', 'orders' => 19, 'active' => '4 days ago', 'status' => 'Active', 'tone' => 'brand'],
                ['name' => 'Elena Rossi', 'email' => 'elena@studioform.it', 'plan' => 'Starter', 'spend' => '$1,240', 'orders' => 7, 'active' => '1 week ago', 'status' => 'Churned', 'tone' => 'warning'],
                ['name' => 'Kai Nakamura', 'email' => 'kai@hikari.jp', 'plan' => 'Scale', 'spend' => '$9,720', 'orders' => 36, 'active' => '1 week ago', 'status' => 'Active', 'tone' => 'info'],
            ],
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public static function settings(): array
    {
        return [
            'invoices' => [
                ['id' => 'AUR-0092', 'date' => 'Oct 01, 2026', 'amount' => '$49.00', 'status' => 'Paid'],
                ['id' => 'AUR-0091', 'date' => 'Sep 01, 2026', 'amount' => '$49.00', 'status' => 'Paid'],
                ['id' => 'AUR-0090', 'date' => 'Aug 01, 2026', 'amount' => '$49.00', 'status' => 'Paid'],
            ],
        ];
    }
}
