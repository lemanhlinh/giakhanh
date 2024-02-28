<!DOCTYPE html>
<html>
<head>
    <title>Đặt món ăn</title>
</head>
<body>
<h1>Xin chào, {{ $data['full_name'] }}!</h1>
<p>Bạn đặt món với các thông tin sau:</p>

<ul>
    <li>Giới tính: {{ $data['gender'] == 0 ? 'Anh' : 'Chị' }}</li>
    <li>Tên: {{ $data['full_name'] }}</li>
    <li>Số điện thoại: {{ $data['phone'] }}</li>
    <li>Email: {{ $data['email'] }}</li>
    <li>Địa chỉ: {{ $data['address'] }}</li>
    <li>Ghi chú: {{ $data['note'] }}</li>
</ul>
</body>
</html>
