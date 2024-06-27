@extends('article-layouts.articlePage')

@section('content')
    <style>
        .active-tab {
            background-color: rgb(139 92 246);
            color: white;
        }

        .hidden-content {
            display: none;
        }

        .project-title {
            color: #ff6f61;
        }
    </style>

    <body class="bg-white">
        <!-- Hero Section -->
        <section class="text-center py-16 bg-white">
            <div class="container mx-auto px-4">
                <h1 class="text-2xl text-gray-900 md:text-4xl lg:text-6xl font-bold">
                    Tentang NJS Helmet: Melindungi Perjalanan Anda dengan Gaya
                    dan Inovasi Sejak 2006
                </h1>
                <div class="mt-8 relative">
                    <img src="{{ url('images/1.jpg') }}" alt="Office" class="mx-auto rounded-lg shadow-lg w-full h-full" />
                    <div class="absolute top-2 left-2 bg-orange-500 text-white p-2 rounded-full text-sm"></div>
                </div>
            </div>
        </section>

        <!-- Information Section -->
        <section class="bg-purple-600 text-white md:-mt-56 lg:-mt-80 md:pt-56 lg:pt-80 pt-16 pb-16">
            <div class="container mx-auto px-4 text-center">
                <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold mb-4">
                    Melindungi Perjalanan Anda dengan Gaya dan Inovasi
                </h2>
                <p class="text-lg lg:text-xl mb-8">
                    NJS Helmet didirikan pada tahun 2006 oleh PT. Surya Motor
                    Shelmindo, perusahaan yang berbasis di Tangerang, Banten.
                    Kami berkomitmen untuk memproduksi helm berkualitas tinggi
                    yang memenuhi standar keamanan nasional dan internasional.
                    Kami percaya bahwa helm bukan hanya sekadar alat pelindung,
                    tetapi juga representasi dari kepribadian dan semangat
                    berkendara setiap individu. Oleh karena itu, kami terus
                    berinovasi dalam desain, teknologi, dan fitur-fitur unggulan
                    untuk memenuhi kebutuhan dan preferensi beragam konsumen.
                </p>

                <!-- Features Section -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="bg-white text-purple-600 p-6 rounded-lg shadow-lg">
                        <div class="flex items-center justify-center mb-4">
                            <div
                                class="bg-purple-600 text-white w-12 h-12 rounded-full flex items-center justify-center text-xl font-bold">
                                01
                            </div>
                        </div>
                        <h3 class="text-xl font-bold mb-2">
                            Perlindungan Optimal
                        </h3>
                        <p>
                            Kami berkomitmen untuk memberikan perlindungan
                            maksimal bagi para pengendara sepeda motor dengan
                            helm yang memenuhi standar SNI.
                        </p>
                    </div>
                    <div class="bg-white text-purple-600 p-6 rounded-lg shadow-lg">
                        <div class="flex items-center justify-center mb-4">
                            <div
                                class="bg-purple-600 text-white w-12 h-12 rounded-full flex items-center justify-center text-xl font-bold">
                                02
                            </div>
                        </div>
                        <h3 class="text-xl font-bold mb-2">
                            Desain dan Inovasi
                        </h3>
                        <p>
                            Kami terus berinovasi dalam desain helm yang stylish
                            dan fungsional, serta menggunakan material
                            berkualitas tinggi dan teknologi terkini.
                        </p>
                    </div>
                    <div class="bg-white text-purple-600 p-6 rounded-lg shadow-lg">
                        <div class="flex items-center justify-center mb-4">
                            <div
                                class="bg-purple-600 text-white w-12 h-12 rounded-full flex items-center justify-center text-xl font-bold">
                                03
                            </div>
                        </div>
                        <h3 class="text-xl font-bold mb-2">
                            Komitmen pada Keselamatan
                        </h3>
                        <p>
                            Kami memberikan edukasi tentang pentingnya
                            keselamatan berkendara dan berkomitmen untuk terus
                            meningkatkan kualitas produk dan layanan kami.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Visi dan Misi Section -->
        <section class="py-16 bg-white">
            <div class="container mx-auto px-4 flex flex-col lg:flex-row items-center">
                <div class="lg:w-1/2 mb-8 lg:mb-0">
                    <div class="image-overlay rounded-lg shadow-lg">
                        <img src="{{ url('images/gambarHelm-estetik.jpg') }}" alt="Interior Design"
                            class="rounded-lg w-full h-auto" />
                    </div>
                </div>
                <div class="lg:w-1/2 lg:pl-16 text-center lg:text-left">
                    <div class="flex justify-center lg:justify-start mb-4 space-x-4">
                        <button id="missionBtn"
                            class="visi-misi-btn px-4 py-2 rounded border active-tab hover:bg-purple-500 hover:text-white"
                            onclick="showContent('mission')">
                            Our Mission
                        </button>
                        <button id="visionBtn"
                            class="visi-misi-btn px-4 py-2 rounded border hover:bg-purple-500 hover:text-white"
                            onclick="showContent('vision')">
                            Our Vision
                        </button>
                        <button id="goalBtn"
                            class="visi-misi-btn px-4 py-2 rounded border hover:bg-purple-500 hover:text-white"
                            onclick="showContent('goal')">
                            Our Goal
                        </button>
                    </div>
                    <div id="missionContent" class="content">
                        <h2 class="text-2xl font-bold mb-4">Misi NJS Helmet</h2>
                        <p class="text-lg mb-4 text-justify indent-8">
                            Misi kami adalah memberikan pengalaman berkendara
                            yang lebih aman dan menyenangkan bagi seluruh
                            masyarakat Indonesia. Kami berkomitmen untuk terus
                            meningkatkan kualitas produk dan layanan kami, serta
                            memberikan edukasi tentang pentingnya keselamatan
                            berkendara.
                        </p>
                        <button class="bg-purple-500 hover:bg-purple-600 text-white px-4 py-2 rounded"
                            onclick="toggleMoreContent('missionMoreContent')">
                            Read More
                        </button>
                        <div id="missionMoreContent" class="hidden-content mt-4 text-justify indent-8">
                            <p class="text-lg mb-4">
                                Menciptakan produk-produk helm berkualitas
                                tinggi: Mengembangkan dan memproduksi helm-helm
                                yang memenuhi standar keamanan tertinggi,
                                menggunakan material terbaik, dan menawarkan
                                desain yang stylish serta inovatif untuk
                                memenuhi kebutuhan dan preferensi beragam
                                konsumen. Memberikan pengalaman berkendara yang
                                aman dan nyaman: Memastikan setiap produk NJS
                                Helmet memberikan perlindungan maksimal dan
                                kenyamanan optimal bagi pengendara, sehingga
                                mereka dapat menikmati perjalanan dengan rasa
                                aman dan percaya diri.
                            </p>
                            <p class="text-lg mb-4">
                                Meningkatkan kesadaran akan pentingnya
                                keselamatan berkendara: Melakukan edukasi dan
                                kampanye yang efektif untuk meningkatkan
                                kesadaran masyarakat tentang pentingnya
                                menggunakan helm berkualitas dan berkendara
                                dengan aman. Menjadi pelopor dalam inovasi
                                teknologi dan fitur keselamatan helm: Terus
                                melakukan riset dan pengembangan untuk
                                menghadirkan teknologi dan fitur-fitur terbaru
                                yang dapat meningkatkan keamanan dan kenyamanan
                                helm NJS. Membangun hubungan yang kuat dengan
                                pelanggan dan mitra bisnis: Menjalin kemitraan
                                yang saling menguntungkan dengan distributor,
                                retailer, dan komunitas pengendara, serta
                                memberikan layanan pelanggan yang responsif dan
                                memuaskan.
                            </p>
                            <p class="text-lg mb-4">
                                Berkontribusi positif terhadap masyarakat dan
                                lingkungan: Melaksanakan program-program
                                tanggung jawab sosial perusahaan yang berfokus
                                pada keselamatan berkendara, pendidikan, dan
                                pelestarian lingkungan.
                            </p>
                        </div>
                    </div>
                    <div id="visionContent" class="content hidden">
                        <h2 class="text-2xl font-bold mb-4">Visi NJS Helmet</h2>
                        <p class="text-lg mb-4 text-justify indent-8">
                            Visi NJS Helmet adalah menjadi merek helm nomor satu
                            di Indonesia dan pilihan utama para pengendara yang
                            menghargai keselamatan, gaya, dan inovasi. Kami
                            percaya bahwa helm bukan hanya sekadar alat
                            pelindung, tetapi juga representasi dari kepribadian
                            dan semangat berkendara setiap individu.
                        </p>
                        <button class="bg-purple-500 hover:bg-purple-600 text-white px-4 py-2 rounded"
                            onclick="toggleMoreContent('visionMoreContent')">
                            Read More
                        </button>
                        <div id="visionMoreContent" class="hidden-content mt-4">
                            <p class="text-lg mb-4 text-justify indent-8">
                                Menjadi pemimpin pasar helm di Indonesia dan
                                Asia Tenggara yang terdepan dalam inovasi,
                                kualitas, dan keamanan, serta menjadi pilihan
                                utama para pengendara yang menghargai gaya
                                hidup, kenyamanan, dan keselamatan berkendara.
                                Kami bercita-cita untuk terus mendorong
                                batas-batas desain dan teknologi helm,
                                menciptakan produk-produk yang tidak hanya
                                melindungi, tetapi juga menginspirasi dan
                                memberdayakan pengendara untuk mengejar passion
                                mereka dengan percaya diri.
                            </p>
                        </div>
                    </div>
                    <div id="goalContent" class="content hidden">
                        <h2 class="text-2xl font-bold mb-4">
                            Tujuan NJS Helmet
                        </h2>
                        <p class="text-lg mb-4 text-justify indent-8">
                            Tujuan kami adalah untuk terus berinovasi dalam
                            desain, teknologi, dan fitur-fitur unggulan untuk
                            memenuhi kebutuhan dan preferensi beragam konsumen,
                            sambil memastikan keselamatan dan kenyamanan
                            pengguna.
                        </p>
                        <button class="bg-purple-500 hover:bg-purple-600 text-white px-4 py-2 rounded"
                            onclick="toggleMoreContent('goalMoreContent')">
                            Read More
                        </button>
                        <div id="goalMoreContent" class="hidden-content mt-4">
                            <p class="text-lg mb-4 text-justify indent-8">
                                Mencapai pangsa pasar terbesar di Indonesia:
                                Menjadi merek helm nomor satu di Indonesia
                                dengan meningkatkan penjualan dan memperluas
                                jaringan distribusi ke seluruh wilayah.
                                Mempertahankan reputasi sebagai produsen helm
                                berkualitas tinggi: Terus meningkatkan kualitas
                                produk dan layanan untuk memenuhi harapan
                                pelanggan dan menjaga kepercayaan mereka
                                terhadap merek NJS Helmet.
                            </p>
                            <p class="text-lg mb-4 text-justify indent-8">
                                Menjadi pemimpin dalam inovasi helm:
                                Mengembangkan teknologi dan fitur-fitur baru
                                yang dapat meningkatkan keamanan, kenyamanan,
                                dan performa helm, serta menjadi trendsetter di
                                industri helm. Membangun komunitas pengendara
                                yang kuat: Menciptakan platform dan kegiatan
                                yang dapat menghubungkan para pengendara NJS
                                Helmet, serta mendorong mereka untuk berbagi
                                pengalaman dan pengetahuan tentang keselamatan
                                berkendara.
                            </p>
                            <p class="text-lg mb-4 text-justify indent-8">
                                Menjadi perusahaan yang bertanggung jawab secara
                                sosial dan lingkungan: Melaksanakan
                                program-program CSR yang berdampak positif bagi
                                masyarakat dan lingkungan, serta menjadi contoh
                                bagi perusahaan lain dalam menjalankan bisnis
                                yang berkelanjutan.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Project Collaboration Section -->
        <section class="py-16 bg-[#1a1a2e]">
            <div class="container mx-auto">
                <h2 class="text-start text-lg text-gray-300 uppercase tracking-wide mb-8 px-6">Our Project
                    Collaboration
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Barong Project -->
                    <div class="project-card text-white p-6">
                        <h3 class="text-2xl font-bold mb-4">NJS ZX-1 BARONG Hitam Gloss - Helm Full Face <span
                                class="project-title">—</span></h3>
                        <p class="mb-4">Helm NJS ZX-1 BARONG menawarkan desain yang siap untuk interkom dan dilengkapi
                            dengan visor jernih sebagai standar, sementara visor dark smoke tersedia sebagai pembelian
                            terpisah...</p>
                        <a href="/products/57"
                            class="view-project-button border inline-block text-white px-4 py-2 rounded mt-4 hover:bg-white hover:text-black">View
                            Product Collaboration</a>
                        <a href="/products/57">
                            <img src="{{ url('images/helm12.jpg') }}" alt="Barong Project" class="mt-4 rounded-lg">
                        </a>
                    </div>
                    <!-- Garuda Project -->
                    <div class="project-card text-white p-6">
                        <h3 class="text-2xl font-bold mb-4">NJS ZX-1 GARUDA Hitam Gloss - Helm Full Face <span
                                class="project-title">—</span></h3>
                        <p class="mb-4">NJS ZX-1 GARUDA hadir dengan warna Hitam Gloss dan menawarkan berbagai fitur
                            unggulan. Desain helm ini siap untuk interkom, dan dilengkapi dengan visor bening sebagai
                            standar...</p>
                        <a href="/products/45"
                            class="view-project-button border hover:bg-white hover:text-black inline-block text-white px-4 py-2 rounded mt-4">View
                            Product Collaboration</a>
                        <a href="/products/45">
                            <img src="{{ url('images/21.jpeg') }}" alt="Garuda Project" class="mt-4 rounded-lg">
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact Us Section -->
        <section class="py-16 bg-[#e7f0ff]">
            <div class="container mx-auto px-4 lg:flex lg:space-x-16 lg:justify-between lg:items-center">
                <!-- Contact Information -->
                <div class="lg:w-1/2 mb-8 lg:mb-0">
                    <h2 class="text-4xl font-bold mb-4">Hubungi Kami</h2>
                    <p class="mb-4">Punya pertanyaan, saran, atau ingin mengetahui lebih lanjut tentang NJS Helmet?
                        Jangan ragu untuk menghubungi kami! Kami siap membantu Anda dengan senang hati.</p>
                    <div class="grid grid-cols-1 lg:grid-cols-3">
                        <div>
                            <h3 class="font-bold mb-2">Kantor Pusat & Pabrik:</h3>
                            <p>PT. Surya Motor Shelmindo<br>Jl. Gatot Subroto Km. 8,5<br>Jatake, Tangerang 15136<br>Banten,
                                Indonesia</p>
                        </div>
                        <div class="lg:pl-8 lg:pr-8">
                            <h3 class="font-bold mb-2 mt-4 lg:mt-0">Jam Operasional:</h3>
                            <p>Senin - Jumat: <br>08.00 - 17.00 WIB</p>
                        </div>
                        <div>
                            <h3 class="font-bold mb-2 mt-4 lg:mt-0">Customer Service:</h3>
                            <p>(021) 5971401<br>njshelp@gmail.com</p>
                        </div>
                    </div>

                    <h3 class="font-bold mb-2 mt-4">Media Sosial:</h3>
                    <p>Tetap terhubung dengan kami dan dapatkan informasi terbaru mengenai produk, promo, dan acara menarik
                        lainnya:</p>
                    <br>
                    <ul>
                        <li>Facebook: NJS Helmet</li>
                        <li>Instagram: @njshelmet</li>
                        <li>YouTube: NJS Helmet Official</li>
                    </ul>
                </div>
                {{-- Contact Form --}}
                <div class="lg:w-1/3 bg-white px-8 py-10 rounded-[30px] shadow-lg">
                    <h3 class="text-2xl lg:text-3xl font-semibold mb-4 lg:mb-12">Let's Collaborate or Contact Us</h3>
                    <p class="mb-4 text-lg">You can reach us anytime</p>
                    <form id="contact-form">
                        <div class="flex space-x-4 mb-4">
                            <input type="text" name="user_name" placeholder="First name"
                                class="w-1/2 p-3 border rounded-lg" required>
                            <input type="text" name="user_lastname" placeholder="Last name"
                                class="w-1/2 p-3 border rounded-lg">
                        </div>
                        <div class="mb-4">
                            <input type="email" name="user_email" placeholder="Your email"
                                class="w-full p-3 border rounded-lg" required>
                        </div>
                        <div class="mb-4 lg:mb-12">
                            <textarea name="message" placeholder="Apa yang bisa kami bantu?" class="w-full p-3 border rounded-lg" rows="4"
                                required></textarea>
                        </div>
                        <button type="submit" class="w-full bg-blue-600 text-white p-3 rounded-lg">Submit</button>
                    </form>
                </div>
            </div>
        </section>

        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js"></script>
        <script type="text/javascript">
            (function() {
                emailjs.init("tS28mCvRl8eexc5K-");
            })();
        </script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            function showContent(contentId) {
                // menyembunyikan semua content class
                document
                    .querySelectorAll('.content')
                    .forEach((content) => content.classList.add('hidden'));

                // Remove active-tab class dari semua tombol di visi misi section
                document
                    .querySelectorAll('.visi-misi-btn')
                    .forEach((button) => button.classList.remove('active-tab'));

                // Show selected content dan add active-tab class
                document
                    .getElementById(contentId + 'Content')
                    .classList.remove('hidden');
                document
                    .getElementById(contentId + 'Btn')
                    .classList.add('active-tab');
            }

            function toggleMoreContent(contentId) {
                // Toggle hidden content
                const content = document.getElementById(contentId);
                if (content.style.display === 'block') {
                    content.style.display = 'none';
                } else {
                    content.style.display = 'block';
                }
            }


            document.getElementById('contact-form').addEventListener('submit', function(event) {
                event.preventDefault();

                emailjs.sendForm('service_oxqhxgr', 'template_qt1o08k', this)
                    .then(function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'Pesan Berhasil Dikirim!',
                            text: 'Terima kasih telah menghubungi kami. Kami akan segera membalas pesan Anda.',
                            confirmButtonText: 'OK'
                        });
                        document.getElementById('contact-form').reset();
                    }, function(error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal Mengirim Pesan!',
                            text: 'Terjadi kesalahan. Silakan coba lagi nanti.',
                            confirmButtonText: 'OK'
                        });
                    });
            });
        </script>
    </body>
@endsection
