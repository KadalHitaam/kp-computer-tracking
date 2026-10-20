<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ResiController extends Controller
{
    /**
     * Track a service order by resi number.
     *
     * Returns JSON with service status. Uses dummy data while the
     * ServiceOrder model / migration has not been created yet.
     */
    public function track(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'resi' => ['required', 'string', 'regex:/^SRV-\d{4}$/'],
        ]);

        /**
         * TODO: Replace with real DB query once ServiceOrder model exists:
         * $order = ServiceOrder::where('resi', $validated['resi'])->first();
         * if (! $order) { return response()->json([...], 404); }
         * return response()->json([...]);
         */

        /** @var array<string, array{status: string, estimasi: string}> $demoData */
        $demoData = [
            'SRV-1234' => ['status' => 'Sedang Dikerjakan', 'estimasi' => '2–3 hari kerja'],
            'SRV-0001' => ['status' => 'Diterima', 'estimasi' => '1–2 hari kerja'],
            'SRV-9999' => ['status' => 'Selesai', 'estimasi' => 'Siap diambil'],
        ];

        $resi = $validated['resi'];

        if (! isset($demoData[$resi])) {
            return response()->json([
                'found' => false,
                'message' => 'Nomor resi tidak ditemukan.',
            ], 404);
        }

        return response()->json([
            'found' => true,
            'resi' => $resi,
            'status' => $demoData[$resi]['status'],
            'estimasi' => $demoData[$resi]['estimasi'],
        ]);
    }
}
