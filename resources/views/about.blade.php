@extends('layouts.app')

@section('title', 'Về chúng tôi')

@section('content')
<h1 class="mb-4">Về chúng tôi</h1>

<div class="row">
    <div class="col-md-8">
        <p>Chợ Điện Tử là một nền tảng thương mại điện tử hàng đầu, cung cấp cho khách hàng trải nghiệm mua sắm trực tuyến tuyệt vời với hàng ngàn sản phẩm đa dạng từ các nhà bán hàng uy tín.</p>
        <p>Chúng tôi cam kết mang đến cho khách hàng:</p>
        <ul>
            <li>Sản phẩm chất lượng cao</li>
            <li>Giá cả cạnh tranh</li>
            <li>Dịch vụ khách hàng xuất sắc</li>
            <li>Giao hàng nhanh chóng và đáng tin cậy</li>
        </ul>
        <p>Với đội ngũ nhân viên tận tâm và công nghệ tiên tiến, chúng tôi luôn nỗ lực để cải thiện và nâng cao trải nghiệm mua sắm của khách hàng.</p>
    </div>
    <div class="col-md-4">
        <img src="/images/about-us.jpg" alt="Về chúng tôi" class="img-fluid rounded">
    </div>
</div>
@endsection
