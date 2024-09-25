<?php

class product{


public function tambahStok(Request $request)
    {

        $request->validate([
            'produk_id' => 'required|integer',
            'stok' => 'required|integer',
        ]);

        try {

            $produk = Produk::where('produk_id', $request->produk_id)->first();



            $stokProduk = StokProduk::where('produk_id', $request->produk_id)->with('produk')->first();

            if ($stokProduk) {

                
                $stokAwal = $stokProduk->stok;
                $stokAkhir = $stokAwal + $request->stok;

                $stokProduk->stok = $stokAkhir;
                $stokProduk->update_stok += $request->stok;
                $stokProduk->save();


                StokProduk::create([
                    'produk_id' => $produk->produk_id,
                    'stok' => (int) $stokAkhir,
                    'update_stok' => (int) $request->stok,
                    'stok_awal' => $stokAwal,
                ]);
            } else {
                
                $stokAwal = 0; 
                $stokAkhir = $request->stok; 

                $stokProduk = StokProduk::create([
                    'produk_id' => $produk->produk_id,
                    'stok' => $stokAkhir,
                    'update_stok' => $request->stok,
                    'stok_awal' => $stokAwal,
                ]);
            }



            return ApiResponse::success('Berhasil Menambahkan Stok', [], 201);
        } catch (\Exception $e) {

            Log::Error($e);
            return ApiResponse::error('Internal Server Error: ' . $e->getMessage(), 500);
        }
    }
}