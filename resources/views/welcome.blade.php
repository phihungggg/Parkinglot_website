<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>

html, body {
    margin: 0;
    padding: 0;
}


.content-thin{
    background: lightblue;
    color : white;
    padding-left: 5em;
    padding-right: 5em; 
    border-radius: 4px;
    margin-bottom: 3em;
}

.content1 {

    height: 937px;
background-color: rgb(10, 9, 68);
margin-bottom: 10px;
object-fit: cover; /* Giữ tỷ lệ ảnh và lấp đầy không gian */
width: 100%;
}
.content2
{

display: flex;
justify-content: center;
align-items: center;
flex-direction: column;
}

.Homepage{
display:flex
justify-content: center;
align-items: center;
}

.aroundtheworld{

    width: 500px; /* Set width to 100 pixels */
    height: 300px;

}

.headerr {
    box-shadow: 0 1px 1px 0 #00ff7f;
    color: white;
    background: #0a0944;
    height: 70px; /* Chiều cao của header */
    position: sticky; /* Header cố định khi cuộn */
    top: 0; /* Đặt header dính ở đầu trang */
    z-index: 100; /* Đảm bảo header nổi trên các thành phần khác */
    padding-top: 0;
    margin-top: 0;
    display: flex;
    justify-content: space-between; /* Căn chỉnh không gian giữa logo và navigation */
}

.signinandreserve {
    margin-left: auto; /* Đẩy sang bên phải */
    display: flex;
    flex-direction: row;
    gap: 5px;
}

.logo
{

    width: 190px; /* Set width to 100 pixels */
    height: 60px;

}
.sign{


    margin-top: 25px;
    margin-left: auto;
    margin-right: 5px;
    color: white;
}

.reservation{

    border-radius: 4px;
    box-shadow: 0 2px 5px 0 rgba(0, 0, 0, .3);
    background-color: #00ff7f;
    color: #000;
    line-height: normal;
   padding-left: 10px;
   padding-right: 10px;
    padding-top: 5px;
    margin-top: 20px;
    margin-right: 5px;
    margin-bottom: 10px;
}

    </style>
</head>
<body>
    <header class="headerr">
        <img class="logo"  src="{{ asset('images/Artboard22.png') }}" alt="">
   
        <livewire:welcome.navigation />
  
    </header>
    <main class="Homepage">
        
       <div class="content1 ">
        

       </div>
    <div class="content2">
        <div class="content-thin">
        <p>we are the most accurate parking lot service in the world</p>
        </div> 

   <img class="aroundtheworld" src={{ asset('images/aroundtheworld.png') }} alt="">
</div>
    

</main>
</body>
</html>