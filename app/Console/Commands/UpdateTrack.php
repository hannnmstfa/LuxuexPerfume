<?php

namespace App\Console\Commands;

use App\Http\Controllers\RajaOngkirController;
use App\Models\Tracking;
use App\Models\TrackingDetails;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Throwable;

class UpdateTrack extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'track:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command untuk update status tracking pengiriman';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('track:update dimulai');
        Log::info('track:update dimulai');

        try {
            $trackings = Tracking::with(['trackings_details'])
                ->where('status', 'dalam pengiriman')
                ->get();

            $this->info('Jumlah tracking ditemukan: ' . $trackings->count());
            Log::info('Jumlah tracking ditemukan', [
                'total' => $trackings->count(),
            ]);

            $successCount = 0;
            $failedCount = 0;

            foreach ($trackings as $tracking) {
                try {
                    $this->info("Proses tracking ID {$tracking->id} | Resi {$tracking->resi}");

                    Log::info('Proses tracking', [
                        'tracking_id' => $tracking->id,
                        'resi' => $tracking->resi,
                        'ekspedisi' => $tracking->ekspedisi,
                    ]);

                    $rajaongkir = new RajaOngkirController();
                    $respon = $rajaongkir->cekResi(
                        $tracking->resi,
                        $tracking->ekspedisi,
                        $tracking->last_phone
                    );

                    if (
                        !is_array($respon) ||
                        empty($respon['data']) ||
                        !is_array($respon['data'])
                    ) {
                        $message = $respon['meta']['message'] ?? 'Response tracking tidak valid';

                        $this->error("Gagal cek resi {$tracking->resi}: {$message}");
                        Log::warning('Gagal cek resi', [
                            'tracking_id' => $tracking->id,
                            'resi' => $tracking->resi,
                            'message' => $message,
                            'response' => $respon,
                        ]);

                        $failedCount++; 
                        continue;
                    }

                    if ($respon['data']['delivered']) {
                        if (isset($respon['data']['delivery_status'])) {
                            if (str_contains($respon['data']['delivery_status']['pod_date'], ' ')) {
                                $datetime = $respon['data']['delivery_status']['pod_date'];
                            } else {
                                $manifestTime = $respon['data']['delivery_status']['pod_time'] ?? '00:00:00';
                                $datetime = trim($respon['data']['delivery_status']['pod_date'] . ' ' . $manifestTime);
                            }
                        } else {
                            $datetime = now();
                        }
                        $tracking->update([
                            'status' => 'pengiriman selesai',
                            'received_at' => $datetime,
                        ]);

                        $this->info("Tracking {$tracking->resi} selesai dikirim");
                        Log::info('Tracking selesai dikirim', [
                            'tracking_id' => $tracking->id,
                            'resi' => $tracking->resi,
                        ]);
                    }

                    foreach ($tracking->trackings_details as $trackLama) {
                        $trackLama->delete();
                    }

                    $manifestCount = 0;

                    foreach ($respon['data']['manifest'] ?? [] as $data) {
                        if (!empty($data['manifest_date'])) {
                            if (str_contains($data['manifest_date'], ' ')) {
                                $datetime = $data['manifest_date'];
                            } else {
                                $manifestTime = $data['manifest_time'] ?? '00:00:00';
                                $datetime = trim($data['manifest_date'] . ' ' . $manifestTime);
                            }
                        } else {
                            $datetime = now();
                        }

                        TrackingDetails::forceCreate([
                            'trackings_id' => $tracking->id,
                            'deskripsi' => $data['manifest_description'] ?? '-',
                            'created_at' => $datetime,
                        ]);

                        $manifestCount++;
                    }

                    $this->info("Detail manifest disimpan: {$manifestCount}");
                    Log::info('Detail manifest disimpan', [
                        'tracking_id' => $tracking->id,
                        'jumlah_manifest' => $manifestCount,
                    ]);

                    $successCount++;
                } catch (Throwable $e) {
                    $this->error("Error saat proses resi {$tracking->resi}: " . $e->getMessage());

                    Log::error('Error saat proses tracking', [
                        'tracking_id' => $tracking->id,
                        'resi' => $tracking->resi,
                        'message' => $e->getMessage(),
                        'line' => $e->getLine(),
                        'file' => $e->getFile(),
                    ]);

                    $failedCount++;
                    continue;
                }
            }

            $this->info("track:update selesai. Berhasil: {$successCount}, Gagal: {$failedCount}");
            Log::info('track:update selesai', [
                'berhasil' => $successCount,
                'gagal' => $failedCount,
            ]);

            return self::SUCCESS;
        } catch (Throwable $e) {
            $this->error('track:update gagal total: ' . $e->getMessage());

            Log::error('track:update gagal total', [
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
            ]);

            return self::FAILURE;
        }
    }
}