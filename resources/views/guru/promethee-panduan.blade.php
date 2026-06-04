<div
    id="modalInfoPromethee"
    class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50 p-3 sm:p-4">

    <div class="bg-white w-full max-w-[95vw] sm:max-w-2xl lg:max-w-3xl rounded-2xl sm:rounded-3xl shadow-xl overflow-hidden">

        <div class="bg-gradient-to-r from-[#105666] to-[#839958] px-4 sm:px-6 py-4 flex justify-between items-center">

            <h2 class="text-sm sm:text-lg lg:text-xl font-bold text-white">
                Penjelasan Perhitungan PROMETHEE
            </h2>

            <button
                onclick="closeInfoPromethee()"
                class="text-white text-lg sm:text-xl">

                <i class="fa-solid fa-xmark"></i>

            </button>

        </div>

        <div class="p-4 sm:p-6 max-h-[75vh] overflow-y-auto">

            <h3 class="font-bold text-[#105666] text-lg mb-3">
                1. Leaving Flow (Φ⁺)
            </h3>

            <p class="text-gray-600 leading-7 mb-4">
                Leaving Flow digunakan untuk melihat seberapa besar suatu
                alternatif lebih unggul dibanding alternatif lainnya.
            </p>

            <div class="bg-slate-50 p-4 rounded-xl mb-6">
                Φ⁺(a) = Σ π(a,b) / (n-1)
            </div>

            <p class="mb-8 text-gray-600">
                Jumlahkan seluruh nilai preferensi pada baris alternatif,
                kemudian dibagi jumlah alternatif dikurangi satu.
            </p>

            <h3 class="font-bold text-[#105666] text-lg mb-3">
                2. Entering Flow (Φ⁻)
            </h3>

            <p class="text-gray-600 leading-7 mb-4">
                Entering Flow menunjukkan seberapa besar alternatif lain
                lebih unggul dibanding alternatif tersebut.
            </p>

            <div class="bg-slate-50 p-4 rounded-xl mb-6">
                Φ⁻(a) = Σ π(b,a) / (n-1)
            </div>

            <p class="mb-8 text-gray-600">
                Jumlahkan seluruh nilai preferensi pada kolom alternatif,
                kemudian dibagi jumlah alternatif dikurangi satu.
            </p>

            <h3 class="font-bold text-[#105666] text-lg mb-3">
                3. Net Flow (Φ)
            </h3>

            <p class="text-gray-600 leading-7 mb-4">
                Net Flow digunakan untuk menentukan ranking akhir.
            </p>

            <div class="bg-slate-50 p-4 rounded-xl mb-6">
                Φ(a) = Φ⁺(a) − Φ⁻(a)
            </div>

            <p class="text-gray-600">
                Semakin besar nilai Net Flow maka semakin tinggi
                rekomendasi jurusan tersebut.
            </p>

            <div class="mt-6 p-4 bg-green-50 rounded-xl border border-green-200">

                <h4 class="font-semibold text-green-700 mb-2">
                    Interpretasi
                </h4>

                <ul class="list-disc ml-5 text-sm text-green-700 space-y-1">
                    <li>Leaving Flow tinggi = alternatif banyak mengungguli alternatif lain.</li>
                    <li>Entering Flow rendah = sedikit alternatif yang mengunggulinya.</li>
                    <li>Net Flow tertinggi = ranking terbaik.</li>
                </ul>

            </div>

        </div>

    </div>

</div>

<div
    id="modalInfoPreferensi"
    class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50 p-3 sm:p-4">

    <div class="bg-white w-full max-w-[95vw] sm:max-w-3xl lg:max-w-4xl rounded-2xl sm:rounded-3xl shadow-xl overflow-hidden">

        <div class="bg-gradient-to-r from-[#105666] to-[#839958] px-4 sm:px-6 py-4 flex justify-between items-center">

            <h2 class="text-sm sm:text-lg lg:text-xl font-bold text-white">
                Penjelasan Nilai Preferensi
            </h2>

            <button
                onclick="closeInfoPreferensi()"
                class="text-white text-lg sm:text-xl">

                <i class="fa-solid fa-xmark"></i>

            </button>

        </div>

        <div class="p-4 sm:p-6 max-h-[75vh] overflow-y-auto">

            <h3 class="font-bold text-[#105666] text-lg mb-3">
                1. Preferensi Kriteria Pj(a,b)
            </h3>

            <p class="text-gray-600 mb-4">
                Setiap alternatif dibandingkan dengan alternatif lain
                berdasarkan masing-masing kriteria (C1, C2, dan C3).
            </p>

            <div class="bg-slate-50 p-4 rounded-xl mb-4">

                <p class="font-semibold mb-2">
                    Fungsi Preferensi:
                </p>

                <p>
                    Jika h = a - b ≤ 0 maka Pj(a,b) = 0
                </p>

                <p>
                    Jika h = a - b > 0 maka Pj(a,b) = 1
                </p>

            </div>

            <div class="bg-blue-50 border border-blue-200 p-4 rounded-xl mb-6">

                <p class="font-semibold mb-2">
                    Contoh:
                </p>

                <p>
                    C1(IPA) = 4 dan C1(IPS) = 3
                </p>

                <p>
                    h = 4 - 3 = 1
                </p>

                <p>
                    Karena h > 0 maka P(C1) = 1
                </p>

            </div>

            <hr class="my-6">

            <h3 class="font-bold text-[#105666] text-lg mb-3">
                2. Indeks Preferensi Multikriteria π(a,b)
            </h3>

            <p class="text-gray-600 mb-4">
                Nilai preferensi setiap kriteria dijumlahkan kemudian dibagi jumlah kriteria.
            </p>

            <div class="bg-slate-50 p-4 rounded-xl mb-4">

                <p>
                    π(a,b) = (P1 + P2 + P3) / 3
                </p>

            </div>

            <div class="bg-green-50 border border-green-200 p-4 rounded-xl">

                <p class="font-semibold mb-2">
                    Contoh:
                </p>

                <p>
                    P1 = 1
                </p>

                <p>
                    P2 = 0
                </p>

                <p>
                    P3 = 1
                </p>

                <p class="mt-2">
                    π(a,b) = (1 + 0 + 1) / 3 = 0.67
                </p>

            </div>

            <div class="mt-6 p-4 rounded-xl bg-yellow-50 border border-yellow-200">

                <p class="font-semibold text-yellow-700 mb-2">
                    Keterangan
                </p>

                <ul class="list-disc ml-5 text-sm text-yellow-700 space-y-1">

                    <li>P1 = Preferensi Kriteria Akademik (C1)</li>

                    <li>P2 = Preferensi Kriteria Minat (C2)</li>

                    <li>P3 = Preferensi Kriteria Kepribadian (C3)</li>

                    <li>3 = jumlah kriteria yang digunakan</li>

                </ul>

            </div>

        </div>

    </div>

</div>