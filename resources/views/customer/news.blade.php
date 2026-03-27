@extends('customer.layout')
@section('title', 'Tin tức')

@section('css')
@endsection()


@section('body')

    <section class="ec-page-content section-space-p">
        <div class="container">
            <div class="row">
                <div class="ec-blogs-rightside col-lg-12 col-md-12">

                    <!-- Blog content Start -->
                    <div class="ec-blogs-content">
                        <div class="ec-blogs-inner">
                            <div class="row new-list">

                            </div>
                        </div>

                    </div>
                    <!--Blog content End -->
                </div>
            </div>
        </div>
    </section>


@endsection()


@section('sub_layout')
<script>
    window.EKKA_ENABLE_MOCK_HEADER = true;
</script>
@endsection()


@section('js')

    <script>
        // Mock data để `public/customer/assets/js/page/news.js` render mà không gọi API thật.
        (() => {
            const ok = (payload) => $.Deferred().resolve(payload).promise();
            Api.News.GetAll = () => {
                return ok({
                    data: [
                        {
                            id: 1,
                            slug: "sale-lon-mua-he",
                            image: "customer/assets/images/banner/2.jpg",
                            description: "Chương trình sale lớn mùa hè"
                        },
                        {
                            id: 2,
                            slug: "hang-moi-ve-kho",
                            image: "customer/assets/images/banner/3.jpg",
                            description: "Sản phẩm mới vừa về kho"
                        },
                        {
                            id: 3,
                            slug: "combo-gia-soc",
                            image: "customer/assets/images/banner/9.jpg",
                            description: "Combo giảm giá sốc trong tuần"
                        }
                    ]
                });
            };
        })();
    </script>

    <script src="{{ asset('customer/assets/js/page/news.js') }}"></script>

@endsection()