<?php

namespace Tests\Feature;

use Tests\TestCase as BaseTestCase;

class WelcomePageTest extends BaseTestCase
{
    // ===== Task 2.2 — Navbar =====

    /** @test */
    public function test_welcome_page_loads_successfully(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    /** @test */
    public function test_navbar_contains_whatsapp_cta(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Hubungi WhatsApp');
    }

    // ===== Task 4.3 — Social Proof Bar =====

    /** @test */
    public function test_social_proof_bar_contains_brand_names(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('ASUS');
        $response->assertSee('Lenovo');
        $response->assertSee('Acer');
        $response->assertSee('HP');
        $response->assertSee('MSI');
    }

    /** @test */
    public function test_social_proof_bar_contains_all_six_brands(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('ASUS');
        $response->assertSee('Lenovo');
        $response->assertSee('Acer');
        $response->assertSee('HP');
        $response->assertSee('MSI');
        $response->assertSee('Dell');
    }

    // ===== Task 2.2 — Hero Section =====

    /** @test */
    public function test_hero_section_contains_badge_text(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Terpercaya Sejak 2018');
    }

    // ===== Task 6.3 — Services / Stats =====

    /** @test */
    public function test_services_section_contains_stat_numbers(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('5.200+');
        $response->assertSee('98%');
        $response->assertSee('6 Bulan');
    }

    /** @test */
    public function test_services_section_contains_main_service_cards(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Jasa Servis & Upgrade');
        $response->assertSee('Katalog Laptop');
        $response->assertSee('Pusat Sparepart Original');
    }

    // ===== Task 8.2 — Footer =====

    /** @test */
    public function test_footer_contains_current_year(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee(date('Y'));
    }

    /** @test */
    public function test_footer_contains_store_address(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Jakarta');
    }
}
