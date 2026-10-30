<?php

namespace Tests\Feature;

use Tests\TestCase;

class TemplatePagesTest extends TestCase
{
    public function test_template_pages_render(): void
    {
        $pages = [
            '/' => ['Good morning', 'Revenue overview'],
            '/analytics' => ['Top pages', 'Top countries'],
            '/orders' => ['All orders', 'Export CSV'],
            '/customers' => ['Customer directory', 'At risk'],
            '/settings' => ['Appearance', 'Email notifications'],
        ];

        foreach ($pages as $uri => $expected) {
            $response = $this->get($uri)->assertOk();

            foreach ($expected as $text) {
                $response->assertSee($text);
            }
        }
    }

    public function test_template_shell_includes_theme_support(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSee('aurelia-theme', false)
            ->assertSee('data-theme-toggle', false);
    }
}
