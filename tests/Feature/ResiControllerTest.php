<?php

namespace Tests\Feature;

use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class ResiControllerTest extends TestCase
{
    // ===== Task 10.5 — Unit tests individual =====

    /** @test */
    public function test_valid_resi_format_returns_json_response(): void
    {
        $response = $this->postJson('/resi/track', ['resi' => 'SRV-1234']);

        $this->assertContains($response->status(), [200, 404]);
        $response->assertJsonStructure(['found']);
    }

    /** @test */
    public function test_empty_resi_returns_validation_error(): void
    {
        $response = $this->postJson('/resi/track', ['resi' => '']);

        $response->assertStatus(422);
        $response->assertJsonStructure(['errors']);
    }

    /** @test */
    public function test_invalid_format_without_prefix_returns_validation_error(): void
    {
        $response = $this->postJson('/resi/track', ['resi' => '1234']);

        $response->assertStatus(422);
        $response->assertJsonStructure(['errors']);
    }

    /** @test */
    public function test_invalid_format_with_letters_after_prefix_returns_validation_error(): void
    {
        $response = $this->postJson('/resi/track', ['resi' => 'SRV-ABCD']);

        $response->assertStatus(422);
        $response->assertJsonStructure(['errors']);
    }

    /** @test */
    public function test_valid_resi_not_in_database_returns_not_found(): void
    {
        // SRV-0000 is not in the demo data, so should return 404
        $response = $this->postJson('/resi/track', ['resi' => 'SRV-0000']);

        $response->assertStatus(404);
        $response->assertJson(['found' => false]);
    }

    /** @test */
    public function test_valid_resi_in_demo_data_returns_found(): void
    {
        $response = $this->postJson('/resi/track', ['resi' => 'SRV-1234']);

        $response->assertStatus(200);
        $response->assertJson(['found' => true]);
        $response->assertJsonStructure(['status', 'estimasi']);
    }

    // ===== Task 10.3 — Property Test 1: valid resi format is accepted =====

    /**
     * Property: For ANY string matching SRV-\d{4}, the endpoint SHALL return
     * HTTP 200 or 404 (never 422) and the body SHALL contain key `found`.
     *
     * Validates: Requirements 2.4
     *
     * @test
     */
    #[DataProvider('validResiProvider')]
    public function test_valid_resi_format_is_accepted(string $resi): void
    {
        $response = $this->postJson('/resi/track', ['resi' => $resi]);

        $this->assertContains(
            $response->status(),
            [200, 404],
            "Expected 200 or 404 for valid resi {$resi}, got {$response->status()}"
        );
        $response->assertJsonStructure(['found']);
    }

    /** @return array<array{string}> */
    public static function validResiProvider(): array
    {
        // 100 samples from SRV-0000 to SRV-9999 (step 100)
        return array_map(
            fn ($n) => [sprintf('SRV-%04d', $n)],
            range(0, 9999, 100)
        );
    }

    // ===== Task 10.4 — Property Test 2: invalid resi format is rejected =====

    /**
     * Property: For ANY string that is empty, lacks the SRV- prefix, or has
     * non-digit characters after SRV-, the endpoint SHALL return HTTP 422
     * with an `errors` key.
     *
     * Validates: Requirements 2.5
     *
     * @test
     */
    #[DataProvider('invalidResiProvider')]
    public function test_invalid_resi_format_is_rejected(string $resi): void
    {
        $response = $this->postJson('/resi/track', ['resi' => $resi]);

        $response->assertStatus(422);
        $response->assertJsonStructure(['errors']);
    }

    /** @return array<array{string}> */
    public static function invalidResiProvider(): array
    {
        return [
            [''],            // empty
            ['SRV-'],        // no digits
            ['SRV-12'],      // too short (2 digits)
            ['SRV-123'],     // too short (3 digits)
            ['SRV-12345'],   // too long (5 digits)
            ['SRV-ABCD'],    // letters not digits
            ['1234'],        // no prefix
            ['srv-1234'],    // lowercase prefix
            ['SRV 1234'],    // space instead of dash
            ['SRV_1234'],    // underscore instead of dash
            ['SRV--1234'],   // double dash
            ['SRVSRV-1234'], // wrong prefix
        ];
    }
}
