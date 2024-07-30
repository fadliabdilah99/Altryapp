<?php

namespace App\Console\Commands;

use App\Models\history;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Twilio\Rest\Client;

class whatsappNotify extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:whatsapp-notify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'mengirim notifikasi whatsapp';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // memanggil data order sewa
        $tersewa = history::where('status', 'proses')->with('user')->with('produk')->get();
        $now = Carbon::now()->format('Y-m-d');
        // notifikasi ke customer
        $sid    = env('TWILIO_SID');
        $token  = env('TWILIO_TOKEN');
        $twilio = new Client($sid, $token);

        foreach ($tersewa as $item) {
            if ($item->sampai_tgl == $now) {
                dd('f');
                $message = $twilio->messages
                    ->create(
                        // ganti dengan nomor whatsapp customer
                        "whatsapp:+6281220786387", // to
                        array(
                            "from" => "whatsapp:+14155238886",
                            "body" => 'hallo ' . $item->user->name . 'kami ingin menginformasikan, bahwa produk yang anda sewa ' . $item->produk->nama . ' besok akan habis. mohon kepada customer yang terhormat agar tidak terlamat mengembalikan karna akan terkena penalti 150% per-hari dari harga sewa'
                        )
                    );
            } elseif ($item->sampai_tgl < $now) {
                dd('d');
                $message = $twilio->messages
                    ->create(
                        // ganti dengan nomor whatsapp customer
                        "whatsapp:+6281220786387", // to
                        array(
                            "from" => "whatsapp:+14155238886",
                            "body" => 'hallo ' . $item->user->name . ' kami ingin menginformasikan, bahwa produk yang anda sewa ' . $item->produk->nama . ' terlambat anda kembalikan, sesuai dengan kesepakatan di awal, anda dikenakan penalti 150% per-hari dari harga sewa di hitung sejak hari ini'
                        )
                    );
            }
        }
    }
}
