@extends('layouts.app')

@section('content')
    <section class="shopping-cart">
        
        <!-- .shopping-cart -->
        <div class="container">
            <div class="title text-center">
                <h3>UMKM</h3>
                
            </div>
            <div class="row">
                <div id="umkm-data"></div>
                <div class="col-lg-12 text-center">

                    <a href="javascript:void(0);" id="load-more" class="load-more">Tampilkan Lebih
                        Banyak</a>

                    <a href="javascript:void(0);" id="no-more-assets" class="load-more">tidak ada UMKM lagi</a>
                </div>
            </div>

        </div>
        <!-- /.shopping-cart -->
    </section>
@endsection

@section('style')
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {

            let currentPage = 1;
            get(currentPage)
            $('#load-more').click(function() {
                currentPage++;
                get(currentPage);
            });





        })




        function get(page) {
            // $('#no-more-assets').hide();
            $.ajax({
                url: BASE_URL + '/get-umkm?page=' + page, // URL dengan parameter halaman
                method: 'GET', // Tambahkan method di tempat yang tepat

                success: function(response) {
                    const data = response.data;


                    if (data.length > 0) {
                        data.forEach(function(item) {
                            // Buat HTML untuk setiap produk

                            var umkm_html = `<div class="col-lg-4">
                    <!-- e-product -->
                    <div class="e-product e-product2">
                        <div class="pro-img">
                            <img src="${BASE_URL}/${item.img_umkm}" alt="2">
                        </div>
                        <div class="pro-text-outer">
                            <a href="${BASE_URL}/umkm/${item.id}"><p class="wk-price">${item.nama_umkm} </p></a>
                            <span>${item.tentang}</span>
                        </div>
                    </div>
                    <!-- /e-product -->
                </div>`

                            $('#umkm-data').append(umkm_html);
                        });

                        // Tampilkan tombol "Load More" jika ada lebih banyak data
                        if (response.current_page < response.last_page) {
                            $('#load-more').show();
                            $('#no-more-assets').hide();
                        } else {
                            $('#load-more').hide();
                            $('#no-more-assets').show(); // Tampilkan pesan "Tidak Ada Produk Lagi"
                        }
                    } else {
                        $('#load-more').hide(); // Sembunyikan tombol jika tidak ada data lagi
                        $('#no-more-assets').show(); // Tampilkan pesan "Tidak Ada Produk Lagi"
                    }
                },
                error: function() {
                    $('#load-more-container').append('<p>Error retrieving products</p>');
                }
            });
        }
    </script>
@endpush
