
<div id="reservation-menu">
    <h2>Đặt Chỗ Đỗ Xe</h2>
    <label for="location">Địa Điểm:</label>
    <input type="text" id="location" placeholder="Nhập địa điểm">

    <label for="start-time">Thời Gian Bắt Đầu:</label>
    <input type="datetime-local" id="start-time">

    <label for="end-time">Thời Gian Kết Thúc:</label>
    <input type="datetime-local" id="end-time">

    <label for="duration">Thời Gian (giờ):</label>
    <input type="number" id="duration" min="1" placeholder="Số giờ">

    <button type="button" onclick="reserveSpot()">Đặt Chỗ</button>

    @if($message) <!-- Check if there is a message to display -->
    <div >
       {{ $message }} <!-- Output the message -->
    </div>
@endif
</div>

