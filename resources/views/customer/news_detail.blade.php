@extends('customer.layout')
@section('title')

@section('css')
@endsection()


@section('body')

    <section class="ec-page-content section-space-p news-data">
        <div class="container">

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
        // Mock data để `public/customer/assets/js/page/news.js` không gọi API thật (trang detail có thể không cần danh sách).
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
                        }
                    ]
                });
            };
        })();
    </script>

    <script src="{{ asset('customer/assets/js/page/news.js') }}"></script>

@endsection()