<!DOCTYPE html>
<html>
<head>
    <title>Đặt bàn</title>
</head>
<body>
<h1>Xin chào, {{ $data['full_name'] }}!</h1>
<p>Bạn đặt bàn với các thông tin sau:</p>

<ul>
    <li>Tên: {{ $data['full_name'] }}</li>
    <li>Số điện thoại: {{ $data['phone'] }}</li>
    <li>Email: {{ $data['email'] }}</li>
    <li>Cơ sở: {{ $store->title }}</li>
    <li>Ngày đặt bàn: {{ $data['book_time'] }}</li>
    <li>Giờ đặt bàn: {{ $data['book_hour'] }}</li>
    <li>Số lượng khách: {{ $data['number_customers'] }}</li>
    <li>Ghi chú: {{ $data['note'] }}</li>
</ul>
</body>
</html>
