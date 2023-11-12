<section class="page-section" id="about">
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">About NaiveStudent</h2>
            <h3 class="section-subheading text-muted">Aplikasi prediksi kelulusan tepat
                 waktu mahasiswa kami memanfaatkan algoritma Naive Bayes untuk memberikan proyeksi kelulusan.
                  Data akademik, partisipasi, dan variabel relevan digunakan untuk memperkirakan kemungkinan
                   kelulusan tepat waktu. Aplikasi ini bermanfaat bagi staf akademik dan mahasiswa, membantu
                    pengidentifikasian mahasiswa yang memerlukan dukungan lebih lanjut. Tujuannya adalah meningkatkan
                     efisiensi manajemen akademik,
                 tingkat kelulusan tepat waktu, dan memberikan pengalaman pendidikan yang lebih baik. Dua jenis klasifikasi Naive Bayes yang digunakan untuk implementasi! berikut:</h3>
        </div>
        <ul class="timeline">
            <li>
                <div class="timeline-image"><img class="rounded-circle img-fluid" src="{{ asset('frontend/assets/img/about/1.jpg') }}" alt="..." /></div>
                <div class="timeline-panel">
                    <div class="timeline-heading">
                        <h4>abad ke-20 dan awal abad ke-21</h4>
                        <h4 class="subheading">
                            Naive Bayes Bernoulli (Bernoulli Naive Bayes)
                        </h4>
                    </div>
                    <div class="timeline-body">
                        <p class="text-muted">
                            Digunakan ketika fitur dalam dataset adalah variabel biner
                             (0 atau 1), seperti hasil tes (lulus Tepata Waktu atau Tidak Tepat Waktu).
                            Mengasumsikan bahwa setiap fitur adalah independen dan menganggap
                             kejadian fitur yang sama lebih dari sekali
                              dalam satu dokumen hanya dihitung sekali.
                        </p>
                    </div>
                </div>
            </li>
            <li class="timeline-inverted">
                <div class="timeline-image"><img class="rounded-circle img-fluid" src="{{ asset('frontend/assets/img/about/2.jpg') }}" alt="..." /></div>
                <div class="timeline-panel">
                    <div class="timeline-heading">
                        <h4>Teorema Bayes abad ke-18</h4>
                        <h4 class="subheading">Gaussian Naive Bayes</h4>
                    </div>
                    <div class="timeline-body"><p class="text-muted">
                        Digunakan ketika fitur dalam dataset adalah numerik dan 
                        mengikuti distribusi Gaussian (normal distribution).
                        Mengasumsikan bahwa distribusi nilai fitur dalam setiap 
                        kelas adalah Gaussian dan menghitung parameter statistik 
                        seperti rata-rata (dugunakan untuk menghitung ip semester satau sampai ip semester 5) dan deviasi standar untuk setiap fitur dalam setiap kelas.
                            Ini adalah varian Naive Bayes yang sesuai ketika Anda
                             memiliki data numerik kontinu.</p></div>
                </div>
            </li>
        </ul>
    </div>
</section>